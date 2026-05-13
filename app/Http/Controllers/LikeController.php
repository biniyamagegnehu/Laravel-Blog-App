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

        $liked = auth()->user()
            ->likedPosts
            ->contains($post->id);

        return response()->json([
            'liked' => $liked,
            'count' => $post->likedUsers()->count(),
        ]);
    }

}