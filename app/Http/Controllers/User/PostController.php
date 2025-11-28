<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Purchase;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::where('status', 'approved')->latest()->paginate(10);
        return view('user.posts.index', compact('posts'));
    }

    public function show($id)
{
    $post = Post::findOrFail($id);

    // Check if the user has already purchased the post
    $hasPurchased = Purchase::where('user_id', auth()->id())
        ->where('post_id', $post->id)
        ->exists();

    return view('user.posts.show', compact('post', 'hasPurchased'));
}


    public function buy(Post $post)
    {
        Purchase::create([
            'user_id' => auth()->id(),
            'post_id' => $post->id,
            'status' => 'paid',
        ]);

        return back()->with('success', "You have purchased this post");
    }
}
