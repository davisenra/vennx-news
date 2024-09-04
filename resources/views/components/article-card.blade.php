<div class="font-serif max-w-xs space-y-2 p-2">
    <a href="{{ route('article.show', ['id' => $article->id]) }}">
        <img src="{{ $article->image }}" alt="Article picture">
    </a>
    <div>
        <a href="/" class="text-lg font-bold">{{ $article->title }}</a>
        <p>{{ $article->published_at->diffForHumans() }} by {{ $article->author->name }}</p>
    </div>
    <p>{{ trim(mb_substr($article->content, 0, 120)) . '...' }}</p>
    <hr />
</div>
