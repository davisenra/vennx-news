<x-app>
    <div class="flex flex-col justify-center items-center">
        <main class="px-3 xl:px-0 max-w-6xl pt-3 w-full">
            <h1 class="mt-3 font-serif text-2xl font-bold">New article</h1>
            <form action="{{ route('article.store') }}" method="POST" enctype="multipart/form-data" class="flex flex-col space-y-4">
                @csrf
                <div class="flex flex-col">
                    <label class="font-bold" for="title">Title</label>
                    <input type="text" name="title" id="title" placeholder="Title" value="{{ old('title') }}" class="rounded border max-w-xl py-2 px-3 leading-tight focus:outline-none focus:shadow-outline" required>
                    @error('title')
                        <div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
                    @enderror
                </div>
                <div class="flex flex-col">
                    <label class="font-bold" for="image">Image</label>
                    <input type="file" name="image" id="image" class="rounded max-w-xl py-2" required>
                    @error('image')
                        <div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
                    @enderror
                </div>
                <div class="flex flex-col">
                    <label class="font-bold" for="content">Content</label>
                    <textarea name="content" id="content" cols="30" rows="10" class="rounded border py-2 px-3 leading-tight focus:outline-none focus:shadow-outline" required>{{ old('content') }}</textarea>
                    @error('content')
                        <div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
                    @enderror
                </div>
                <div class="flex">
                    <button class="flex bg-green-400 text-white py-2 px-6 rounded-sm font-bold hover:bg-green-500 transition-all">
                        <span class="material-icons mr-1">send</span>
                        Publish
                    </button>
                </div>
            </form>
        </main>
    </div>
</x-app>
