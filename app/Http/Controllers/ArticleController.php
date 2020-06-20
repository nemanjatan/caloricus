<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $articles = Article::where('is_published', '=', true)->latest()->get();
        return view('articles.index', ['articles' => $articles]);
    }

    /**
     * Display article if status published is true.
     *
     * @param Article $article
     * @return Response
     */
    public function show(Article $article)
    {
        $imagePath = Storage::url($article->featured_image);
        return $article->isPublished() ? view('articles.show', ['article' => $article, 'imagePath' => $imagePath]) : abort(404);
    }
}
