@extends ('frontend.app')

@section('title', 'Home')

@section('content')
<section class="relative bg-cover bg-center h-[80vh]" style="background-image:
url('https://source.unsplash.com/1600x900/?laptop,workspace');">
<!-- url('{{asset('images/workspace.jpg')}}');"> -->

    <div class="absolute inset-0 bg-black bg-opacity-60 flex items-center justify-center">
        <div class="text-center text-white">
            <h1 class="text-5xl font-bold mb-4">Welcome to MyPosts</h1>
            <p class="text-lg mb-6">Discover stories, tutorials, and tech insights from developers like you.</p>
            <a href="/posts" class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold">Explore Posts</a>
        </div>
    </div>
</section>

<section class="py-16 max-w-6xl mx-auto px-4">
    <h2 class="text-3xl font-bold text-center mb-10">Featured Posts</h2>
    <div class="grid md:grid-cols-3 gap-8">
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <!-- <img src="https://source.unsplash.com/600x400/?coding" -->
             <img src="{{asset('images/coding.jpg')}}"
             class="w-full h-48 object-cover" />
            <div class="p-5">
                <h3 class="text-xl font-bold mb-2">Mastering Tailwind CSS</h3>
                <p class="text-gray-600">A deep dive into how Tailwind makes modern UI design simple and fast.</p>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <img src="{{asset('images/developer.jpg')}}" class="w-full h-48 object-cover" />
            <div class="p-5">
                <h3 class="text-xl font-bold mb-2">Building with Laravel</h3>
                <p class="text-gray-600">Learn how Laravel empowers developers to create powerful web apps.</p>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <img src="{{asset('images/design.jpg')}}" class="w-full h-48 object-cover" />
            <div class="p-5">
                <h3 class="text-xl font-bold mb-2">UI Design Best Practices</h3>
                <p class="text-gray-600">Discover how to create visually appealing designs with simplicity.</p>
            </div>
        </div>
    </div>
</section>

@endsection
