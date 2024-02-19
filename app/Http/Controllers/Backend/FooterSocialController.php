<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\FooterSocialDataTable;
use App\Http\Controllers\Controller;
use App\Models\FooterSocial;
use Illuminate\Http\Request;

class FooterSocialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(FooterSocialDataTable $dataTable)
    {
        return $dataTable->render('admin.footer.footer-socials.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.footer.footer-socials.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'icon' => ['required', 'max:200'],
            'name' => ['required', 'max:200'],
            'link' => ['required', 'url'],
            'status' => ['in:active,inactive'],
        ]);

        $footerButtons = new FooterSocial();
        $footerButtons->create($request->all());
        toastr('Crated successfully', 'success', 'success');
        return redirect()->route('admin.footer-socials.index');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $footerButtonInfo = FooterSocial::findOrFail($id);
        return view('admin.footer.footer-socials.edit', compact('footerButtonInfo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'icon' => ['required', 'max:200'],
            'name' => ['required', 'max:200'],
            'link' => ['required', 'url'],
            'status' => ['in:active,inactive'],
        ]);

        $footerButtons =  FooterSocial::findOrFail($id);
        $footerButtons->update($request->all());
        toastr('Updated successfully', 'success', 'success');
        return redirect()->route('admin.footer-socials.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $footerButtons =  FooterSocial::findOrFail($id);
        $footerButtons->delete();

        return response(['status' => 'success', 'message' => 'Deleted successfully']);
    }

    //change status using ajax request--------------------------------------------------
    public function changeStatus(Request $request)
    {
        $category = FooterSocial::findOrFail($request->id);

        $request->status == "true" ? $category->status = 'active' : $category->status = 'inactive';
        $category->save();

        return response(['message' => 'Status has been updated']);
    }
}
