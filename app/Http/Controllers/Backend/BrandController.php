<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\BrandDataTable;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Product;
use App\Traits\fileUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BrandController extends Controller
{
    use fileUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(BrandDataTable $dataTabel)
    {
        return $dataTabel->render('admin.brand.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.brand.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'logo' => ['image', 'required', 'max:2048'],
            'name' => ['required', 'max:200'],
            'is_featured' => ['in:yes,no'],
            'status' => ['in:active,inactive']
        ]);
        $brand = $request->except('logo');
        $brand['logo'] = $this->fileUplaod($request, 'myDisk', 'brand', 'logo');
        $brand['slug'] = Str::slug($request->name);
        Brand::create($brand);
        toastr('Created successfully');
        return redirect()->route('admin.brand.index');
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
        $brand = Brand::find($id);
        if (!isset($brand)) {
            toastr('Item not found', 'error');
            return redirect()->back();
        }
        return view('admin.brand.edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'logo' => ['image', 'max:2048'],
            'name' => ['required', 'max:200'],
            'is_featured' => ['in:yes,no'],
            'status' => ['in:active,inactive']
        ]);
        $brand = Brand::find($id);
        $oldLogePath = $brand->logo;
        $brandDate = $request->except('logo');
        if ($request->hasFile('logo')) {
            $brandDate['logo'] = $this->fileUpdate($request, 'myDisk', 'brand', 'logo', $oldLogePath);
        }
        $request['slug'] = Str::slug($request->name);
        $brand->update($brandDate);
        toastr('Updated successfully');
        return redirect()->route('admin.brand.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $brand = Brand::findOrFail($id);
        if (Product::where('brand_id', $brand->id)->count() > 0) {
            return response(['status' => 'error', 'message' => 'This brand has products, so you cannot delete it']);
        }
        $brand->delete();
        $logo = $brand->logo;
        $this->deleteFile('myDisk', $logo);
        return response(['status' => 'success', 'message' => 'Deleted successfully']);
    }
    //change status using ajax request--------------------------------------------------
    public function changeStatus(Request $request)
    {
        $category = Brand::findOrFail($request->id);

        $request->status == "true" ? $category->status = 'active' : $category->status = 'inactive';
        $category->save();

        return response(['message' => 'Status has been updated']);
    }
}
