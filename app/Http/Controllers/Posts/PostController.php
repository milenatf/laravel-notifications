<?php

namespace App\Http\Controllers\Posts;

use App\Models\Post;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = POST::paginate();

        return view('posts.index', compact('posts'));
    }

    public function show($id)
    {
        $post = POST::with(['comments.user', 'user'])->find($id);

        return view('posts.show', compact('post'));
    }
}
