@extends('layouts.app')

@section('content')

<h1 class="text-2xl font-bold mb-4">Edit Post</h1>

<form method="POST" action="/posts/{{ $post->id }}" class="space-y-4">
    @csrf
    @method('PUT')

    <input type="text" name="title"
           value="{{ $post->title }}"
           class="w-full border p-2 rounded">

    <textarea name="content"
              class="w-full border p-2 rounded">{{ $post->content }}</textarea>

    <button class="bg-green-500 text-white px-4 py-2 rounded">
        Update
    </button>
</form>

@endsection