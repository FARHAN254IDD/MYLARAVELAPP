<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Purchase;

class PurchaseController extends Controller
{
    public function index()
    {
        $purchases = Purchase::with('user', 'post')->latest()->paginate(10);

        return view('admin.purchases.index', compact('purchases'));
    }
}
