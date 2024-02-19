<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\FooterGridTwoLinkDataTable;
use App\Http\Controllers\Controller;
use App\Models\FooterGridTwoLink;
use App\Models\footerTitle;
use Illuminate\Http\Request;

class FooterGridTwoLinkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(FooterGridTwoLinkDataTable $dataTable)
    {
        $footerTitleSctionTwo = footerTitle::first();
        return $dataTable->render('admin.footer.footer-grid-two.index', compact('footerTitleSctionTwo'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.footer.footer-grid-two.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'max:200'],
            'link' => ['required', 'url'],
            'status' => ['in:active,inactive'],
        ]);

        $footeritem = new FooterGridTwoLink();
        $footeritem->create($request->all());
        toastr('Crated successfully', 'success', 'success');
        return redirect()->route('admin.footer-grid-two.index');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $footerItem = FooterGridTwoLink::findOrFail($id);
        return view('admin.footer.footer-grid-two.edit', compact('footerItem'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => ['required', 'max:200'],
            'link' => ['required', 'url'],
            'status' => ['in:active,inactive'],
        ]);

        $footeritem =  FooterGridTwoLink::findOrFail($id);
        $footeritem->update($request->all());
        toastr('Crated successfully', 'success', 'success');
        return redirect()->route('admin.footer-grid-two.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $footerButtons =  FooterGridTwoLink::findOrFail($id);
        $footerButtons->delete();

        return response(['status' => 'success', 'message' => 'Deleted successfully']);
    }

    //change status using ajax request--------------------------------------------------
    public function changeStatus(Request $request)
    {
        $category = FooterGridTwoLink::findOrFail($request->id);

        $request->status == "true" ? $category->status = 'active' : $category->status = 'inactive';
        $category->save();

        return response(['message' => 'Status has been updated']);
    }

    //==========================================================================
    public function changeTitle(Request $request)
    {
        $request->validate([
            'title' => ['required', 'max:200'],
        ]);

        footerTitle::updateOrCreate(
            ['id' => 1],
            ['footer_section_two_title' => $request->title]
        );
        toastr('Updated Successfully', 'success', 'success');
        return redirect()->back();
    }
}
