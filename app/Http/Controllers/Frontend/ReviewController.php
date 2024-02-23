<?php

namespace App\Http\Controllers\Frontend;

use App\DataTables\UserProductReviewsDataTable;
use App\Http\Controllers\Controller;
use App\Models\ProductReview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{

    function index(UserProductReviewsDataTable $dataTabel)
    {
        return $dataTabel->render('frontend.review.index');
    }
    function create(Request $request)
    {
        $request->validate([
            'rating' => ['required'],
            'review' => ['required', 'max:450'],
            'image.*' => ['image']
        ]);

        $userId = Auth::user()->id;
        $checkReviewExist = ProductReview::where(['product_id' => $request->product_id, 'user_id' => $userId])->first();
        if ($checkReviewExist) {
            toastr('You already added a review for this product', 'error', 'error');
            return redirect()->back();
        }

        $productReview = new ProductReview();
        $productReview->product_id = $request->product_id;
        $productReview->vendor_id = $request->vendor_id;
        $productReview->user_id = $userId;
        $productReview->rating = $request->rating;
        $productReview->review = $request->review;
        $productReview->status = 'inactive';
        $productReview->save();

        toastr('Review added successfully', 'success', 'success');
        return redirect()->back();
    }
}
