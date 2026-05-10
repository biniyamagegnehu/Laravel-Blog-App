@extends('layouts.app')

@section('content')

    <h1 class="text-2xl font-bold mb-4">All Posts</h1>
    <form method="GET" action="/posts" class="mb-4 flex gap-2">
        <input type="text" name="search"
            value="{{ request('search') }}"
            placeholder="Search posts..."
            class="border p-2 rounded w-full">

        <button class="bg-blue-500 text-white px-4 rounded">
            Search
        </button>
    </form>
    <div class="mb-4 flex gap-2 flex-wrap">
    <a href="/posts"
       class="px-3 py-1 bg-gray-200 rounded">
        All
    </a>

    @foreach($categories as $category)
        <a href="/posts?category={{ $category->id }}&search={{ request('search') }}"
           class="px-3 py-1 bg-blue-100 text-blue-700 rounded">
            {{ $category->name }}
        </a>
    @endforeach
</div>

@foreach($posts as $post)
    <div class="border p-4 rounded mb-4 shadow-sm">


        <h2 class="text-xl font-semibold text-blue-600">
            <a href="/posts/{{ $post->id }}">
                {{ $post->title }}
            </a>
        </h2>

        <p class="text-gray-700 mt-2">
            {{ $post->content }}
        </p>
        <p class="text-sm text-blue-500">
            Category: {{ $post->category->name ?? 'None' }}
        </p>

        @auth
            @if($post->user_id === auth()->id())
                <div class="mt-3 space-x-3">
                    <a href="/posts/{{ $post->id }}/edit"
                       class="text-yellow-600">Edit</a>

                    <form method="POST" action="/posts/{{ $post->id }}" class="inline">
                        @csrf
                        @method('DELETE')
                        <button class="text-red-600">Delete</button>
                    </form>
                </div>
            @endif
        @endauth

    </div>
@endforeach

@endsection