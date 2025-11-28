<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use App\Models\UserPurchase;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    public function index()
    {
        $categories = \App\Models\Category::withCount('posts')->get();

    // Get users created in last 6 months
    $usersByMonth = [];
    $months = collect(range(5, 0))->map(function($i) {
        return now()->subMonths($i)->format('M Y');
    });

    foreach ($months as $month) {
        $count = \App\Models\User::whereMonth('created_at', '=', \Carbon\Carbon::parse($month)->month)
                                 ->whereYear('created_at', '=', \Carbon\Carbon::parse($month)->year)
                                 ->count();
        $usersByMonth[$month] = $count;
    }

    $data = [
        'totalPosts' => Post::count(),
        'totalUsers' => User::count(),
        'totalComments' => Comment::count(),
        'mostViewed' => Post::orderBy('views', 'desc')->take(5)->get(),
        'recentUsers' => User::latest()->take(5)->get(),
        'categories' => $categories,
        'usersByMonth' => $usersByMonth,
    ];

    return view('admin.reports.index', $data);
    }

    // Export report as PDF
    public function exportPDF()
    {
        $data = [
            'posts' => Post::all(),
            'users' => User::all(),
            'comments' => Comment::all(),
        ];

        $pdf = Pdf::loadView('admin.reports.export', $data);
        return $pdf->download('site_report.pdf');
    }

    // Export report as CSV
    public function exportCSV()
    {
        $filename = 'site_report.csv';
        $handle = fopen($filename, 'w+');
        fputcsv($handle, ['Type', 'Title/Name', 'Details']);

        foreach (Post::all() as $post) {
            fputcsv($handle, ['Post', $post->title, 'By ' . $post->user->name]);
        }

        foreach (User::all() as $user) {
            fputcsv($handle, ['User', $user->name, $user->email]);
        }

        foreach (Comment::all() as $comment) {
            fputcsv($handle, ['Comment', $comment->user->name, $comment->content]);
        }

        fclose($handle);

        return response()->download($filename)->deleteFileAfterSend(true);
    }

    public function allPurchases()
{
    $purchases = UserPurchase::with('user', 'post')->latest()->get();
    return view('admin.reports.purchases', compact('purchases'));
}

public function downloadPurchasesPDF()
{
    $purchases = UserPurchase::with('user', 'post')->latest()->get();
    $pdf = Pdf::loadView('admin.reports.purchases_pdf', compact('purchases'));
    return $pdf->download('all_purchases.pdf');
}
}
