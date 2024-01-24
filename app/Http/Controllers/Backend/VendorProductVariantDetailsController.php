<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\VendorProductVariantDetailsDataTable;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\ProductVariantDetails;
use Illuminate\Http\Request;

class VendorProductVariantDetailsController extends Controller
{
    public function index(VendorProductVariantDetailsDataTable $dataTable, $productId, $variantId)
    {
        $product = Product::findOrFail($productId);
        $variant = ProductVariant::findOrFail($variantId);
        return $dataTable->render('vendor.product.variant-details.index', compact('product', 'variant'));
    }

    public function create($productId, $variantId)
    {
        $variant = ProductVariant::findOrFail($variantId);
        $product = Product::findOrFail($productId);
        return view('vendor.product.variant-details.create', compact('variant', 'product'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_variant_type_id' => ['required', 'integer'],
            'product_id' => ['required', 'integer'],
            'price' => ['required', 'numeric'],
            'variant_value' => ['required', 'max:200'],
            'is_default' => ['required'],
            'status' => ['required'],
        ]);

        $variantValues = new ProductVariantDetails();
        $variantValues->create($request->all());
        toastr('Created successfully');
        return redirect()->route('vendor.product.product-variant-details.index', ['productId' => $request->product_id, 'variantId' => $request->product_variant_type_id]);
    }

    public function edit($variantDetailsId)
    {
        $variantDetails = ProductVariantDetails::findOrFail($variantDetailsId);
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

        $variantValue =  ProductVariantDetails::findOrFail($variantDetailsId);
        $variantValue->update($request->all());
        toastr('Updated successfully');
        return redirect()->route('vendor.product.product-variant-details.index', ['productId' => $variantValue->productVariant->product_id, 'variantId' => $variantValue->product_variant_type_id]);
    }
    //change status using ajax request--------------------------------------------------
    public function changeStatus(Request $request)
    {
        $variant = ProductVariantDetails::findOrFail($request->id);

        $request->status == "true" ? $variant->status = 'active' : $variant->status = 'inactive';
        $variant->save();

        return response(['message' => 'Status has been updated']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $variant = ProductVariantDetails::findOrFail($id);
        $variant->delete();
        return response(['status' => 'success', 'message' => 'Deleted successfully']);
    }
}
