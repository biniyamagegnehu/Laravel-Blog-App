@extends('layouts.app')

@section('content')

<h1>All Posts</h1>

@foreach($posts as $post)
    <h2>{{ $post->title }}</h2>
    <p>{{ $post->content }}</p>

    <a href="/posts/{{ $post->id }}/edit">Edit</a>

    <form method="POST" action="/posts/{{ $post->id }}">
        @csrf
        @method('DELETE')
        <button>Delete</button>
    </form>

    <hr>
@endforeach

@endsection