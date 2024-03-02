<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    function index()
    {
        $wishlistProducts = Wishlist::with(['product' => function ($query) {
            $query->with('firstImage');
        }])->where('user_id', Auth::user()->id)->get();
        return view('frontend.pages.wishlist', compact('wishlistProducts'));
    }
    //=====================================================
    function addToWishlist(Request $request)
    {
        if (!Auth::check()) {
            return response(['status' => 'error', 'message' => 'please login before add to wishlist']);
        }
        $wishlistCount = Wishlist::where(['product_id' => $request->product_id, 'user_id' => Auth::user()->id])->count();
        if ($wishlistCount > 0) {
            return response(['status' => 'error', 'message' => 'Product already at wishlist']);
        }
        $wishlist = new Wishlist();
        $wishlist->product_id = $request->product_id;
        $wishlist->user_id = Auth::user()->id;
        $wishlist->save();
        return response(['status' => 'success', 'message' => 'Product add to wishlist']);
    }

    function destroy($id)
    {
        $wishlistProduct = Wishlist::findOrFail($id);

        if (!$wishlistProduct->user_id == Auth::user()->id) {
            toastr('product not exist', 'error', 'error');
            return redirect()->back();
        }

        $wishlistProduct->delete();
        toastr('product removed successfully', 'success', 'success');
        return redirect()->back();
    }
}
