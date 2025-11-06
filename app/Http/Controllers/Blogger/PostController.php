<?php

namespace App\Http\Controllers\Blogger;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    // Display all posts by logged-in blogger
    public function index()
    {
        $posts = Post::where('user_id', Auth::id())
            ->latest()
            ->paginate(6);

        return view('blogger.posts.index', compact('posts'));
    }

    // Show form for creating new post
    public function create()
    {
        return view('blogger.posts.create');
    }

    // Store post in database
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'price' => 'nullable|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('posts', 'public');
        }

        $validated['user_id'] = Auth::id();
        $validated['status'] = 'pending';

        Post::create($validated);

        return redirect()->route('blogger.posts.index')->with('success', 'Post created successfully!');
    }

    // Edit post
    public function edit(Post $post)
    {
        if ($post->user_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        return view('blogger.posts.edit', compact('post'));
    }

    // Update post
    public function update(Request $request, Post $post)
    {
        if ($post->user_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'price' => 'nullable|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($post->image) {
                Storage::disk('public')->delete($post->image);
            }
            $validated['image'] = $request->file('image')->store('posts', 'public');
        }

        $post->update($validated);

        return redirect()->route('blogger.posts.index')->with('success', 'Post updated successfully!');
    }

    // Delete post
    public function destroy(Post $post)
    {
        if ($post->user_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        if ($post->image) {
            Storage::disk('public')->delete($post->image);
        }

        $post->delete();

        return redirect()->route('blogger.posts.index')->with('success', 'Post deleted successfully!');
    }
}
