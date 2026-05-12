@extends('layouts.app')

@section('content')

<div class="max-w-4xl mx-auto px-4 py-10">

    <!-- Post Card -->
    <div class="bg-white shadow-lg rounded-2xl overflow-hidden">

        <!-- Header -->
        <div class="p-8 border-b">

            <!-- Category -->
            <span class="inline-block bg-blue-100 text-blue-700 text-sm px-3 py-1 rounded-full mb-4">
                {{ $post->category->name ?? 'Uncategorized' }}
            </span>

            <!-- Title -->
            <h1 class="text-4xl font-bold text-gray-900 leading-tight">
                {{ $post->title }}
            </h1>

            <!-- Author -->
            <div class="flex items-center mt-6">

                <div class="w-12 h-12 bg-blue-500 text-white rounded-full flex items-center justify-center text-lg font-bold">
                    {{ strtoupper(substr($post->user->name, 0, 1)) }}
                </div>

                @if($post->image)

    <img
        src="{{ asset('storage/' . $post->image) }}"
        class="w-full h-[450px] object-cover rounded-t-2xl"
        alt="{{ $post->title }}"
    >

@endif

                <div class="ml-4">
                    <p class="font-semibold text-gray-800">
                        {{ $post->user->name }}
                    </p>

                    <p class="text-sm text-gray-500">
                        Posted {{ $post->created_at->diffForHumans() }}
                    </p>
                </div>

            </div>

        </div>

        <!-- Content -->
        <div class="p-8">

            <div class="prose max-w-none text-gray-700 leading-8 text-lg">
                {!! nl2br(e($post->content)) !!}
            </div>

        </div>

    </div>

    @auth

    <form method="POST"
          action="/posts/{{ $post->id }}/like"
          class="mt-6">

        @csrf

        <button
            class="flex items-center gap-2 bg-pink-100 hover:bg-pink-200 text-pink-700 px-5 py-3 rounded-2xl transition font-semibold">

            @if(auth()->user()->likedPosts->contains($post->id))

                ❤️ Unlike

            @else

                🤍 Like

            @endif

            <span>
                ({{ $post->likedUsers->count() }})
            </span>

        </button>

    </form>

@endauth

    <!-- Comments Section -->
    <div class="mt-10">

        <h2 class="text-2xl font-bold text-gray-800 mb-6">
            Comments ({{ $post->comments->count() }})
        </h2>

        <!-- Validation Errors -->
        @if ($errors->any())

            <div class="bg-red-100 border border-red-300 text-red-700 p-4 rounded-lg mb-6">

                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>

            </div>

        @endif

        <!-- Comment Form -->
        @auth

            <div class="bg-white shadow rounded-2xl p-6 mb-8">

                <form method="POST" action="/posts/{{ $post->id }}/comments">

                    @csrf

                    <textarea
                        name="content"
                        rows="4"
                        class="w-full border border-gray-300 rounded-xl p-4 focus:ring-2 focus:ring-blue-400 focus:outline-none"
                        placeholder="Write your thoughts..."
                    ></textarea>

                    <button
                        class="mt-4 bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl transition">

                        Add Comment

                    </button>

                </form>

            </div>

        @else

            <div class="bg-yellow-100 text-yellow-700 p-4 rounded-lg mb-8">
                Please login to write a comment.
            </div>

        @endauth

        <!-- Empty State -->
        @if($post->comments->count() === 0)

            <div class="bg-gray-100 text-gray-500 p-6 rounded-xl text-center">
                No comments yet. Be the first to comment!
            </div>

        @endif

        <!-- Comments List -->
        <div class="space-y-6">

            @foreach($post->comments as $comment)

                <div class="bg-white shadow rounded-2xl p-6">

                    <div class="flex justify-between items-start">

                        <div class="flex items-center">

                            <!-- Avatar -->
                            <div class="w-10 h-10 bg-gray-800 text-white rounded-full flex items-center justify-center font-bold">
                                {{ strtoupper(substr($comment->user->name, 0, 1)) }}
                            </div>

                            <div class="ml-3">

                                <p class="font-semibold text-gray-800">
                                    {{ $comment->user->name }}
                                </p>

                                <p class="text-sm text-gray-500">
                                    {{ $comment->created_at->diffForHumans() }}
                                </p>

                            </div>

                        </div>

                        <!-- Actions -->
                        @if(auth()->id() === $comment->user_id)

                            <div class="flex gap-2">

                                <a href="/comments/{{ $comment->id }}/edit"
                                   class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded-lg text-sm">

                                    Edit

                                </a>

                                <form method="POST"
                                      action="/comments/{{ $comment->id }}">

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-lg text-sm">

                                        Delete

                                    </button>

                                </form>

                            </div>

                        @endif

                    </div>

                    <!-- Comment Content -->
                    <div class="mt-4 text-gray-700 leading-7">

                        {!! nl2br(e($comment->content)) !!}

                    </div>

                </div>

            @endforeach

        </div>

    </div>

</div>

@endsection