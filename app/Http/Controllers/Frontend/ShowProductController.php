<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\ChildCategory;
use App\Models\FlashSale;
use App\Models\Product;
use App\Models\ProductImages;
use App\Models\ProductReview;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ShowProductController extends Controller
{
    public function productsIndex(Request $request)
    {
        if ($request->has('category')) {
            $category = Category::where('slug', $request->category)->firstOrFail();
            $products = Product::where([
                'category_id' => $category->id,
                'status' => 'active',
                'is_approved' => 'yes'
            ])
                ->when($request->has('range') && request()->range != '', function ($query) use ($request) {
                    $price = explode(';', $request->range);
                    $startPrice = $price[0];
                    $endPrice = $price[1];
                    return $query->where('price', '>=', $startPrice)->where('price', '<=', $endPrice);
                })
                ->paginate(12);
        } elseif ($request->has('subCategory')) {
            $category = SubCategory::where('slug', $request->subCategory)->firstOrFail();
            $products = Product::where([
                'sub_category_id' => $category->id,
                'status' => 'active',
                'is_approved' => 'yes'
            ])
                ->when($request->has('range') && request()->range != '', function ($query) use ($request) {
                    $price = explode(';', $request->range);
                    $startPrice = $price[0];
                    $endPrice = $price[1];
                    return $query->where('price', '>=', $startPrice)->where('price', '<=', $endPrice);
                })
                ->paginate(12);
        } elseif ($request->has('childCategory')) {
            $category = ChildCategory::where('slug', $request->childCategory)->firstOrFail();
            $products = Product::where([
                'child_category_id' => $category->id,
                'status' => 'active',
                'is_approved' => 'yes'
            ])
                ->when($request->has('range') && request()->range != '', function ($query) use ($request) {
                    $price = explode(';', $request->range);
                    $startPrice = $price[0];
                    $endPrice = $price[1];
                    return $query->where('price', '>=', $startPrice)->where('price', '<=', $endPrice)
                        ->orWhere('offer_price', '>=', $startPrice)->where('offer_price', '<=', $endPrice);
                })
                ->paginate(12);
        } elseif ($request->has('brand')) {
            $brand = Brand::where('slug', $request->brand)->firstOrFail();

            $products = Product::where([
                'brand_id' => $brand->id,
                'status' => 'active',
            ])->when($request->has('range') && request()->range != '', function ($query) use ($request) {
                $price = explode(';', $request->range);
                $startPrice = $price[0];
                $endPrice = $price[1];
                return $query->where('price', '>=', $startPrice)->where('price', '<=', $endPrice);
            })
                ->paginate(12);
        } elseif ($request->has('search')) {

            $products = Product::where(['status' => 'active', 'is_approved' => 'yes'])->where(
                function ($query) use ($request) {
                    $query->where('name', 'like', '%' . $request->search . '%')
                        ->orwhere('long_description', 'like', '%' . $request->search . '%')
                        ->orWhereHas('category', function ($query) use ($request) {
                            $query->where('name', 'like', '%' . $request->search . '%')
                                ->orwhere('long_description', 'like', '%' . $request->search . '%');
                        });
                }
            )
                ->paginate(12);
        } else {

            $products = Product::where([
                'status' => 'active',
                'is_approved' => 'yes'
            ])->orderBy('id', 'DESC')->paginate(12);
        }
        $categories = Category::where('status', 'active')->get();
        $brands = Brand::where(['status' => 'active'])->get();
        return view('frontend.pages.products', compact('brands', 'products', 'categories'));
    }
    //================================================
    public function showProductDetails(string $slug)
    {
        $flashSaleDate = FlashSale::first();

        $product = Product::withAvg('reviews', 'rating')->with(['brand', 'images', 'variants' => function ($query) {
            $query->with('type');
        }])->where('slug', $slug)->where('status', 'active')->first();
        $reviews = ProductReview::where(['product_id' => $product->id, 'status' => 'active'])->paginate(10);

        return view('frontend.pages.show-product-details', compact('reviews', 'product', 'flashSaleDate'));
    }
    //================================================
    public function changeListView(Request $request)
    {
        Session::put('product_list_style', $request->style);
    }
}//end class
