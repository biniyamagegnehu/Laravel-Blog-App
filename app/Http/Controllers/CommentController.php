<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;

class CommentController extends Controller
{
    public function store(Request $request, Post $post)
    {
        $request->validate([
            'content' => 'required',
        ]);

        $post->comments()->create([
            'content' => $request->content,
            'user_id' => auth()->id(),
        ]);

        return back();
    }

    public function destroy(Comment $comment)
    {
        // Authorization
        if (auth()->id() !== $comment->user_id) {
            abort(403);
        }

        $comment->delete();

        return back()->with('success', 'Comment deleted.');
    }

    public function edit(Comment $comment)
    {
        if (auth()->id() !== $comment->user_id) {
            abort(403);
        }

        return view('comments.edit', compact('comment'));
    }
    public function update(Request $request, Comment $comment)
    {
        if (auth()->id() !== $comment->user_id) {
            abort(403);
        }

        $request->validate([
            'content' => 'required',
        ]);

        $comment->update([
            'content' => $request->content,
        ]);

        return redirect('/posts/' . $comment->post_id)
            ->with('success', 'Comment updated.');
    }
}
