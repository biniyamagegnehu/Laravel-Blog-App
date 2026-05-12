<?php

namespace App\Http\Controllers;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;

use Illuminate\Http\Request;

class PostController extends Controller
{
    // Show all posts
    public function index(Request $request)
    {
        $query = Post::query();

        // 🔍 Search
        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%')
                ->orWhere('content', 'like', '%' . $request->search . '%');
        }

        // 🏷 Category filter
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        $posts = $query->latest()->paginate(5);

        $categories = Category::all();

        return view('posts', compact('posts', 'categories'));
    }

    public function create()
        {
        $categories = Category::all();

        return view('create-post', compact('categories'));   
       }

    // Store post
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'category_id' => 'required',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $imagePath = null;

        // Check if image uploaded
        if ($request->hasFile('image')) {

            $imagePath = $request->file('image')
                ->store('posts', 'public');

        }

        Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'category_id' => $request->category_id,
            'user_id' => auth()->id(),
            'image' => $imagePath,
        ]);

        return redirect('/posts')
            ->with('success', 'Post created successfully.');
    }  

    public function edit(Post $post)
    {
        if ($post->user_id !== Auth::id()) {
            abort(403);
        }

        return view('edit-post', compact('post'));
    }

   public function update(Request $request, Post $post)
    {
        if ($post->user_id !== Auth::id()) {
            abort(403);
        }

        $post->update([
            'title' => $request->title,
            'content' => $request->content,
        ]);

        return redirect('/posts');
    }
    public function destroy(Post $post)
    {
        if ($post->user_id !== Auth::id()) {
            abort(403);
        }

        $post->delete();

        return redirect('/posts');
    }

    public function dashboard()
    {
        $posts = Auth::user()->posts()->latest()->paginate(5);

        return view('dashboard', compact('posts'));
    }

    public function show($id)
    {
        $post = Post::findOrFail($id);

        return view('posts.show', compact('post'));
    }

}
