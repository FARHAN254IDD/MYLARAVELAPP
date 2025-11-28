<h1>Purchase Receipt</h1>
<p>User: {{ $purchase->user->name }}</p>
<p>Post: {{ $purchase->post->title }}</p>
<p>Amount: KES {{ number_format($purchase->amount, 2) }}</p>
<p>Date: {{ $purchase->created_at->format('d M Y, H:i') }}</p>
