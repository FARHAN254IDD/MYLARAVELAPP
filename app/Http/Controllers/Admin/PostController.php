<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\storage;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::latest()->paginate(6);
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('posts', 'public');
        }

        Post::create($validated);

        return redirect()->route('admin.posts.index')->with('success', 'Post created successfully.');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        return view('admin.posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
         $validated = $request->validate([
            'title' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($post->image && Storage::disk('public')->exists($post->image)) {
                Storage::disk('public')->delete($post->image);
            }
            $validated['image'] = $request->file('image')->store('posts', 'public');
        }

        $post->update($validated);

        return redirect()->route('admin.posts.index')->with('success', 'Post updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        if ($post->image && Storage::disk('public')->exists($post->image)) {
            Storage::disk('public')->delete($post->image);
        }

        $post->delete();

        return redirect()->route('admin.posts.index')->with('success', 'Post deleted successfully!');
    }

  public function approve($id)
{
    $post = Post::findOrFail($id);
    $post->status = 'approved';
    $post->save();

    // Optional: send notification to blogger
    $user = $post->user;
    $notifications = json_decode($user->notifications ?? '[]', true);
    $notifications[] = [
        'message' => "Your post '{$post->title}' has been approved!",
        'type' => 'success',
        'time' => now()->toDateTimeString(),
    ];
    $user->notifications = json_encode($notifications);
    $user->save();

    return back()->with('success', 'Post approved successfully.');
}

public function reject($id)
{
    $post = Post::findOrFail($id);
    $post->status = 'rejected';
    $post->save();

    // Optional: send notification
    $user = $post->user;
    $notifications = json_decode($user->notifications ?? '[]', true);
    $notifications[] = [
        'message' => "Your post '{$post->title}' has been rejected.",
        'type' => 'error',
        'time' => now()->toDateTimeString(),
    ];
    $user->notifications = json_encode($notifications);
    $user->save();

    return back()->with('success', 'Post rejected successfully.');
}


}
