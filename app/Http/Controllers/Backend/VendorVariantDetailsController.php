<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\VendorVariantDetailsDataTable;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\ProductVariantType;
use App\Models\VariantDetails;
use Illuminate\Http\Request;

class VendorVariantDetailsController extends Controller
{
    public function index(VendorVariantDetailsDataTable $dataTable, $variantId)
    {
        $variant = ProductVariantType::findOrFail($variantId);
        return $dataTable->render('vendor.product.variant-details.index', compact('variant'));
    }

    public function create($variantId)
    {
        $variant = ProductVariantType::findOrFail($variantId);
        return view('vendor.product.variant-details.create', compact('variant'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_variant_type_id' => ['required', 'integer'],
            'variant_value' => ['required', 'max:200'],
            'status' => ['required'],
        ]);

        $variantValues = new VariantDetails();
        $variantValues->create($request->all());
        toastr('Created successfully');
        return redirect()->route('vendor.product.variant-details.index', ['variantId' => $request->product_variant_type_id]);
    }

    public function edit($variantDetailsId)
    {
        $variantDetails = VariantDetails::findOrFail($variantDetailsId);
        return view('vendor.product.variant-details.edit', compact('variantDetails'));
    }

    public function update(Request $request, $variantDetailsId)
    {
        $request->validate([
            'variant_value' => ['required', 'max:200'],
            'status' => ['required'],
        ]);

        $variantValue =  VariantDetails::findOrFail($variantDetailsId);
        $variantValue->update($request->all());
        toastr('Updated successfully');
        return redirect()->route('vendor.product.variant-details.index', ['variantId' => $variantValue->product_variant_type_id]);
    }
    //change status using ajax request--------------------------------------------------
    public function changeStatus(Request $request)
    {
        $variant = VariantDetails::findOrFail($request->id);
        $request->status == "true" ? $variant->status = 'active' : $variant->status = 'inactive';
        $variant->save();

        return response(['message' => 'Status has been updated']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $variant = VariantDetails::findOrFail($id);
        $productVarinatDetail = ProductVariant::where('product_variant_detail_id', $id)->first();
        if ($productVarinatDetail != null) {
            return response(['status' => 'error', 'message' => 'This variant has product, delete the product first']);
        }
        $variant->delete();
        return response(['status' => 'success', 'message' => 'Deleted successfully']);
    }
}
