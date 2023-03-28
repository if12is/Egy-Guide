<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Mail\TestMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function sendMail()
    {
        $details = [
            'title' => 'Mail from ItSolutionStuff.com',
            'body' => 'This is for testing email using smtp'
        ];
        $user = Auth::user();
        Mail::to($user->email)->send(new TestMail($user, $details));
        // Mail::to(' receiver email ')->send(new \App\Mail\TestMail($details));

        dd("Email is Sent.");
        return redirect()->back()->with('message', 'Email sent successfully!');
    }
}
