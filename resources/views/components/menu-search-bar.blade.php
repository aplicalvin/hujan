<form class="max-w-lg w-full mx-auto">
    <div class="flex">
        <label
            for="search-dropdown"
            class="mb-2 text-sm font-medium text-zinc-900 sr-only"
            >Your Email</label
        >
        <button
            id="dropdown-button"
            data-dropdown-toggle="dropdown"
            class="flex-shrink-0 z-10 inline-flex items-center py-2.5 px-4 text-sm font-medium text-center text-zinc-900 bg-zinc-100 border border-zinc-300 rounded-s-lg hover:bg-zinc-200 focus:ring-4 focus:outline-none focus:ring-zinc-100"
            type="button"
        >
            Semua Kategori
            <svg
                class="w-2.5 h-2.5 ms-2.5"
                aria-hidden="true"
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 10 6"
            >
                <path
                    stroke="currentColor"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="m1 1 4 4 4-4"
                />
            </svg>
        </button>
        <div
            id="dropdown"
            class="z-10 hidden bg-white divide-y divide-zinc-100 rounded-lg shadow w-44"
        >
            <ul
                class="py-2 text-sm text-zinc-700"
                aria-labelledby="dropdown-button"
            >
                <li>
                    <button
                        type="button"
                        class="inline-flex w-full px-4 py-2 hover:bg-zinc-100"
                    >
                        Coffee
                    </button>
                </li>
                <li>
                    <button
                        type="button"
                        class="inline-flex w-full px-4 py-2 hover:bg-zinc-100"
                    >
                        Makanan
                    </button>
                </li>
                <li>
                    <button
                        type="button"
                        class="inline-flex w-full px-4 py-2 hover:bg-zinc-100"
                    >
                        Es Teh
                    </button>
                </li>
            </ul>
        </div>
        <div class="relative w-full">
            <input
                type="search"
                id="search-dropdown"
                class="block p-2.5 w-full z-20 text-sm text-zinc-900 bg-zinc-50 rounded-e-lg border-s-zinc-50 border-s-2 border border-zinc-300 focus:ring-red-500 focus:border-red-500"
                placeholder="Cari Makanan / Minuman kekinian disini...."
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
