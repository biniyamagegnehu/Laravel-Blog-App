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

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%')
                ->orWhere('content', 'like', '%' . $request->search . '%');
        }

        $posts = $query->latest()->paginate(5);

        return view('posts', compact('posts'));
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
            'title' => 'required|min:3',
            'content' => 'required|min:10',
        ]);

        Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'user_id' => Auth::id(),
            'category_id' => $request->category_id,
        ]);

        return redirect('/posts')->with('success', 'Post created!');
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

}
