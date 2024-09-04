<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ArticleController
{
    public function index(User $user): View
    {
        $articles = $user
            ->articles()
            ->orderBy('published_at', 'desc')
            ->get();

        return view('article.index', [
            'articles' => $articles,
        ]);
    }

    public function create(): View
    {
        return view('article.create');
    }

    public function show(int $articleId): View
    {
        $article = Article::where(['id' => $articleId])
            ->with('author')
            ->firstOrFail();

        return view('article.show', [
            'article' => $article,
        ]);
    }

    public function destroy(User $user, int $articleId): RedirectResponse
    {
        $user->articles()
            ->findOrFail($articleId)
            ->delete();

        return redirect()->route('article.index');
    }
}
