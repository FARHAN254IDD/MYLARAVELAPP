<?php

namespace App\Http\Controllers\Blogger;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    // show comments for posts owned by the blogger
    public function index()
    {
        $comments = Comment::whereHas('post', function($q){
            $q->where('user_id', Auth::id());
        })->latest()->paginate(12);

        return view('blogger.comments.index', compact('comments'));
    }

    // (Optional) approve or mark comment as read — implement as you wish
}
