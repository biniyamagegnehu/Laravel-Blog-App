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
@foreach($post->comments as $comment)

    <div class="border p-4 rounded mb-4">

        <div class="flex justify-between items-center">

            <p class="font-bold">
                {{ $comment->user->name }}
            </p>

            @if(auth()->id() === $comment->user_id)

                <form method="POST"
                      action="/comments/{{ $comment->id }}">

                    @csrf
                    @method('DELETE')

                    <button
                        class="bg-red-500 text-white px-3 py-1 rounded">
                        Delete
                    </button>

                </form>

            @endif

        </div>

        <p class="mt-3">
            {{ $comment->content }}
        </p>

    </div>

@endforeach