<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Angkringan 789 - Lorem Ipsum dolor sit Amet</title>
        @vite('resources/css/app.css')
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link
            href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
            rel="stylesheet"
        />
    </head>
    <body class="bg-zinc-800">
        <!-- INI UNTUK HEADING -->
        <!-- <h1>Heading</h1> -->
        @include('components.nav-bar')
        <div class="mt-20 pt-12 pb-4 flex flex-col gap-4 bg-zinc-700">
            <h1 class="text-zinc-100 font-bold text-3xl text-center">
                Our Produk
            </h1>
            @include('components.produk-search-bar')
        </div>
        <!-- INI UNTUK HEADING -->
        <div class="py-6">
            <!-- MENU KAMI -->
            <div
                class="px-8 grid grid-cols-1 md:grid-cols-3 grid-flow-row gap-4 max-w-fit mx-auto"
                id="menu"
            >
                <x-produk-card />
                <x-produk-card />
                <x-produk-card />
                <x-produk-card />
                <x-produk-card />
                <x-produk-card />
                <x-produk-card />
                <x-produk-card />
            </div>
            <!-- MENU KAMI -->
        </div>

        <!-- FOOTER / MEDIA SOCIAL -->
        <!-- <h1>Footer / Media Social</h1> -->
        <div class="mb-20">@include('components.footer2')</div>
        <!-- FOOTER / MEDIA SOCIAL -->

        <!-- KERANJANG -->
        <div class="fixed bottom-0 left-0 right-0 bg-zinc-500 p-4 text-white">
            <div class="flex justify-between items-center">
                <div>
                    <h2 class="text-lg font-semibold">Keranjang</h2>
                    <ul id="count" class="text-sm">
                        3 Items
                    </ul>
                </div>
                <div class="w-fit float-right text-right flex flex-col gap-4">
                    <p class="text-lg">
                        Total<span class="font-bold text-2xl" id="cart-total">
                            Rp 30.000
                        </span>
                    </p>
                </div>
                <button
                    class="bg-red-600 text-zinc-50 font-semibold py-2 px-4 rounded-lg"
                >
                    Pesan
                </button>
            </div>
        </div>
        <!-- KERANJANG -->

        <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
    </body>
</html>
