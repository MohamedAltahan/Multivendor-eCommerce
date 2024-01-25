<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\FlashSale;
use App\Models\FlashSaleItem;
use Illuminate\Http\Request;

class FlashSaleController extends Controller
{
    function index()
    {
        $flashSaleDate = FlashSale::first();
        //get flash sale with product details and its first image
        $flashSaleProducts = FlashSaleItem::where('status', 'active')->with(
            [
                'product' => function ($query) {
                    $query->with('firstImage');
                }
            ]
        )->paginate();
        return view('frontend.pages.flash-sale', compact('flashSaleDate', 'flashSaleProducts'));
    }
}
