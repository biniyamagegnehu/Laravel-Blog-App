<h1 class="text-2xl font-bold">{{ $post->title }}</h1>

<p class="text-gray-600 mt-2">
    Category: {{ $post->category->name ?? 'No Category' }}
</p>

<p class="mt-4">
    {{ $post->content }}
</p>

<p class="text-sm text-gray-400 mt-6">
    Author: {{ $post->user->name ?? 'Unknown' }}
</p>
<hr class="my-6">

<h2 class="text-xl font-bold mb-4">Comments</h2>

@if ($errors->any())

    <div class="bg-red-100 text-red-700 p-4 rounded mb-4">

        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>

    </div>

@endif

<form method="POST" action="/posts/{{ $post->id }}/comments">
    @csrf

    <textarea
        name="content"
        class="w-full border p-3 rounded mb-3"
        placeholder="Write a comment..."
    ></textarea>

    <button class="bg-blue-500 text-white px-4 py-2 rounded">
        Add Comment
    </button>
</form>

    @if($post->comments->count() === 0)

    <p class="text-gray-500">
        No comments yet.
    </p>

    @endif

    @foreach($post->comments as $comment)

        <div class="border p-4 rounded mb-4">

            <div class="flex justify-between items-center">

                <p class="font-bold">
                    {{ $comment->user->name }}
                </p>

        </div>

        <p class="mt-3">
            {{ $comment->content }}
        </p>

        <p class="text-sm text-gray-500 mt-2">
            {{ $comment->created_at->diffForHumans() }}
        </p>

                @if(auth()->id() === $comment->user_id)

            <div class="flex gap-2">

                <a href="/comments/{{ $comment->id }}/edit"
                class="bg-yellow-500 text-white px-3 py-1 rounded">
                    Edit
                </a>

                <form method="POST"
                    action="/comments/{{ $comment->id }}">

                    @csrf
                    @method('DELETE')

                    <button
                        class="bg-red-500 text-white px-3 py-1 rounded">
                        Delete
                    </button>

                </form>

            </div>

        @endif

    </div>

@endforeach