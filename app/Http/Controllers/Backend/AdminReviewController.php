<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\AdminReviewDataTable;
use App\Http\Controllers\Controller;
use App\Models\ProductReview;
use Illuminate\Http\Request;

class AdminReviewController extends Controller
{
    function index(AdminReviewDataTable $dataTable)
    {
        return $dataTable->render('admin.product.review.index');
    }

    //change status using ajax request====================================================
    public function changeStatus(Request $request)
    {
        $review = ProductReview::findOrFail($request->id);

        $request->status == "true" ? $review->status = 'active' : $review->status = 'inactive';
        $review->save();

        return response(['message' => 'Status has been updated']);
    }
}
