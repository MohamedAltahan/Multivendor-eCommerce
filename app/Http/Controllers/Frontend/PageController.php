<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\Contact;
use App\Models\About;
use App\Models\BecomeVendor;
use App\Models\EmailConfiguration;
use App\Models\TermsAndCondition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PageController extends Controller
{
    function about()
    {
        $content = About::first();
        return view('frontend.pages.about', compact('content'));
    }

    function becomeVendor()
    {
        $content = BecomeVendor::first();
        return view('frontend.pages.about', compact('content'));
    }

    function termsAndConditions()
    {
        $termsAndConditions = TermsAndCondition::first();
        return view('frontend.pages.terms-and-condtions', compact('termsAndConditions'));
    }

    function contact()
    {
        return view('frontend.pages.contact');
    }

    function handleContactForm(Request $request)
    {
        $request->validate([
            'name' => ['required', 'max:200'],
            'email' => ['required', 'email'],
            'subject' => ['required', 'max:200'],
            'message' => ['required', 'max:1000'],
        ]);
        $setting = EmailConfiguration::first();
        Mail::to($setting->sender_email)->send(new Contact($request->subject, $request->message, $request->email));
        return response(['status' => 'success', 'message' => 'Mail sent successfully']);
    }
}
