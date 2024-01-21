<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\FlashSaleItemDataTable;
use App\Http\Controllers\Controller;
use App\Models\FlashSale;
use Illuminate\Http\Request;

class FlashSaleController extends Controller
{
    public function index(FlashSaleItemDataTable $dataTable)
    {
        $flashSale = FlashSale::first();
        return $dataTable->render('admin.flash-sale.index', compact('flashSale'));
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
}
