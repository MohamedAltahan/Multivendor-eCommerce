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
        $cartValues['options']['variants_total_price'] = $variantsTotalPrice;
        $cartValues['options']['image'] = ProductImages::where('product_key', $product->product_key)->value('name');
        $cartValues['options']['slug'] = $product->slug;

        Cart::add($cartValues);
        return response(['message' => 'Add to cart successfully', 'status' => 'success']);
    }

    // show cart details page
    public function cartDetails()
    {
        $cartItems = Cart::content();

        return view('frontend.pages.cart-details', compact('cartItems'));
    }

    //cart update quantity ajax
    public function cartUpdateQuantity(Request $request)
    {
        Cart::update($request->rowId, $request->quantity);
        $totalPrice = $this->calcTotal($request->rowId);
        return response(['status' => 'success', 'message' => 'Quantity updated ', 'totalPrice' => $totalPrice]);
    }

    public function calcTotal($rowId)
    {
        $itemDetails = Cart::get($rowId);
        return  $totalPrice = $itemDetails->qty * $itemDetails->price;
    }

    //clear products cart===================================================================
    public function clearCart()
    {
        Cart::destroy();
        return response(['status' => 'success', 'message' => 'Cart cleared!']);
    }

    //removeCartProduct====================================================================
    public function removeCartProduct($rowId)
    {
        Cart::remove($rowId);
        return redirect()->back();
    }
}
