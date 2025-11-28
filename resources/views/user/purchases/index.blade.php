@extends('layouts.user')

@section('content')
<div class="max-w-4xl mx-auto mt-10 bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-bold mb-4">My Purchases</h2>

    @if($purchases->isEmpty())
        <p class="text-gray-600">You have not purchased any posts yet.</p>
    @else
        <table class="w-full border">
            <thead>
                <tr class="bg-gray-200">
                    <th class="p-2 border">Post</th>
                    <th class="p-2 border">Amount</th>
                    <th class="p-2 border">Status</th>
                    <th class="p-2 border">Receipt</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($purchases as $purchase)
                    <tr>
                        <td class="p-2 border">{{ $purchase->post->title }}</td>
                        <td class="p-2 border">{{ number_format($purchase->amount, 2) }}</td>
                        <td class="p-2 border capitalize {{ $purchase->status === 'paid' ? 'text-green-600' : 'text-yellow-600' }}">
                            {{ $purchase->status }}
                        </td>
                        <td class="p-2 border text-center">
                            @if ($purchase->status === 'paid')
                                <a href="{{ route('user.purchases.receipt', $purchase->id) }}"
                                   class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700">
                                    Download Receipt
                                </a>
                            @else
                                <span class="text-gray-500">Pending</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
