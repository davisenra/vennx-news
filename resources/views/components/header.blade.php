<header class="flex justify-evenly items-center px-2 py-4 border-b">
    <div>
        <a href="/" class="font-serif text-2xl font-bold">Vennx News</a>
    </div>
    <div class="flex items-center">
        <form method="GET" action="/search">
            @csrf
            <input type="text" name="search" id="search" placeholder="Search" class="rounded border w-full min-w-72 py-2 px-3 leading-tight focus:outline-none focus:shadow-outline">
        </form>
        <button class="flex items-center -mx-8 text-neutral-700">
            <span class="material-icons">search</span>
        </button>
    </div>
    <div class="flex space-x-2">
        <a href="/login" class="flex bg-white py-2 px-3 rounded-sm font-bold hover:bg-black hover:text-white transition-all">
            Profile
            <span class="material-icons ml-1">person</span>
        </a>
        <a href="/login" class="flex bg-white py-2 px-3 rounded-sm font-bold hover:bg-black hover:text-white transition-all">
            Write
            <span class="material-icons ml-1">edit</span>
        </a>
    </div>
</header>
