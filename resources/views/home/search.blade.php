<x-app>
    <div class="flex flex-col items-center justify-center">
        <main class="pt-3 px-3 lg:px-0 w-full max-w-6xl">
            <h1 class="font-serif text-2xl font-bold py-6">Search results</h1>
            <div class="max-w-6xl masonry sm:masonry-sm md:masonry-md gap-8">
                @forelse($articles as $article)
                    <x-article-card :article="$article" />
                @empty
                    <p class="text-lg font-serif">No articles found</p>
                @endforelse
            </div>
        </main>
    </div>
</x-app>
