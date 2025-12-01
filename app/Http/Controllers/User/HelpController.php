<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

class HelpController extends Controller
{
    public function index()
    {
        return view('user.help.index');
    }

     public function submit(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        // Example: send email to support (you can customize)
        // Mail::to('support@example.com')->send(new SupportMail($request->message));

        // Or save to database table for support tickets
        // SupportTicket::create([
        //     'user_id' => auth()->id(),
        //     'message' => $request->message,
        // ]);

        return back()->with('success', 'Your message has been submitted. Our team will contact you soon.');
    }
}
