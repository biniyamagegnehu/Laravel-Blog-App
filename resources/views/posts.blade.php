<h1>All Posts</h1>

<a href="/posts/create">Create New Post</a>

@foreach($posts as $post)
    <h2>{{ $post->title }}</h2>
    <p>{{ $post->content }}</p>

    <a href="/posts/{{ $post->id }}/edit">
    Edit
    </a>
    <hr>
@endforeach