<?php

namespace App\Livewire;

use App\Models\Article;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class ArticlesTable extends Component
{
    use WithPagination;

    public function deleteArticle(int $articleId): void
    {
        $article = Article::findOrFail($articleId);
        $article->delete();

        session()->flash('message', 'Article deleted successfully!');
    }

    public function render(): View
    {
        $user = Auth::user();
        $articles = $user->articles()->paginate(10);

        return view('livewire.articles-table', [
            'articles' => $articles,
        ]);
    }
}
