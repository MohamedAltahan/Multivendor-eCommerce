<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\FlashSale;
use App\Models\FlashSaleItem;
use App\Models\HomePageSetting;
use App\Models\Product;
use App\Models\Slider;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $sliders = Slider::where('status', 'active')->orderBy('serial', 'ASC')->get();
        $flashSaleDate = FlashSale::first();
        $popularCategories = HomePageSetting::where('key', 'popular_category_section')->first();
        $brands = Brand::where('status', 'active')->get();
        $typebasedProducts = $this->getTypeBaseProducts();
        //get flash sale with product details and its first image
        $flashSaleProducts = FlashSaleItem::where('show_at_home', 'yes')->where('status', 'active')->with(
            [
                'product' => function ($query) {
                    $query->with('images');
                }
            ]
        )->get();

        return view('frontend.home.home', compact('typebasedProducts', 'brands', 'sliders', 'flashSaleDate', 'flashSaleProducts', 'popularCategories'));
    }

    function getTypeBaseProducts()
    {
        $typebasedProducts = [];
        $typebasedProducts['new'] = Product::where(['product_type' => 'new', 'is_approved' => 'yes', 'status' => 'active'])
            ->orderBy('id', 'DESC')->take(8)->get();
        $typebasedProducts['featured'] = Product::where(['product_type' => 'featured', 'is_approved' => 'yes', 'status' => 'active'])
            ->orderBy('id', 'DESC')->take(8)->get();
        $typebasedProducts['best'] = Product::where(['product_type' => 'best', 'is_approved' => 'yes', 'status' => 'active'])
            ->orderBy('id', 'DESC')->take(8)->get();
        $typebasedProducts['top'] = Product::where(['product_type' => 'top', 'is_approved' => 'yes', 'status' => 'active'])
            ->orderBy('id', 'DESC')->take(8)->get();
        return $typebasedProducts;
    }
}
