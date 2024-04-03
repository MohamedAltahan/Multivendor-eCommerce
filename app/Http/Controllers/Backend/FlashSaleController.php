<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\FlashSaleItemDataTable;
use App\Http\Controllers\Controller;
use App\Models\FlashSale;
use App\Models\FlashSaleItem;
use App\Models\FrontendSection;
use App\Models\Product;
use Illuminate\Http\Request;

class FlashSaleController extends Controller
{
    public function index(FlashSaleItemDataTable $dataTable)
    {
        $flashSaleDate = FlashSale::first();
        $products = Product::where('is_approved', 'yes')->where('status', 'active')->orderBy('id', 'DESC')->get();
        $section = FrontendSection::first()->value;
        $sectionStatus = @json_decode($section)->flashSale;
        return $dataTable->render('admin.flash-sale.index', compact('sectionStatus', 'flashSaleDate', 'products'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'end_flash_date' => ['required'],
        ]);
        FlashSale::updateOrCreate(['id' => 1], ['end_flash_date' => $request->end_flash_date]);
        toastr('Update Successfully', 'success', 'success');
        return redirect()->back();
    }

    public function addProduct(Request $request)
    {
        $request->validate([
            'product_id' => ['required', 'unique:flash_sale_items,product_id'],
            'show_at_home' => ['required'],
            'status' => ['required']
        ], ['product_id.unique' => 'The product alredy added to flash sale']);

        $flashSaleItem = new FlashSaleItem();
        $flashSaleDate = FlashSale::first();
        $request['flash_sale_id'] = @$flashSaleDate->id;
        $flashSaleItem->create($request->all());
        toastr('Product added Successfully', 'success', 'success');
        return redirect()->back();
    }

    public function changeShowAtHomeStatus(Request $request)
    {
        $flashSaleItem = FlashSaleItem::findOrFail($request->id);
        $request->show_at_home == "true" ? $flashSaleItem->show_at_home = 'yes' : $flashSaleItem->show_at_home = 'no';
        $flashSaleItem->save();

        return response(['message' => 'Status has been updated']);
    }

    //change status using ajax request--------------------------------------------------
    public function changeStatus(Request $request)
    {
        $flashSaleItem = FlashSaleItem::findOrFail($request->id);

        $request->status == "true" ? $flashSaleItem->status = 'active' : $flashSaleItem->status = 'inactive';
        $flashSaleItem->save();

        return response(['message' => 'Status has been updated']);
    }

    //delete flash sale product
    public function destroy($id)
    {
        $flashSaleItem = FlashSaleItem::findOrFail($id);
        $flashSaleItem->delete();
        return response(['status' => 'success', 'message' => 'Deleted successfully']);
    }
}
