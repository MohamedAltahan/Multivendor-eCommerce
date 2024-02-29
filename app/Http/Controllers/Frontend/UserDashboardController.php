<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\ProductReview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserDashboardController extends Controller
{
    public function index()
    {
        $totalOrders = Order::where('user_id', Auth::user()->id)->count();
        $pendingOrders = Order::where(['user_id' => Auth::user()->id, 'order_status' => 'pending'])->count();
        $completedOrders = Order::where(['user_id' => Auth::user()->id, 'order_status' => 'delivered'])->count();
        $reviews = ProductReview::where('user_id', Auth::user()->id)->count();
        return view('frontend.dashboard.dashboard', compact('reviews', 'totalOrders', 'pendingOrders', 'completedOrders'));
    }
}
