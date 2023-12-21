<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function create()
    {
        
        return view('articles.create',['categories'=>Category::all()]);
    }

    public function store(Request $request)
    {
        
        // On récupère les données du formulaire
        $data = $request->only(['title', 'content', 'draft', 'categories']);

        // Créateur de l'article (auteur)
        $data['user_id'] = Auth::user()->id;

        // Gestion du draft
        $data['draft'] = isset($data['draft']) ? 1 : 0;



        // On crée l'article
        $article = Article::create($data); // $Article est l'objet article nouvellement créé

        // Exemple pour ajouter la catégorie 1 à l'article
        // $article->categories()->sync(1);

        // Exemple pour ajouter des catégories à l'article
        // $article->categories()->sync([$data['categories']]);

        // Exemple pour ajouter des catégories à l'article en venant du formulaire
         $article->categories()->sync($request->input('categories'));

        // On redirige l'utilisateur vers la liste des articles
        $success = "Article créé !";
        return redirect()->route('dashboard')->with('success', $success);
    }

    public function index()
    {
        // On récupère l'utilisateur connecté.
        $user = Auth::user();
        $articles = Article::where('user_id', $user->id)->get();

        // On retourne la vue.
        return view('dashboard', [
            'articles' => $articles
        ]);
    }

    public function edit(Article $article)
    {
        // On vérifie que l'utilisateur est bien le créateur de l'article
        if ($article->user_id !== Auth::user()->id) {
            $error = "Vous ne pouvez pas modifier cet article !";
            return redirect()->route('dashboard')->with('error', $error);
        }

        // On retourne la vue avec l'article
        return view('articles.edit', [
            'article' => $article,
            'categories'=> Category::all()
        ]);
    }

    public function update(Request $request, Article $article)
    {
        // On vérifie que l'utilisateur est bien le créateur de l'article
        if ($article->user_id !== Auth::user()->id) {
            abort(403);
        }

        // On récupère les données du formulaire
        $data = $request->only(['title', 'content', 'draft', 'categories']);

        // Gestion du draft
        $data['draft'] = isset($data['draft']) ? 1 : 0;

        // On met à jour l'article
        $article->update($data);
        $article->categories()->sync($request->input('categories'));

        // On redirige l'utilisateur vers la liste des articles (avec un flash)
        return redirect()->route('dashboard')->with('success', 'Article mis à jour !');
    }

    public function remove($id)
    {
        $article = Article::find($id);
        // On vérifie que l'utilisateur est bien le créateur de l'article
        if ($article->user_id !== Auth::user()->id) {
            $error = "Vous ne pouvez pas supprimer cet article !";
            return redirect()->route('dashboard')->with('error', $error);
        }
        
        $article->delete();
        return redirect()->route('dashboard')->with('success', 'Article supprimé !');
    }
}
