@extends('layouts.app')

@section('content')

<h1 class="text-2xl font-bold mb-4">My Posts</h1>

@if($posts->isEmpty())
    <p class="text-gray-500">You haven't created any posts yet.</p>
@endif

@foreach($posts as $post)
    <div class="border p-4 rounded mb-4 shadow-sm">
        <h2 class="text-xl font-semibold text-blue-600">
            {{ $post->title }}
        </h2>

        <p class="text-gray-700 mt-2">
            {{ $post->content }}
        </p>

        <div class="mt-3 space-x-3">
            <a href="/posts/{{ $post->id }}/edit" class="text-yellow-600">Edit</a>

            <form method="POST" action="/posts/{{ $post->id }}" class="inline">
                @csrf
                @method('DELETE')
                <button class="text-red-600">Delete</button>
            </form>
        </div>
    </div>
@endforeach

<div class="mt-4">
    {{ $posts->links() }}
</div>

@endsection