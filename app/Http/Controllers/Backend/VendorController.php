<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductReview;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VendorController extends Controller
{
    public function dashboard()
    {
        $todayOrders = Order::whereDate('created_at', Carbon::today())->whereHas('orderProducts', function ($query) {
            $query->where('vendor_id', Auth::user()->vendor->id);
        })->count();
        $todayPendingOrders = Order::whereDate('created_at', Carbon::today())
            ->where('order_status', 'pending')
            ->whereHas('orderProducts', function ($query) {
                $query->where('vendor_id', Auth::user()->vendor->id);
            })->count();
        $totalPendingOrders = Order::where('order_status', 'pending')
            ->whereHas('orderProducts', function ($query) {
                $query->where('vendor_id', Auth::user()->vendor->id);
            })->count();
        $totalCompletedOrders = Order::where('order_status', 'delivered')
            ->whereHas('orderProducts', function ($query) {
                $query->where('vendor_id', Auth::user()->vendor->id);
            })->count();
        $totalOrders = Order::whereHas('orderProducts', function ($query) {
            $query->where('vendor_id', Auth::user()->vendor->id);
        })->count();
        $todaySales = Order::whereDate('created_at', Carbon::today())
            ->where('order_status', 'delivered')
            ->whereHas('orderProducts', function ($query) {
                $query->where('vendor_id', Auth::user()->vendor->id);
            })->sum('sub_total');
        $thisMonthSales = Order::whereMonth('created_at', Carbon::today()->month)
            ->where('order_status', 'delivered')
            ->whereHas('orderProducts', function ($query) {
                $query->where('vendor_id', Auth::user()->vendor->id);
            })->sum('sub_total');
        $thisYearSales = Order::whereYear('created_at', Carbon::today()->year)
            ->where('order_status', 'delivered')
            ->whereHas('orderProducts', function ($query) {
                $query->where('vendor_id', Auth::user()->vendor->id);
            })->sum('sub_total');
        $totalSales = Order::where('order_status', 'delivered')
            ->whereHas('orderProducts', function ($query) {
                $query->where('vendor_id', Auth::user()->vendor->id);
            })->sum('sub_total');
        $reviews = ProductReview::whereHas('product', function ($query) {
            $query->where('vendor_id', Auth::user()->id);
        })->count();
        $allProducts = Product::where('vendor_id', Auth::user()->id)->count();
        return view('vendor.dashboard.dashboard', compact(
            'todayOrders',
            'totalPendingOrders',
            'todayPendingOrders',
            'totalOrders',
            'totalCompletedOrders',
            'allProducts',
            'todaySales',
            'thisMonthSales',
            'thisYearSales',
            'totalSales',
            'reviews'
        ));
    }
}
