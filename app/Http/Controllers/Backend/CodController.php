<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Codsetting;
use Illuminate\Http\Request;

class CodController extends Controller
{
    public function update(Request $request, string $id)
    {
        $request->validate([
            'status' => ['required', 'in:enable,disable'],
        ]);

        Codsetting::updateOrCreate(
            ['id' => $id],
            $request->all()
        );
        toastr('Updated Successfully', 'success', 'success');
        return redirect()->back();
    }
}
