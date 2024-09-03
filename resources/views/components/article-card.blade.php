<div class="font-serif max-w-xs space-y-2 p-2">
    <div>
        <a href="/" class="text-lg font-bold">{{ $article->title }}</a>
        <p>{{ $article->published_at->diffForHumans() }} by {{ $article->author->name }}</p>
    </div>
    <a href="{{ $article->id }}">
        <img src="{{ $article->image }}" alt="Article picture">
    </a>
    <p>{{ Str::of($article->content)->before("\n") }}</p>
    <hr />
</div>
