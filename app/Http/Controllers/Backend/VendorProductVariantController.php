<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\VendorProductVariantDataTable;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\ProductVariantType;
use App\Models\VariantDetails;
use Illuminate\Http\Request;

class VendorProductVariantController extends Controller
{
    public function index(VendorProductVariantDataTable $dataTable, Request $request)
    {
        $product = Product::findOrFail($request->product_id);
        $venorId = auth()->user()->vendor->id;
        $variantTypes = ProductVariantType::where(['vendor_id' => $venorId, 'status' => 'active'])->get();
        return $dataTable->with(['productId' => $product->id])->render('vendor.product.product-variant.index', compact('product', 'variantTypes'));
    }

    public function create($productId, $variantId)
    {
        $variant = ProductVariant::findOrFail($variantId);
        $product = Product::findOrFail($productId);
        return view('vendor.product.product-variant.create', compact('variant', 'product'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => ['integer', 'required'],
            'product_variant_type_id' => ['integer', 'required'],
            'product_variant_detail_id' => ['integer', 'required'],
            'variant_price' => ['numeric'],
            'is_default' => ['in:yes,no'],
            'status' => ['required', 'in:active,inactive'],
            'quantity' => ['numeric']

        ]);
        $productVariant = new ProductVariant();
        $productVariant->create($request->all());
        toastr('Created successfully');
        return redirect()->back();
    }

    public function edit($variantDetailsId)
    {
        $variantDetails = ProductVariant::findOrFail($variantDetailsId);
        return view('vendor.product.variant-details.edit', compact('variantDetails'));
    }

    public function update(Request $request, $variantDetailsId)
    {
        $request->validate([
            'price' => ['required', 'numeric'],
            'variant_value' => ['required', 'max:200'],
            'is_default' => ['required'],
            'status' => ['required'],
        ]);

        $variantValue =  ProductVariant::findOrFail($variantDetailsId);
        $variantValue->update($request->all());
        toastr('Updated successfully');
        return redirect()->route('vendor.product.product-variant-details.index', ['productId' => $variantValue->productVariant->product_id, 'variantId' => $variantValue->product_variant_type_id]);
    }
    //change status using ajax request--------------------------------------------------
    public function changeStatus(Request $request)
    {
        $variant = ProductVariant::findOrFail($request->id);

        $request->status == "true" ? $variant->status = 'active' : $variant->status = 'inactive';
        $variant->save();

        return response(['message' => 'Status has been updated']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $variant = ProductVariant::findOrFail($id);
        $variant->delete();
        return response(['status' => 'success', 'message' => 'Deleted successfully']);
    }

    //======================================================================
    function getVariantDetails(Request $request)
    {
        return  VariantDetails::where(['product_variant_type_id' => $request->id, 'status' => 'active'])->get();
    }
}
