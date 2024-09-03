<?php

namespace App\Actions;

use App\Models\Article;
use Illuminate\Pagination\LengthAwarePaginator;

class ListArticles implements Action
{
    /**
     * Returns a paginated collection of Articles
     *
     * @return LengthAwarePaginator
     */
    public function handle(): LengthAwarePaginator
    {
        return Article::query()
            ->with('author')
            ->orderBy('published_at', 'desc')
            ->paginate(10);
    }
}
