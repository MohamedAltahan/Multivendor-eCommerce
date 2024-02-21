<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\NewsLetterSubscriberDataTable;
use App\Http\Controllers\Controller;
use App\Mail\NewsLetter;
use App\Models\NewsLetterSubscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SubscriberController extends Controller
{

    function index(NewsLetterSubscriberDataTable $dataTable)
    {
        return $dataTable->render('admin.subscriber.index');
    }

    function destroy($id)
    {
        $subscriber = NewsLetterSubscriber::findOrFail($id)->delete();
        return response(['status' => 'success', 'message' => 'Deleted successfully']);
    }

    function sendMail(Request $request)
    {
        $request->validate([
            'subject' => ['required'],
            'message' => ['required']
        ]);
        $emails = NewsLetterSubscriber::where('is_verified', 'yes')->pluck('email')->toArray();
        Mail::to($emails)->send(new NewsLetter($request->subject, $request->message));
        toastr('Mail has sent subscriber');
        return redirect()->back();
    }
}
