<?php

namespace App\Http\Controllers\Blogger;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function clear(Request $request)
    {
        $user = Auth::user();
        $user->notifications = []; // clear all notifications
        $user->save();

        return redirect()->back()->with('success', 'Notification cleared.');
    }
}
