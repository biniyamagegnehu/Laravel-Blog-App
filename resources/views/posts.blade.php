@extends('layouts.app')

@section('content')

<div class="max-w-7xl mx-auto px-6 py-10">

    <!-- Hero Section -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-10 gap-6">

        <div>
            <h1 class="text-5xl font-extrabold text-gray-900 leading-tight">
                Explore Posts
            </h1>

            <p class="text-gray-500 mt-3 text-lg">
                Discover ideas, stories, and knowledge from the community.
            </p>
        </div>

        @auth
            <a href="/posts/create"
               class="bg-gradient-to-r from-blue-600 to-purple-600 hover:scale-105 transition duration-300 text-white px-6 py-3 rounded-2xl shadow-lg font-semibold text-center">

                + Create Post

            </a>
        @endauth

    </div>

    <!-- Search -->
    <div class="bg-white/80 backdrop-blur-lg shadow-lg rounded-3xl p-5 mb-8 border border-gray-100">

        <form method="GET" action="/posts">

            <div class="flex flex-col md:flex-row gap-4">

                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Search amazing posts..."
                    class="flex-1 border border-gray-200 rounded-2xl px-5 py-4 focus:ring-2 focus:ring-blue-400 focus:outline-none text-gray-700"
                >

                <button
                    class="bg-blue-600 hover:bg-blue-700 transition duration-300 text-white px-8 py-4 rounded-2xl shadow font-semibold">

                    Search

                </button>

            </div>

        </form>

    </div>

    <!-- Categories -->
    <div class="flex flex-wrap gap-3 mb-10">

        <a href="/posts"
           class="px-5 py-2 rounded-full transition duration-300
           {{ request('category') ? 'bg-white text-gray-700 border border-gray-200' : 'bg-gray-900 text-white shadow-lg' }}">

            All

        </a>

        @foreach($categories as $category)

            <a href="/posts?category={{ $category->id }}&search={{ request('search') }}"
               class="px-5 py-2 rounded-full transition duration-300 hover:scale-105
               {{ request('category') == $category->id
                    ? 'bg-blue-600 text-white shadow-lg'
                    : 'bg-blue-100 text-blue-700 hover:bg-blue-200' }}">

                {{ $category->name }}

            </a>

        @endforeach

    </div>

    <!-- Empty State -->
    @if($posts->count() === 0)

        <div class="bg-white shadow-xl rounded-3xl p-16 text-center border border-gray-100">

            <h2 class="text-3xl font-bold text-gray-800 mb-4">
                No Posts Found
            </h2>

            <p class="text-gray-500 text-lg">
                Try searching with different keywords or categories.
            </p>

        </div>

    @endif

    <!-- Posts Grid -->
    <div class="grid md:grid-cols-1 xl:grid-cols-1 gap-8">

        @foreach($posts as $post)

            <div class="bg-white/80 backdrop-blur-lg rounded-3xl shadow-lg hover:shadow-2xl hover:-translate-y-2 transition duration-300 overflow-hidden border border-gray-100 group">

                <!-- Gradient Top -->
                <div class="h-2 bg-gradient-to-r from-blue-500 to-purple-500"></div>

                <div class="p-7">

                    <!-- Category -->
                    <div class="mb-4">

                        <a href="/posts?category={{ $post->category->id }}"
                           class="inline-block bg-blue-100 text-blue-700 text-sm px-3 py-1 rounded-full hover:bg-blue-200 transition">

                            {{ $post->category->name ?? 'None' }}

                        </a>

                    </div>

                    <!-- Title -->
                    <a href="/posts/{{ $post->id }}">

                        <h2 class="text-2xl font-bold text-gray-900 leading-snug group-hover:text-blue-600 transition">

                            {{ $post->title }}

                        </h2>

                    </a>

                    <!-- Content Preview -->
                    <p class="text-gray-600 mt-4 leading-7">

                        {{ Str::limit($post->content, 140) }}

                    </p>

                    <!-- Footer -->
                    <div class="mt-8 flex justify-between items-center">

                        <div>

                            <p class="font-semibold text-gray-800">
                                {{ $post->user->name }}
                            </p>

                            <p class="text-sm text-gray-500">
                                {{ $post->created_at->diffForHumans() }}
                            </p>

                        </div>

                        <a href="/posts/{{ $post->id }}"
                           class="bg-gray-900 hover:bg-black text-white px-4 py-2 rounded-xl transition">

                            Read →

                        </a>

                    </div>

                    <!-- Owner Actions -->
                    @auth

                        @if($post->user_id === auth()->id())

                            <div class="flex gap-3 mt-6 pt-5 border-t border-gray-100">

                                <a href="/posts/{{ $post->id }}/edit"
                                   class="flex-1 text-center bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-xl transition font-medium">

                                    Edit

                                </a>

                                <form method="POST"
                                      action="/posts/{{ $post->id }}"
                                      class="flex-1">

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        class="w-full bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-xl transition font-medium">

                                        Delete

                                    </button>

                                </form>

                            </div>

                        @endif

                    @endauth

                </div>

            </div>

        @endforeach

    </div>

    <!-- Pagination -->
    <div class="mt-14">

        {{ $posts->links() }}

    </div>

</div>

@endsection