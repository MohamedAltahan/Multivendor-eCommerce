<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\FlashSale;
use App\Models\FlashSaleItem;
use App\Models\Product;
use Illuminate\Http\Request;

class FlashSaleController extends Controller
{
    function index()
    {
        $flashSaleDate = FlashSale::first();

        $flashSaleItems = FlashSaleItem::where('status', 'active')->pluck('product_id');
        $flashSaleProducts = Product::whereIn('id', $flashSaleItems)
            ->with('firstImage', 'category')->withAvg('reviews', 'rating')->paginate();

        return view('frontend.pages.flash-sale', compact('flashSaleDate', 'flashSaleProducts'));
    }
}
