@extends('layouts.app')

@section('content')

<h1>Edit Post</h1>

<form method="POST" action="/posts/{{ $post->id }}">
    @csrf
    @method('PUT')

    <input type="text" name="title" value="{{ $post->title }}">
    <br><br>

    <textarea name="content">{{ $post->content }}</textarea>
    <br><br>

    <button>Update</button>
</form>

@endsection