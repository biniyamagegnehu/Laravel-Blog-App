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

@foreach($posts as $post)
    <div class="border p-4 rounded mb-4 shadow-sm">

        <h2 class="text-xl font-semibold text-blue-600">
            {{ $post->title }}
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