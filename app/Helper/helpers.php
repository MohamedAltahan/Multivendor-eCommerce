<?php
//set sidebar acive

use Carbon\Carbon;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Session;

function setActive(array $routes)
{
    if (is_array($routes)) {
        foreach ($routes as $route) {
            //check the current request if like $route
            if (request()->routeIs($route)) {
                return 'active';
            }
        }
    }
}

//product has valid discount - check start and end date=============================
function checkDiscount($product)
{
    $currentDate = date('Y-m-d');

    if ($product->offer_price != null) {
        //if date fields are null means that product offer is valid forever
        if ($product->offer_start_date == null &&  $product->offer_end_date == null) {
            return true;
        }
        if ($currentDate >= $product->offer_start_date && $currentDate <= $product->offer_end_date) {
            return true;
        }
    }
    return false;
}
//discount percentage=================================================================
function calcDiscountPercentage($originalPrice, $discountPrice)
{
    $discountAmount = $originalPrice - $discountPrice;
    return ceil(($discountAmount / $originalPrice) * 100);
}

//total for whole cart=============================================================
function calcCartTotal()
{
    $cartProducts = Cart::content();
    $totalCartPrice = 0;
    foreach ($cartProducts as $product) {
        $totalCartPrice +=  ($product->qty * $product->price);
    }
    return $totalCartPrice;
}

// get total amount ================================================================
function getMainCartTotal()
{
    if (Session::has('coupon')) {
        $coupon = Session::get('coupon');
        $subTotal = calcCartTotal();
        if ($coupon['discount_type'] == 'fixed') {
            $total = $subTotal - $coupon['discount_value'];
            return $total;
        } elseif ($coupon['discount_type'] == 'percent') {
            $discount =  $subTotal * $coupon['discount_value'] / 100;
            $total = $subTotal - $discount;
            return  $total;
        }
    } else {
        return calcCartTotal();
    }
}

// get total amount after discount ================================================================
function getMainCartDiscount()
{
    if (Session::has('coupon')) {
        $coupon = Session::get('coupon');
        $subTotal = calcCartTotal();
        if ($coupon['discount_type'] == 'fixed') {
            return $coupon['discount_value'];
        } elseif ($coupon['discount_type'] == 'percent') {
            $discount =  $subTotal * $coupon['discount_value'] / 100;
            return $discount;
        }
    } else {
        return 0;
    }
}
