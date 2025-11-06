@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">📊 Reports & Analytics</h2>

    <div class="d-flex gap-3 mb-3">
        <a href="{{ route('admin.reports.export.pdf') }}" class="btn btn-danger">Download PDF</a>
        <a href="{{ route('admin.reports.export.csv') }}" class="btn btn-success">Download CSV</a>
    </div>

    <div class="row">
        <div class="col-md-3 mb-3">
            <div class="card p-3 text-center shadow-sm">
                <h4>Total Posts</h4>
                <p class="fs-4 fw-bold">{{ $totalPosts }}</p>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card p-3 text-center shadow-sm">
                <h4>Total Users</h4>
                <p class="fs-4 fw-bold">{{ $totalUsers }}</p>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card p-3 text-center shadow-sm">
                <h4>Total Comments</h4>
                <p class="fs-4 fw-bold">{{ $totalComments }}</p>
            </div>
        </div>
    </div>

    <h5 class="mt-5 mb-3">📈 Visual Analytics</h5>
    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="card p-3 shadow-sm">
                <h6>Posts per Category</h6>
                <canvas id="postsByCategory"></canvas>
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="card p-3 shadow-sm">
                <h6>New Users (Last 6 Months)</h6>
                <canvas id="usersByMonth"></canvas>
            </div>
        </div>
    </div>

    <div class="card p-3 shadow-sm mb-4">
        <h6>🔥 Most Viewed Posts</h6>
        <canvas id="mostViewedPosts"></canvas>
    </div>

    <h5>🆕 Recent Users</h5>
    <ul class="list-group">
        @foreach ($recentUsers as $user)
        <li class="list-group-item d-flex justify-content-between">
            {{ $user->name }}
            <span>{{ $user->created_at->diffForHumans() }}</span>
        </li>
        @endforeach
    </ul>
</div>
@endsection


@push('scripts')
<script>
const postsByCategoryCtx = document.getElementById('postsByCategory').getContext('2d');
new Chart(postsByCategoryCtx, {
    type: 'doughnut',
    data: {
        labels: {!! json_encode($categories->pluck('name')) !!},
        datasets: [{
            label: 'Posts per Category',
            data: {!! json_encode($categories->pluck('posts_count')) !!},
            backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#28a745', '#6f42c1', '#fd7e14']
        }]
    },
});

const usersByMonthCtx = document.getElementById('usersByMonth').getContext('2d');
new Chart(usersByMonthCtx, {
    type: 'bar',
    data: {
        labels: {!! json_encode(array_keys($usersByMonth)) !!},
        datasets: [{
            label: 'New Users',
            data: {!! json_encode(array_values($usersByMonth)) !!},
            backgroundColor: '#36A2EB'
        }]
    },
});

const mostViewedCtx = document.getElementById('mostViewedPosts').getContext('2d');
new Chart(mostViewedCtx, {
    type: 'line',
    data: {
        labels: {!! json_encode($mostViewed->pluck('title')) !!},
        datasets: [{
            label: 'Views',
            data: {!! json_encode($mostViewed->pluck('views')) !!},
            borderColor: '#FF6384',
            fill: false,
            tension: 0.2
        }]
    },
});
</script>
@endpush
