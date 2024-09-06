<div>
    @if (session()->has('message'))
        <div class="p-2 my-3 bg-green-500 text-white">
            {{ session('message') }}
        </div>
    @endif

    <div class="my-3 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3">
        @forelse ($articles as $article)
            <div class="max-w-sm h-fit flex flex-col bg-white border-gray-200 rounded-lg border">
                <div class="rounded">
                    <img src="{{ $article->image }}" alt="Thumbnail" class="object-cover">
                </div>
                <div class="text-left py-3 px-3">
                    <p class="font-bold">{{ Str::limit($article->title, 120, '...') }}</p>
                    <p class="text-sm">{{ $article->published_at->format('d/m/Y H:i') }} ({{ $article->published_at->diffForHumans() }})</p>
                    <div x-data="{ showConfirmation: false, timeoutId: null }" class="grid grid-cols-3 mt-3">
                        <button
                            class="flex justify-center items-center py-2 rounded-tl rounded-bl bg-red-400 text-white hover:bg-red-500 transition-colors"
                            @click="if (!showConfirmation) { showConfirmation = true; timeoutId = setTimeout(() => showConfirmation = false, 2000); } else { $wire.deleteArticle({{ $article->id }}); }"
                        >
                            <template x-if="!showConfirmation">
                                <span class="material-icons">delete</span>
                            </template>
                            <template x-if="showConfirmation">
                                <span class="font-bold">Are you sure?</span>
                            </template>
                        </button>
                        <a href="{{ route('article.edit', $article->id) }}" class="flex justify-center items-center py-2 bg-blue-400 text-white hover:bg-blue-500 transition-colors">
                            <span class="material-icons">edit</span>
                        </a>
                        <a href="{{ route('article.show', $article->id) }}" class="flex justify-center items-center py-2 rounded-tr rounded-br bg-green-400 text-white hover:bg-green-500 transition-colors">
                            <span class="material-icons">visibility</span>
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="py-3">
                <p class="font-serif text-2xl">You haven't written any articles.</p>
            </div>
        @endforelse
    </div>

    <div class="mt-4">
        {{ $articles->links() }}
    </div>
</div>
