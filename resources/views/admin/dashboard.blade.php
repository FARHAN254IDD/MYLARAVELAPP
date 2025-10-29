@extends('layouts.admin')

@section('title', 'Admin Dashboard')
@section('page_title', 'Overview')

@section('content')
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

  <div class="bg-white p-6 rounded-xl shadow">
    <h3 class="text-sm text-gray-500">Total Users</h3>
    <p class="text-2xl font-bold">{{ $totalUsers }}</p>
  </div>

  <div class="bg-white p-6 rounded-xl shadow">
    <h3 class="text-sm text-gray-500">Total Posts</h3>
    <p class="text-2xl font-bold">{{ $totalPosts }}</p>
  </div>

  <div class="bg-white p-6 rounded-xl shadow">
    <h3 class="text-sm text-gray-500">Total Services</h3>
    <p class="text-2xl font-bold">{{ $totalServices }}</p>
  </div>

  <div class="bg-white p-6 rounded-xl shadow">
    <h3 class="text-sm text-gray-500">Total Products</h3>
    <p class="text-2xl font-bold">{{ $totalProducts }}</p>
  </div>

</div>
@endsection
