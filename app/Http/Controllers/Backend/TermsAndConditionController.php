<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\TermsAndCondition;
use Illuminate\Http\Request;

class TermsAndConditionController extends Controller
{
    function index()
    {
        $content = TermsAndCondition::first();
        return view('admin.terms.index', compact('content'));
    }
    //============================================================
    function update(Request $request)
    {
        $request->validate([
            'content' => ['required']
        ]);

        TermsAndCondition::updateOrCreate(
            ['id' => 1],
            [
                'content' => $request->content
            ]
        );
        toastr('Updated successfully!', 'success', 'success');
        return redirect()->back();
    }
}
