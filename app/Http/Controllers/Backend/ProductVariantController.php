<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\ProductVariantDataTable;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\VariantDetails;
use App\Models\ProductVariantType;
use Illuminate\Http\Request;

class ProductVariantController extends Controller
{
    function index(Request $request, ProductVariantDataTable $dataTable)
    {

        $product = Product::findOrFail($request->productId);
        $venorId = auth('admin')->user()->vendor->id;
        $variantTypes = ProductVariantType::where(['vendor_id' => $venorId, 'status' => 'active'])->get();
        return $dataTable->with(['productId' => $product->id])->render('admin.product.product-variant-details.index', compact('product', 'variantTypes'));
    }
    //=================================================================
    function store(Request $request)
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
    //======================================================================
    function getVariantDetails(Request $request)
    {
        return  VariantDetails::where(['product_variant_type_id' => $request->id, 'status' => 'active'])->get();
    }

    //destroy=================================================================
    function destroy($id)
    {
        $productVariant = ProductVariant::findOrFail($id);
        $productVariant->delete();
        return response(['status' => 'success', 'message' => 'Deleted successfully']);
    }

    //change status using ajax request===================================================
    public function changeStatus(Request $request)
    {
        $variant = ProductVariant::findOrFail($request->id);

        $request->status == "true" ? $variant->status = 'active' : $variant->status = 'inactive';
        $variant->save();

        return response(['message' => 'Status has been updated']);
    }
}
