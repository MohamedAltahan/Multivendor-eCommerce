<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\VendorOrderDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VendorOrderController extends Controller
{
    function index(VendorOrderDataTable $dataTable)
    {
        return $dataTable->render('vendor.order.index');
    }
}
