<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VendorMessageController extends Controller
{
    function index()
    {
        return view('vendor.messanger.index');
    }
}
