<?php

namespace App\Http\Controllers\Backend;


use App\DataTables\VendorProductReviewsDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VendorProductReviewController extends Controller
{
    function index(VendorProductReviewsDataTable $dataTable)
    {
        return $dataTable->render('vendor.review.index');
    }
}
