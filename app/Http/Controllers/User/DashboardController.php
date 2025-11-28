<?php

namespace App\Http\Controllers\User;

use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\Purchase;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        // Search & filters
        $query = Post::where('status', 'approved');

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }

        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        $posts = $query->latest()->paginate(9);

        return view('user.dashboard', [
            'totalPosts' => Post::where('status', 'approved')->count(),
            'purchased' => Purchase::where('user_id', $user->id)->count(),
            // Show up to 9 recent posts so the dashboard grid can form 3 rows × 3 columns
            'recent' => Post::latest()->take(9)->get(),
            'posts' => $posts,
            'search' => $request->search ?? '',
            'min_price' => $request->min_price ?? '',
            'max_price' => $request->max_price ?? ''
        ]);
    }

    public function purchases()
    {
        $user = Auth::user();
        $purchases = Purchase::where('user_id', $user->id)->with('post')->latest()->get();
        return view('user.purchases', compact('purchases'));
    }

    public function profile()
    {
        $user = Auth::user();
        return view('user.profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'required|string|max:13',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        if ($request->password) {
            $user->password = bcrypt($request->password);
        }
        $user->save();

        return back()->with('success', 'Profile updated successfully.');
    }

    public function settings()
    {
        return view('user.settings');
    }


    public function downloadReceipt($purchaseId)
    {
        $purchase = Purchase::with('post', 'user')->findOrFail($purchaseId);

        $pdf = Pdf::loadView('user.receipt', compact('purchase'));

        return $pdf->download('receipt_'.$purchase->id.'.pdf');
    }
}
