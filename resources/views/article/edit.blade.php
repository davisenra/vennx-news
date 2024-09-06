<x-app>
    <div class="flex flex-col justify-center items-center">
        <main class="px-3 xl:px-0 max-w-6xl pt-3 w-full">
            <h1 class="mt-3 font-serif text-2xl font-bold">Edit article</h1>
            <form action="{{ route('article.update', $article) }}" method="POST" enctype="multipart/form-data" class="flex flex-col space-y-4">
                @csrf
                <div class="flex flex-col">
                    <label class="font-bold" for="title">Title</label>
                    <input type="text" name="title" id="title" placeholder="Title" value="{{ $article->title }}" class="rounded border max-w-xl py-2 px-3 leading-tight focus:outline-none focus:shadow-outline" required>
                    @error('title')
                        <div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
                    @enderror
                </div>
                <div class="flex flex-col md:flex-row space-y-3 lg:space-y-0 md:space-x-3">
                    <div class="flex flex-col">
                        <p class="font-bold">Current image</p>
                        <div class="p-3 border rounded">
                            <img src="{{ $article->image }}" alt="Image" class="max-w-xs object-fill" />
                        </div>
                    </div>
                    <div class="flex flex-col">
                        <label class="font-bold" for="new_image">New image</label>
                        <input type="file" name="new_image" id="new_image" class="rounded max-w-xl py-2">
                        @error('image')
                            <div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="flex flex-col">
                    <label class="font-bold" for="content">Content</label>
                    <textarea name="content" id="content" cols="30" rows="10" content="{{ $article->content }}" class="rounded min-h-96 border py-2 px-3 leading-tight focus:outline-none focus:shadow-outline" required>{{ $article->content }}</textarea>
                    @error('content')
                        <div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
                    @enderror
                </div>
                <div class="flex">
                    <button class="flex bg-green-400 text-white py-2 px-6 rounded-sm font-bold hover:bg-green-500 transition-all">
                        <span class="material-icons mr-1">save</span>
                        Update
                    </button>
                </div>
            </form>
        </main>
    </div>
</x-app>
