<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use App\Models\Article;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ArticleController
{
    public function index(): View
    {
        return view('article.index');
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

    public function edit(Article $article, Request $request): View
    {
        if ($request->user()->cannot('update', $article)) {
            abort(403);
        }

        return view('article.edit', [
            'article' => $article,
        ]);
    }

    public function update(UpdateArticleRequest $request, Article $article): RedirectResponse
    {
        if ($request->user()->cannot('update', $article)) {
            abort(403);
        }

        $payload = $request->validated();
        /** @var ?UploadedFile $newImage */
        $newImage = $request->file('new_image');

        if ($newImage) {
            $imagePath = $newImage->storePublicly('public/images');
            $payload['image'] = Storage::url($imagePath);
        }

        $article->update($payload);

        return redirect()->route('article.show', ['id' => $article->id]);
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
}
