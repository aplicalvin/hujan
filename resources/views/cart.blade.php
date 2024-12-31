<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Keranjang Belanja</title>
        @vite('resources/css/app.css')
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link
            href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
            rel="stylesheet"
        />
        <!-- <link rel="stylesheet" href="https://cdn.tailwindcss.com">
      -->
    </head>
    <body
        class="bg-zinc-800 text-white flex flex-col min-h-screen justify-between"
    >
        <!-- INI UNTUK HEADING -->
        <nav class="bg-slate-100 px-24 py-6">
            @include('components.nav-bar')
        </nav>
        <!-- INI UNTUK HEADING -->

        <div class="max-w-[960px] mt-12 py-8 mx-auto w-full">
            <h1 class="text-3xl font-bold mb-6 text-center">
                Keranjang Belanja
            </h1>

            <!-- List Barang -->
            <div class="bg-zinc-700 p-6 rounded-lg shadow-lg mb-6">
                <div
                    class="flex justify-between items-center border-b border-zinc-600 pb-4 mb-4"
                >
                    <span class="text-lg font-semibold">Nama Barang</span>
                    <span class="text-lg font-semibold">Harga</span>
                    <span class="text-lg font-semibold">Jumlah</span>
                </div>
                <div
                    class="flex justify-between items-center border-b border-zinc-600 pb-4 mb-4"
                >
                    <span>Tanblack Coffe Thulungo </span>
                    <span>Rp 19.000</span>
                    <span>2</span>
                </div>
                <div
                    class="flex justify-between items-center border-b border-zinc-600 pb-4 mb-4"
                >
                    <span>Intel (indomie Telur) </span>
                    <span>Rp 13.000</span>
                    <span>2</span>
                </div>
            </div>

            <!-- Total dan Tombol Pesan -->
            <div class="flex justify-between items-center">
                <h2 class="text-xl font-semibold">
                    Total: <span class="text-red-500">Rp 64.000</span>
                </h2>
                <a
                    href="/checkout"
                    class="bg-red-600 text-white py-2 px-6 rounded-lg shadow hover:bg-red-700"
                >
                    PESAN
                </a>
            </div>
        </div>
        <!-- FOOTER / MEDIA SOCIAL -->
        @include('components.footer2')
        <!-- FOOTER / MEDIA SOCIAL -->
    </body>
</html>
