<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\ProductVariantDataTable;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\ProductVariantDetails;
use App\Models\ProductVariantType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductVariantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, ProductVariantDataTable $dataTable)
    {

        $product = Product::findOrFail($request->product_id);
        return $dataTable->render('admin.product.product-variant.index', compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $product = Product::findOrFail($request->product_id);
        return view('admin.product.product-variant.create', compact('product'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => ['required', 'max:200'],
            'status' => ['required']
        ]);
        $request['vendor_id'] = Auth::user()->vendor->id;
        $variant = new ProductVariantType();
        $variant->create($request->all());
        toastr('Created successfully');
        return redirect()->route('admin.product-variant.index', ['product_id' => $request->product_id]);
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
        $variant = ProductVariantType::findOrFail($id);
        return view('admin.product.product-variant.edit', compact('variant'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $request->validate([
            'name' => ['required', 'max:200'],
            'status' => ['required']
        ]);
        $variant =  ProductVariantType::findOrFail($id);
        $variant->update($request->all());
        toastr('Updated Successfully');
        return redirect()->route('admin.product-variant.index', ['product_id' => $variant->id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $variant = ProductVariantType::findOrFail($id);
        $variantValuesCheckExist = ProductVariantDetails::where('product_variant_type_id', $variant->id)->count();
        if ($variantValuesCheckExist > 0) {
            return response(['status' => 'error', 'message' => 'this variant contains items inside, you must delete them first']);
        }
        $variant->delete();
        return response(['status' => 'success', 'message' => 'Deleted successfully']);
    }

    //change status using ajax request--------------------------------------------------
    public function changeStatus(Request $request)
    {
        $variant = ProductVariantType::findOrFail($request->id);

        $request->status == "true" ? $variant->status = 'active' : $variant->status = 'inactive';
        $variant->save();

        return response(['message' => 'Status has been updated']);
    }

    //upload attibute image
    public function uploadAttributeImage(Request $request)
    {
    }
}
