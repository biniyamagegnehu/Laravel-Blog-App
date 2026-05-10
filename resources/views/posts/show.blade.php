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