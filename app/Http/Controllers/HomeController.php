<?php

namespace App\Http\Controllers;

use App\Models\Comments;
use App\Models\LandingPost;
use App\Models\Slider;
// use App\Models\Setting;
use App\Models\UserSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use SplSubject;
use Stevebauman\Location\Facades\Location;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        return view('frontend.base');
    }

    public function about(Request $request)
    {
        return view('frontend.base');
    }

    public function forgotpass(Request $request)
    {
        return view('backend.auth.forgot-password');
    }

    public function sendmail(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required'
        ]);

        $data = array(
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
            'subject' => $request->subject,
        );

        Mail::send('layouts.frontend.pages.sendmail', $data, function ($message) use ($request) {

            $message->from($request->email, $request->name);
            $message->to('admin@sandalmely.com')->subject($request->subject);
        });

        return back()->with('success', 'Thanks for contacting me, I will get back to you soon!');
    }
}
