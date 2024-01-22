<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\FlashSale;
use App\Models\FlashSaleItem;
use App\Models\Slider;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $sliders = Slider::where('status', 'active')->orderBy('serial', 'ASC')->get();
        $flashSaleDate = FlashSale::first();
        //get flash sale with product details and its first image
        $flashSaleProducts = FlashSaleItem::where('show_at_home', 'yes')->where('status', 'active')->with(
            [
                'product' => function ($query) {
                    $query->with('images');
                }
            ]
        )->get();

        return view('frontend.home.home', compact('sliders', 'flashSaleDate', 'flashSaleProducts'));
    }
}
