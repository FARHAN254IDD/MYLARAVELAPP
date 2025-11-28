@extends('layouts.admin')

@section('title', 'All Purchases Report')

@section('content')

<h1 class="text-3xl font-bold mb-6">All Purchases Report</h1>

<table class="min-w-full bg-white">
    <thead>
        <tr>
            <th class="py-2 px-4 border">User</th>
            <th class="py-2 px-4 border">Post</th>
            <th class="py-2 px-4 border">Amount</th>
            <th class="py-2 px-4 border">Purchased At</th>
        </tr>
    </thead>
    <tbody>
        @foreach($purchases as $purchase)
        <tr>
            <td class="py-2 px-4 border">{{ $purchase->user->name }}</td>
            <td class="py-2 px-4 border">{{ $purchase->post->title }}</td>
            <td class="py-2 px-4 border">KES {{ number_format($purchase->amount, 2) }}</td>
            <td class="py-2 px-4 border">{{ $purchase->created_at->format('d M Y, H:i') }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<a href="{{ route('reports.download.pdf') }}" class="mt-4 inline-block bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
    Download PDF
</a>

@endsection
