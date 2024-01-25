<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\FlashSale;
use App\Models\Product;
use App\Models\ProductImages;
use Illuminate\Http\Request;

class ShowProductController extends Controller
{
    public function showProductDetails(string $slug)
    {
        $flashSaleDate = FlashSale::first();
        $product = Product::with('brand', 'images')->where('slug', $slug)->where('status', 'active')->first();
        return view('frontend.pages.show-product-details', compact('product', 'flashSaleDate'));
    }
}
