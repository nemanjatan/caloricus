<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
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
