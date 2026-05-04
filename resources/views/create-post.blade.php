@extends('layouts.app')

@section('content')

<h1>Create Post</h1>

@if($errors->any())
    <ul style="color:red;">
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif

<form method="POST" action="/posts">
    @csrf

    <input type="text" name="title" placeholder="Title">
    <br><br>

    <textarea name="content" placeholder="Content"></textarea>
    <br><br>

    <button>Save</button>
</form>

@endsection