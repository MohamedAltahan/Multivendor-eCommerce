<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Product;
use App\Models\ProductImages;
use App\Models\ProductVariant;
use App\Models\VariantDetails;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        $product = Product::findOrFail($request->product_id);

        //if request is comming from 'main card'===============================================================
        if ($request->submit_source == 'main_card') {
            $request['quantity'] = 1;
            $productVariants = ProductVariant::where(["product_id" => $request->product_id, 'status' => 'active'])
                ->get()->groupBy('product_variant_type_id');
            if ($productVariants->count() > 0) {
                //get first(default) value of each variant
                foreach ($productVariants as $variantDetails) {
                    $defaultProductVariants[] =  $variantDetails->first();
                }
                $variants = $defaultProductVariants;
            }
            //if request is comming from 'product page details'
        } elseif ($request->submit_source == 'details_page') {
            if (count($request->variants_id) > 0) {
                $variants = ProductVariant::whereIn('id', $request->variants_id)->get();
            }
        } else {
            return response(['message' => 'Something went wrong, try again', 'status' => 'error']);
        }

        //check product availablity in stock===================================================
        if ($product->quantity == 0) {
            return response(['status' => 'error', 'message' => 'product out of stock']);
        } elseif ($product->quantity < $request->quantity) {
            return response(['status' => 'error', 'message' => 'This quantity is not available in stock']);
        }

        //to store total summation of all variants==============================
        $variantsTotalPrice = 0;
        $variantDetials = [];
        if (isset($variants)) {
            foreach ($variants as $variant) {
                $variantDetials[$variant->type->name]['name'] = $variant->values->variant_value;
                $variantDetials[$variant->type->name]['price'] = $variant->variant_price;
                //all varaints price together
                $variantsTotalPrice += $variant->variant_price;
            }
        }

        //check discount===========================================================
        $productTotalPrice = 0;
        if (checkDiscount($product)) {
            $productTotalPrice = $product->offer_price + $variantsTotalPrice;
        } else {
            $productTotalPrice = $product->price + $variantsTotalPrice;
        }

        // dd($productTotalPrice);
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

    // show cart details page===========================================================================
    public function cartDetails()
    {
        $cartItems = Cart::content();

        return view('frontend.pages.cart-details', compact('cartItems'));
    }

    //cart update quantity ajax============================================================
    public function cartUpdateQuantity(Request $request)
    {
        $productId = Cart::get($request->rowId);
        $product = Product::findOrFail($productId->id);

        //check product availablity in stock
        if ($product->quantity == 0) {
            return response(['status' => 'error', 'message' => 'product out of stock']);
        } elseif ($product->quantity < $request->quantity) {
            return response(['status' => 'error', 'message' => 'This quantity is not available in stock']);
        }
        Cart::update($request->rowId, $request->quantity);
        $totalPrice = $this->calcTotal($request->rowId);
        return response(['status' => 'success', 'message' => 'Quantity updated ', 'totalPrice' => $totalPrice]);
    }

    //total for one product================================================================
    public function calcTotal($rowId)
    {
        $itemDetails = Cart::get($rowId);
        return   $itemDetails->qty * $itemDetails->price;
    }

    //total for whole cart before the coupon===============================================
    public function calcCartTotal()
    {
        $cartProducts = Cart::content();
        $totalCartPrice = 0;
        foreach ($cartProducts as $product) {
            $totalCartPrice +=  $this->calcTotal($product->rowId);
        }
        return $totalCartPrice;
    }

    //remove all  products cart=============================================================
    public function clearCart()
    {
        Cart::destroy();
        Session::forget('coupon');
        return response(['status' => 'success', 'message' => 'Cart cleared!']);
    }

    //removeCartProduct======================================================================
    public function removeCartProduct($rowId)
    {
        Cart::remove($rowId);
        return redirect()->back();
    }

    //countCartProduct====================================================================
    public function getCartCount()
    {
        return Cart::count();
    }

    //getCartProducts====================================================================
    public function getCartProducts()
    {
        $cartProducts = Cart::content();
        $totalCartPrice = 0;
        foreach ($cartProducts as $product) {
            $totalCartPrice +=  $this->calcTotal($product->rowId);
        }

        return view('frontend.layout.side-cart', compact('cartProducts', 'totalCartPrice'));
    }


    //removeCartProduct====================================================================
    public function removeSideCartProduct(Request $request)
    {
        Cart::remove($request->productId);
    }

    // apply coupon on cart==============================================================
    public function applyCoupon(Request $request)
    {
        if ($request->coupon_code == null) {
            return response(['status' => 'error', 'message' => 'you must enter coupon code']);
        }
        $coupon = Coupon::where(['status' => 'active', 'code' => $request->coupon_code])->first();
        //validations================
        if ($coupon == null) {
            return response(['status' => 'error', 'message' => 'Coupon not exist']);
        } elseif ($coupon->start_date > date('Y-m-d')) {
            return response(['status' => 'error', 'message' => 'Coupon not exist']);
        } elseif ($coupon->end_date < date('Y-m-d')) {
            return response(['status' => 'error', 'message' => 'Coupon has expired']);
        } elseif ($coupon->used_counter >= $coupon->quantity) {
            return response(['status' => 'error', 'message' => 'Coupon has reached the limit']);
        }
        //check discount type
        if ($coupon->discount_type == 'fixed') {
            Session::put('coupon', [
                'name' => $coupon->name,
                'code' => $coupon->code,
                'discount_type' => 'fixed',
                'discount_value' => $coupon->discount_value
            ]);
        } elseif ($coupon->discount_type == 'percent') {
            Session::put('coupon', [
                'name' => $coupon->name,
                'code' => $coupon->code,
                'discount_type' => 'percent',
                'discount_value' => $coupon->discount_value
            ]);
        }
        return response(['status' => 'success', 'message' => 'Coupon has been applied']);
    }

    // calculate coupon dicount ajax=============================================
    public function couponCalculation()
    {
        $subTotal = calcCartTotal();

        if (Session::has('coupon')) {
            $coupon = Session::get('coupon');

            if ($coupon['discount_type'] == 'fixed') {
                $total = $subTotal - $coupon['discount_value'];
                return response(['status' => 'success', 'total' => $total, 'discount' => $coupon['discount_value']]);
            } elseif ($coupon['discount_type'] == 'percent') {
                $discount =  $subTotal * $coupon['discount_value'] / 100;
                $total = $subTotal - $discount;
                return response(['status' => 'success', 'total' => $total, 'discount' => $discount]);
            }
        } else {
            return response(['status' => 'success', 'total' => $subTotal, 'discount' => 0]);
        }
    }
}
