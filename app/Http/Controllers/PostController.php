<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
        {
            return "Posts page";
        }

    public function create()
        {
            return view('create-post');
        }
}
