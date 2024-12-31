<form class="max-w-lg w-full mx-auto">
    <div class="flex ">
        <label
            for="search-dropdown"
            class="mb-2 text-sm font-medium text-zinc-900 sr-only"
            >Your Email</label
        >

        <div class="relative w-full">
            <input
                type="search"
                id="search-dropdown"
                class="block p-2.5 w-full z-20 text-sm text-zinc-900 bg-zinc-50 rounded-e-lg border-s-zinc-50 border-s-2 border border-zinc-300 focus:ring-red-500 focus:border-red-500 rounded-s-lg"
                placeholder="Cari Produk Favoritmu disini...."
                required
            />
            <button
                type="submit"
                class="absolute top-0 end-0 p-2.5 text-sm font-medium h-full text-white bg-red-700 rounded-e-lg border border-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300"
            >
                <svg
                    class="w-4 h-4"
                    aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 20 20"
                >
                    <path
                        stroke="currentColor"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"
                    />
                </svg>
                <span class="sr-only">Search</span>
            </button>
        </div>
    </div>
</form>
