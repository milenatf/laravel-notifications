<?php

namespace App\Http\Controllers\Posts;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCommentFormRequest;
use App\Notifications\PostComment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(StoreCommentFormRequest $request)
    {
        $comment = $request->user()->comments()->create($request->all());

        $author = $comment->post->user; // Pega o autor do post
        $author->notify(new PostComment($comment)); // Envia a notificação de que houve um comentário no post para o author do post

        return redirect()->route('posts.show', $comment->post_id)->withSuccess('Comentário realizado com sucesso!');
    }
}
