<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\Purchase;

class DashboardController extends Controller
{
    /**
     * Display the user dashboard.
     */
    public function index()
    {
        $user = Auth::user();

        // Total approved posts
        $totalPosts = Post::where('status', 'approved')->count();

        // Total purchased posts by user
        $purchasedCount = Purchase::where('user_id', $user->id)->count();

        // Latest 5 approved posts
        $recentPosts = Post::where('status', 'approved')
                            ->latest()
                            ->take(5)
                            ->get();

        // Paginated posts for browsing in dashboard
        $posts = Post::where('status', 'approved')
                     ->latest()
                     ->paginate(9); // 3 posts per row for Tailwind grid

        return view('user.dashboard', compact(
            'user',
            'totalPosts',
            'purchasedCount',
            'recentPosts',
            'posts'
        ));
    }

    /**
     * Show the purchased posts page.
     */
    public function purchases()
    {
        $user = Auth::user();
        $purchasedPosts = Purchase::with('post')
                            ->where('user_id', $user->id)
                            ->latest()
                            ->paginate(9);

        return view('user.purchases', compact('purchasedPosts'));
    }

    /**
     * Show user profile.
     */
    public function profile()
    {
        $user = Auth::user();
        return view('user.profile', compact('user'));
    }

    /**
     * Show user settings.
     */
    public function settings()
    {
        $user = Auth::user();
        return view('user.settings', compact('user'));
    }
}
