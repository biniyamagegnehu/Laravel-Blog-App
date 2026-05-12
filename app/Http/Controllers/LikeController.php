<?php

namespace App\Http\Controllers;

use App\Models\Post;

class LikeController extends Controller
{
    public function toggle(Post $post)
    {
        auth()->user()
            ->likedPosts()
            ->toggle($post->id);

        return back();
    }
}