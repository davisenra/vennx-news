<?php

namespace App\Http\Controllers;

use App\Actions\ListArticles;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

final readonly class HomeController
{
    public function __construct(private ListArticles $listArticles) {}

    public function __invoke(Request $request): View
    {
        $articles = $this->listArticles->handle();

        return view(
            view: 'home/index',
            data: [
                'articles' => $articles,
            ]
        );
    }
}
