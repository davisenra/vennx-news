<x-app>
    <div class="flex flex-col items-center justify-center">
        <main class="pt-3 w-full max-w-6xl">
            <h1 class="font-serif text-2xl font-bold py-6">Recent articles</h1>
            <div class="max-w-6xl place-items-center items-start w-full grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3">
                @foreach($articles as $article)
                    <x-article-card :article="$article" />
                @endforeach
            </div>
            <div class="py-6">
                {{ $articles->links() }}
            </div>
        </main>
    </div>
</x-app>
