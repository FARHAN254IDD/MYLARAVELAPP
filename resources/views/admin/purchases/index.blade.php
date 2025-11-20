@extends('layouts.admin')

@section('title', 'All Purchases')

@section('content')
<div class="bg-white p-6 rounded shadow">
    <h2 class="text-xl font-semibold mb-4">All Purchases</h2>

    <table class="w-full table-auto border-collapse border border-gray-300">
        <thead>
            <tr class="bg-gray-100">
                <th class="p-2 border">User</th>
                <th class="p-2 border">Post</th>
                <th class="p-2 border">Amount</th>
                <th class="p-2 border">Status</th>
                <th class="p-2 border">Mpesa Receipt</th>
                <th class="p-2 border">Date</th>
            </tr>
        </thead>

        <tbody>
            @foreach($purchases as $p)
                <tr>
                    <td class="p-2 border">{{ $p->user->name }}</td>
                    <td class="p-2 border">{{ $p->post->title }}</td>
                    <td class="p-2 border">KES {{ $p->amount }}</td>
                    <td class="p-2 border">
                        <span class="px-2 py-1 rounded text-white
                            {{ $p->status == 'paid' ? 'bg-green-600' : 'bg-yellow-600' }}">
                            {{ ucfirst($p->status) }}
                        </span>
                    </td>
                    <td class="p-2 border">{{ $p->mpesa_receipt ?? '---' }}</td>
                    <td class="p-2 border">{{ $p->created_at->format('d M Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-4">
        {{ $purchases->links() }}
    </div>
</div>
@endsection
