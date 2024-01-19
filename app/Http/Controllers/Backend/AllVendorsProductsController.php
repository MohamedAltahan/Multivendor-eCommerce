<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\AllVendorsDataTable;
use App\DataTables\PendingProductsDataTable;
use App\DataTables\ShowVendorProductsDataTable;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Vendor;
use Illuminate\Http\Request;

class AllVendorsProductsController extends Controller
{
    public function index(AllVendorsDataTable $dataTable)
    {
        // $allVendors = Vendor::get();
        return $dataTable->render('admin.product.all-vendors.index');
    }

    public function getVendorProducts(ShowVendorProductsDataTable $dataTable, $vendorId)
    {
        $vendor = Vendor::where('id', $vendorId)->first();
        return $dataTable->with(['vendorId' => $vendorId])->render('admin.product.vendor-products.index', compact('vendor'));
    }

    public function pendingProducts(PendingProductsDataTable $dataTable)
    {
        return $dataTable->render('admin.product.pending-products.index');
    }

    public function changeApprovalStatus(Request $request)
    {
        $product = Product::findOrFail($request->productId);
        $product->is_approved = $request->selectionValue;
        $product->save();
        return response(['message' => 'Product approval changed', 'status' => 'success']);
    }
}
