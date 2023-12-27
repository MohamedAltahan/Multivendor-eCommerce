<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $sliders = Slider::where('status', 'active')->orderBy('serial', 'ASC')->get();
        return view('frontend.home.home', compact('sliders'));
    }
}
