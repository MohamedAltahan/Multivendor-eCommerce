<?php
//set sidebar acive

use Carbon\Carbon;

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
    //dd($currentDate);
    // // $start_offer_date = Carbon::parse($product->start_offer_date);
    // dd(Carbon::parse($product->start_offer_date)->gt(Carbon::now()));
    if (
        $currentDate >= $product->offer_start_date &&
        $currentDate <= $product->offer_end_date &&
        $product->offer_price != null
    ) {
        return true;
    }
    return false;
}
//discount percentage=================================================================
function calcDiscountPercentage($originalPrice, $discountPrice)
{
    $discountAmount = $originalPrice - $discountPrice;
    return ceil(($discountAmount / $originalPrice) * 100);
}

//get product type=====================================================================
function getProductType($type)
{
}
