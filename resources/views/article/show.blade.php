<x-app>
    <div class="flex flex-col justify-center items-center">
        <main class="px-3 max-w-6xl pt-3 flex flex-col">
            <div class="py-3 flex justify-center">
                <img src="{{ $article->image }}" alt="...">
            </div>
            <div class="py-3 space-y-2">
                <h1 class="font-serif text-3xl font-bold">{{ $article->title }}</h1>
                <p class="flex">
                    <span class="material-icons mr-1">person</span>
                    {{ $article->author->name }}
                </p>
                <p class="flex">
                    <span class="material-icons mr-1">today</span>
                    {{ $article->published_at->format('Y-m-d') }} ({{ $article->published_at->diffForHumans() }})
                </p>
            </div>
            <article class="prose lg:prose-xl font-serif text-lg leading-10 whitespace-pre-wrap">{{ $article->content }}</article>
        </main>
    </div>
</x-app>
