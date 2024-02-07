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
        $categories = Category::where('status', 'active')->get();
        $popularCategorySection = HomePageSetting::where('key', 'popular_category_section')->first();
        return view('admin.home-page-setting.index', compact('categories', 'popularCategorySection'));
    }

    function updatePopularCategorySection(Request $request)
    {
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
}
