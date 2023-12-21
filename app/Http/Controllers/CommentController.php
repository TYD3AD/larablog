<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    function store(Request $request)
    {
        // On récupère les données du formulaire
        $data = $request->only(['content', 'articleId']);

        // Créateur du commentaire (auteur)
        $data['user_id'] = Auth::user()->id;
        $content = $data['content'];
        $articleId = $data['articleId'];


        
        Comment::create([
            'content' => $content,
            'article_id' => $articleId,
            'user_id' => Auth::user()->id
        ]);
        return redirect()->back();

    }
}
