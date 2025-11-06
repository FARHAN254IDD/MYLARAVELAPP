<!DOCTYPE html>
<html>
<head>
    <title>Site Report</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #999; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h2>Site Report</h2>

    <h3>Posts</h3>
    <table>
        <tr><th>Title</th><th>Author</th></tr>
        @foreach($posts as $post)
        <tr><td>{{ $post->title }}</td><td>{{ $post->user->name ?? 'N/A' }}</td></tr>
        @endforeach
    </table>

    <h3>Users</h3>
    <table>
        <tr><th>Name</th><th>Email</th></tr>
        @foreach($users as $user)
        <tr><td>{{ $user->name }}</td><td>{{ $user->email }}</td></tr>
        @endforeach
    </table>

    <h3>Comments</h3>
    <table>
        <tr><th>User</th><th>Comment</th></tr>
        @foreach($comments as $comment)
        <tr><td>{{ $comment->user->name ?? 'N/A' }}</td><td>{{ $comment->content }}</td></tr>
        @endforeach
    </table>
</body>
</html>
