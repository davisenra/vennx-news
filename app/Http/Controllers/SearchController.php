<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

final readonly class SearchController
{
    public function __invoke(Request $request): View
    {
        $searchTerm = $request->query('search');

        $articles = Article::query()
            ->where('title', 'LIKE', "%{$searchTerm}%")
            ->with('author')
            ->orderBy('published_at', 'desc')
            ->paginate(10);

        return view(
            view: 'home/search',
            data: [
                'articles' => $articles,
            ]
        );
    }
}
