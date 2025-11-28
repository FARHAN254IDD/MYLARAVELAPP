<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Purchase;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PurchaseController extends Controller
{
    /**
     * Show all purchases for the logged-in user
     */
    public function index()
    {
        $purchases = Purchase::where('user_id', Auth::id())
            ->with('post')
            ->latest()
            ->get();

        return view('user.purchases.index', compact('purchases'));
    }

    /**
     * Download receipt as PDF
     */
    public function receipt($id)
    {
        $purchase = Purchase::where('id', $id)
            ->where('user_id', Auth::id()) // user cannot download other user receipts
            ->with('post')
            ->firstOrFail();

        $pdf = Pdf::loadView('user.purchases.receipt', compact('purchase'));

        return $pdf->download('receipt-' . $purchase->id . '.pdf');
    }
}
