<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\ChildCategoryDataTable;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\ChildCategory;
use App\Models\HomePageSetting;
use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ChildCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ChildCategoryDataTable $dataTable)
    {
        return $dataTable->render('admin.child-category.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        //empty objects to fill fields with empty data in order to not get any error
        $subCategory = new SubCategory();
        $childCategory = new ChildCategory();
        return view('admin.child-category.create', compact('categories', 'subCategory', 'childCategory'));
    }
    //get sub categories-----------------------------------------------------
    public function getSubCategories(Request $request)
    {
        return  SubCategory::where('category_id', $request->id)->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => ['required'],
            'sub_category_id' => ['required'],
            'name' => ['required', 'max:200'],
            'status' => ['required'],
        ]);

        $request['slug'] = Str::slug($request->name);
        ChildCategory::create($request->all());
        toastr('Created Successfully');
        return redirect()->route('admin.child-category.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $childCategory = ChildCategory::findOrFail($id);
        $categories = Category::all();
        $subCategories = SubCategory::where('category_id', $childCategory->category_id)->get();
        return view('admin.child-category.edit', compact('categories', 'childCategory', 'subCategories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'category_id' => ['required'],
            'sub_category_id' => ['required'],
            'name' => ['required', 'max:200'],
            'status' => ['required'],
        ]);

        $childCategory = ChildCategory::findOrFail($id);
        $request['slug'] = Str::slug($request->name);
        $childCategory->update($request->all());
        toastr('Updated Successfully');
        return redirect()->route('admin.child-category.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $childCategory = ChildCategory::findOrFail($id);
        if (Product::where('child_category_id', $childCategory->id)->count() > 0) {
            return response(['status' => 'error', 'message' => 'This category has products, so you cannot delete it']);
        } else {
            $homeSetting = HomePageSetting::all();
            foreach ($homeSetting as $item) {
                $array = json_decode($item->value, true);
                $array = collect($array);
                if ($array->contains('child_category', $childCategory->id)) {
                    return response(['status' => 'error', 'message' => 'This category is on home page, so you cannot delete it']);
                }
            }
        }
        $childCategory->delete();
        toastr('Deleted Successfully');
        return response(['status' => 'success', 'message' => 'Deleted successfully']);
    }

    //change status using ajax request--------------------------------------------------
    public function changeStatus(Request $request)
    {
        $category = ChildCategory::findOrFail($request->id);

        $request->status == "true" ? $category->status = 'active' : $category->status = 'inactive';
        $category->save();

        return response(['message' => 'Status has been updated']);
    }
}
