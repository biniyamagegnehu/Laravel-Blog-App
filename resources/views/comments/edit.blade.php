<h1 class="text-2xl font-bold mb-6">
    Edit Comment
</h1>

<form method="POST" action="/comments/{{ $comment->id }}">
    @csrf
    @method('PUT')

    <textarea
        name="content"
        class="w-full border p-3 rounded mb-4"
        rows="5"
    >{{ $comment->content }}</textarea>

    <button
        class="bg-blue-500 text-white px-4 py-2 rounded">
        Update Comment
    </button>
</form>