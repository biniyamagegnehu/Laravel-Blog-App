<?php

namespace App\Http\Controllers;
use App\Models\Post;

use Illuminate\Http\Request;

class PostController extends Controller
{
    // Show all posts
    public function index()
    {
        $posts = Post::all();
        return view('posts', compact('posts'));
    }

    public function create()
        {
            return view('create-post');
        }

    // Store post
    public function store(Request $request)
    {
        Post::create([
            'title' => $request->title,
            'content' => $request->content,
        ]);

        return redirect('/posts');
    }
}
