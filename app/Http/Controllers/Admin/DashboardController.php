<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Post;
use App\Models\Service;
use App\Models\Product;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();
        $totalPosts = Post::count();
        $totalServices = Service::count();
        $totalProducts = Product::count();

        return view('admin.dashboard', compact('totalUsers', 'totalPosts', 'totalServices', 'totalProducts'));
    }
}
