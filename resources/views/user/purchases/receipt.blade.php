<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Purchase Receipt</title>
    <style>
        body { font-family: sans-serif; }
        .receipt-box {
            border: 1px solid #ddd;
            padding: 20px;
            width: 100%;
        }
        .title { font-size: 20px; font-weight: bold; margin-bottom: 10px; }
    </style>
</head>
<body>

<div class="receipt-box">
    <div class="title">Payment Receipt</div>

    <p><strong>Post:</strong> {{ $purchase->post->title }}</p>
    <p><strong>Amount:</strong> KES {{ number_format($purchase->amount, 2) }}</p>
    <p><strong>Status:</strong> {{ ucfirst($purchase->status) }}</p>
    <p><strong>Receipt Number:</strong> {{ $purchase->mpesa_receipt ?? 'N/A' }}</p>
    <p><strong>Date:</strong> {{ $purchase->created_at->format('d M Y, h:i A') }}</p>
</div>

</body>
</html>
