<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

final readonly class HomeController
{
    public function __invoke(Request $request): View
    {
        $articles = Article::query()
            ->with('author')
            ->orderBy('published_at', 'desc')
            ->paginate(10);

        return view(
            view: 'home/index',
            data: [
                'articles' => $articles,
            ]
        );
    }
}
