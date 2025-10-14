<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BlogController extends Controller
{
   public function index () {
    $posts = [
        (object)[ 'id' => 1, 'title' => 'Welcome to Tailwind', 'content' => 'Tailwind CSS is a utility-first framework...', 'image' => '/images/code.jpg' ],
        (object)[ 'id' => 2, 'title' => 'Laravel & Tailwind', 'content' => 'Combining Laravel with Tailwind gives great flexibility...', 'image' => '/images/laravel.jpg' ],
        (object)[ 'id' => 3, 'title' => 'Modern UI Design', 'content' => 'With Tailwind, you can quickly create responsive interfaces...', 'image' => '/images/design soft.jpg' ],
    ];
    return view('blog', compact('posts'));
}

public function show ($id) {
    $posts = [
        1 => (object)[ 'id' => 1, 'title' => 'Welcome to Tailwind', 'content' => 'Tailwind CSS is a utility-first framework that helps you build designs directly in your markup...', 'image' => '/images/code.jpg' ],
        2 => (object)[ 'id' => 2, 'title' => 'Laravel & Tailwind', 'content' => 'Using Tailwind with Laravel Jetstream gives you great flexibility and speed...', 'image' => '/images/laravel.jpg' ],
        3 => (object)[ 'id' => 3, 'title' => 'Modern UI Design', 'content' => 'Tailwind lets you rapidly build modern, responsive layouts...', 'image' => '/images/design soft.jpg' ],
    ];

    // Check if post exists
    if (!isset($posts[$id])) {
        abort(404);
    }

    $post = $posts[$id];
    return view('blog-show', compact('post'));
}

}
