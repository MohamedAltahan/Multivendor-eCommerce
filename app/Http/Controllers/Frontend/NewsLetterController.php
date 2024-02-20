<?php

namespace App\Http\Controllers\Frontend;

use App\Helper\MailHelper;
use App\Http\Controllers\Controller;
use App\Mail\SubscriptionVarification;
use App\Models\NewsLetterSubscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class NewsLetterController extends Controller
{
    function newsLetterSubscribe(Request $request)
    {
        $request->validate([
            'subscriber_email' => ['required', 'email'],
        ]);
        $subscriber = NewsLetterSubscriber::where('email', $request->subscriber_email)->first();

        if (!empty($subscriber)) {
            if ($subscriber->is_verified == 'no') {
                //resend verification code
                $subscriber->verified_token = Str::random(25);
                $subscriber->save();
                //set email configuration
                MailHelper::setMailConfig();
                //send email
                Mail::to($subscriber->email)->send(new SubscriptionVarification($subscriber));
                return response(['status' => 'success', 'message' => 'varification code has
                sent to your email please check it']);
            } elseif ($subscriber->is_verified == 'yes') {
                return response(['status' => 'error', 'message' => 'This email already subscribed']);
            }
        } else {
            $subscriber = new NewsLetterSubscriber();
            $subscriber->email = $request->subscriber_email;
            $subscriber->verified_token = Str::random(25);
            $subscriber->is_verified = 'no'; //by default 'no'
            $subscriber->save();
            //set email configuration
            MailHelper::setMailConfig();
            //send email
            Mail::to($subscriber->email)->send(new SubscriptionVarification($subscriber));
            return response(['status' => 'success', 'message' => 'varification code has sent
             to your email please check it']);
        }
    }

    function newsLetterEmailVerification($token)
    {
        $verify = NewsLetterSubscriber::where('verified_token', $token)->first();
        if ($verify) {
            $verify->verified_token = 'verified';
            $verify->is_verified = 'yes';
            $verify->save();
            toastr('Email verified successfully', 'success', 'success');
            return redirect()->route('home');
        } else {
            toastr('Invalid token', 'error', 'error');
            return redirect()->route('home');
        }
    }
}
