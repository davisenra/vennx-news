<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreArticleRequest;
use App\Models\Article;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
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

    public function store(StoreArticleRequest $request): RedirectResponse
    {
        $payload = $request->validated();
        /** @var UploadedFile $articleImage */
        $articleImage = $request->file('image');
        $imagePath = $articleImage->storePublicly('public/images');

        $article = new Article([
            'title' => $payload['title'],
            'content' => $payload['content'],
            'image' => Storage::url($imagePath),
            'published_at' => new \DateTime('now'),
        ]);

        $author = auth()->user();
        $article->author()->associate($author);
        $article->save();

        return redirect()->route('article.show', ['id' => $article->id]);
    }

    public function destroy(User $user, int $articleId): RedirectResponse
    {
        $user->articles()
            ->findOrFail($articleId)
            ->delete();

        return redirect()->route('article.index');
    }
}
