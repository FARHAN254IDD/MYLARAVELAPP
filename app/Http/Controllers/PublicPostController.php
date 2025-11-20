<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Purchase;

class PublicPostController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->paginate(10);
        return view('public.posts.index', compact('posts'));
    }

    public function show(Post $post)
    {
        $user = auth()->user();
        $hasPurchased = false;

        if ($user) {
            $hasPurchased = Purchase::where('user_id', $user->id)
                ->where('post_id', $post->id)
                ->where('status', 'paid')
                ->exists();
        }

        return view('public.posts.show', compact('post', 'hasPurchased'));
    }
}
