<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductImages;
use App\Models\ProductVariantDetails;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        $product = Product::findOrFail($request->product_id);
        //to store total summation of all variants
        $variantsTotalPrice = 0;
        $variantDetials = [];
        if ($request->has('variants_id')) {

            foreach ($request->variants_id as $varinatId) {
                $variantValue = ProductVariantDetails::with('variantType')->where('id', $varinatId)->first();
                $variantDetials[$variantValue->variantType->name]['name'] = $variantValue->variant_value;
                $variantDetials[$variantValue->variantType->name]['price'] = $variantValue->price;
                //all varaints price together
                $variantsTotalPrice += $variantValue->price;
            }
        }

        //check discount
        $productTotalPrice = 0;
        if (checkDiscount($product)) {
            $productTotalPrice = $product->offer_price + $variantsTotalPrice;
        } else {
            $productTotalPrice = $product->price + $variantsTotalPrice;
        }

        $cartValues = [];
        $cartValues['id'] = $product->id;
        $cartValues['name'] = $product->name;
        $cartValues['qty'] = $request->quantity;
        $cartValues['price'] = $productTotalPrice;
        $cartValues['weight'] = 1;
        $cartValues['options']['variants'] = $variantDetials;
        $cartValues['options']['image'] = ProductImages::where($product->key)->first()->name;
        $cartValues['options']['slug'] = $product->slug;

        Cart::add($cartValues);
        return response(['message' => 'Add to cart successfully', 'status' => 'success']);
    }
}
