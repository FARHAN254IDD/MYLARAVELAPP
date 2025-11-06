<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Website Report</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; }
        h2 { text-align: center; color: #333; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #aaa; padding: 8px; text-align: left; }
        th { background-color: #f5f5f5; }
    </style>
</head>
<body>
    <h2>Website Report - {{ now()->format('F d, Y') }}</h2>

    <table>
        <tr><th>Metric</th><th>Value</th></tr>
        <tr><td>Total Users</td><td>{{ $totalUsers }}</td></tr>
        <tr><td>Total Posts</td><td>{{ $totalPosts }}</td></tr>
        <tr><td>Approved Posts</td><td>{{ $approvedPosts }}</td></tr>
        <tr><td>Pending Posts</td><td>{{ $pendingPosts }}</td></tr>
        <tr><td>Total Comments</td><td>{{ $totalComments }}</td></tr>
    </table>

    <h3>Recent Users</h3>
    <ul>
        @foreach($recentUsers as $user)
            <li>{{ $user->name }} - {{ $user->email }}</li>
        @endforeach
    </ul>

    <h3>Recent Posts</h3>
    <ul>
        @foreach($recentPosts as $post)
            <li>{{ $post->title }}</li>
        @endforeach
    </ul>
</body>
</html>
