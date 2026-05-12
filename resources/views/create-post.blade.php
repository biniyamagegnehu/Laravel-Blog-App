@extends('layouts.app')

@section('content')

<h1 class="text-2xl font-bold mb-4">Create Post</h1>

@if($errors->any())
    <ul class="bg-red-100 text-red-700 p-3 rounded mb-4">
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif

<form method="POST"
      action="/posts"
      enctype="multipart/form-data" class="space-y-4">
    @csrf

    <select name="category_id" class="w-full border p-2 rounded">
        @foreach($categories as $category)
            <option value="{{ $category->id }}">
                {{ $category->name }}
            </option>
        @endforeach
    </select>
    <input type="text" name="title"
           placeholder="Title"
           class="w-full border p-2 rounded">

    <textarea name="content"
              placeholder="Content"
              class="w-full border p-2 rounded"></textarea>

    <div class="mb-6">

    <label class="block mb-2 font-semibold">
        Featured Image
    </label>

    <input
        type="file"
        name="image"
        class="w-full border p-3 rounded-xl bg-white"
    >

</div>

    <button class="bg-blue-500 text-white px-4 py-2 rounded">
        Save
    </button>
</form>

@endsection