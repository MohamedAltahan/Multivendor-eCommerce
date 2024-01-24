<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductImages;
use Illuminate\Http\Request;

class ShowProductController extends Controller
{
    public function showProductDetails(string $slug)
    {
        $product = Product::where('slug', $slug)->where('status', 'active')->first();
        $images = ProductImages::where('product_key', $product->product_key)->get();
        return view('frontend.pages.show-product-details', compact('product', 'images'));
    }
}
