<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Advertisement;
use App\Models\Brand;
use App\Models\FlashSale;
use App\Models\FlashSaleItem;
use App\Models\FrontendSection;
use App\Models\HomePageSetting;
use App\Models\Product;
use App\Models\Slider;
use App\Models\Vendor;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $productsSliderOne = HomePageSetting::where('key', 'products_slider_one')->first();
        $productsSliderTwo = HomePageSetting::where('key', 'products_slider_two')->first();
        $productsSliderThree = HomePageSetting::where('key', 'products_slider_three')->first();
        $sliders = Slider::where('status', 'active')->orderBy('serial', 'ASC')->get();
        $flashSaleDate = FlashSale::first();
        $popularCategories = HomePageSetting::where('key', 'popular_category_section')->first();
        $brands = Brand::where('featured', 'yes')->get();
        $typebasedProducts = $this->getTypeBaseProducts();
        //get flash sale with product details and its first image
        $flashSaleItems = FlashSaleItem::where('show_at_home', 'yes')->where('status', 'active')->pluck('product_id');
        $flashSaleProducts = Product::whereIn('id', $flashSaleItems)
            ->with('firstImage', 'category')->withAvg('reviews', 'rating')->paginate();

        $banner1 = Advertisement::where('key', 'homepage_banner1')->first();
        $banner1 = @json_decode($banner1->value, true);

        $banner2 = Advertisement::where('key', 'homepage_banner2')->first();
        $banner2 = @json_decode($banner2->value, true);

        $frontendSections = FrontendSection::first();
        $frontendSections = @json_decode($frontendSections->value);

        return view('frontend.home.home', compact(
            'productsSliderTwo',
            'productsSliderOne',
            'productsSliderThree',
            'typebasedProducts',
            'brands',
            'sliders',
            'flashSaleDate',
            'flashSaleProducts',
            'popularCategories',
            'banner1',
            'banner2',
            'frontendSections'
        ));
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

    function vendorPage()
    {
        $vendors = Vendor::where('status', 'active')->paginate(20);
        return view('frontend.pages.vendor', compact('vendors'));
    }

    function vendorProducts($id)
    {
        $products = Product::where(['vendor_id' => $id, 'is_approved' => 'yes', 'status' => 'active'])
            ->withAvg('reviews', 'rating')->paginate(16);
        // dd($products);
        $vendor = Vendor::where('id', $id)->withAvg('reviews', 'rating')->first();
        return view('frontend.pages.vendor-products', compact('products', 'vendor'));
    }
}
