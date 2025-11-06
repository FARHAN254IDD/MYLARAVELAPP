<?php

namespace App\Http\Controllers\Blogger;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $myPostsCount = Post::where('user_id', $user->id)->count();
        $approvedPosts = Post::where('user_id', $user->id)->where('status', 'approved')->count();
        $pendingPosts = Post::where('user_id', $user->id)->where('status', 'pending')->count();
        $commentsCount = \App\Models\Comment::whereHas('post', fn($q) => $q->where('user_id', $user->id))->count();

        return view('blogger.dashboard', compact('myPostsCount', 'approvedPosts', 'pendingPosts', 'commentsCount'));
    }
}
