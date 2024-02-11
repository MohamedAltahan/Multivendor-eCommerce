<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\HomePageSetting;
use Illuminate\Http\Request;

class HomePageSettingController extends Controller
{
    function index()
    {
        $productCategorySectionOne = HomePageSetting::where('key', 'products_slider_one')->first();
        $categories = Category::where('status', 'active')->get();
        $popularCategorySection = HomePageSetting::where('key', 'popular_category_section')->first();
        return view('admin.home-page-setting.index', compact('productCategorySectionOne', 'categories', 'popularCategorySection'));
    }

    function updatePopularCategorySection(Request $request)
    {
        $request->validate(
            [
                'main_category_one' => ['required'],
                'main_category_two' => ['required'],
                'main_category_three' => ['required'],
                'main_category_four' => ['required'],
            ],
            [
                'main_category_one.required' => 'Category one field is required',
                'main_category_two.required' => 'Category two field is required',
                'main_category_three.required' => 'Category three field is required',
                'main_category_four.required' => 'Category four field is required',
            ]
        );
        $data = [
            [
                'main_category' => $request->main_category_one,
                'sub_category' => $request->sub_category_one,
                'child_category' => $request->child_category_one,
            ],
            [
                'main_category' => $request->main_category_two,
                'sub_category' => $request->sub_category_two,
                'child_category' => $request->child_category_two,
            ],
            [
                'main_category' => $request->main_category_three,
                'sub_category' => $request->sub_category_three,
                'child_category' => $request->child_category_three,
            ],
            [
                'main_category' => $request->main_category_four,
                'sub_category' => $request->sub_category_four,
                'child_category' => $request->child_category_four,
            ],
        ];

        HomePageSetting::updateOrCreate(
            ['key' => 'popular_category_section'],
            ['value' => json_encode($data)]
        );
        toastr('Updated successfully', 'success', 'success');
        return redirect()->back();
    }

    function updateProductsSliderOne(Request $request)
    {
        $request->validate(
            ['main_category' => ['required']],
            ['main_category.required' => 'Category field is required']
        );

        $data = [
            'main_category' => $request->main_category,
            'sub_category' => $request->sub_category,
            'child_category' => $request->child_category,
        ];

        HomePageSetting::updateOrCreate(
            ['key' => 'products_slider_one'],
            ['value' => json_encode($data)]
        );
        toastr('Updated successfully', 'success', 'success');
        return redirect()->back();
    }
}
