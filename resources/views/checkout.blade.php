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
            <h1 class="text-3xl font-bold mb-6 text-center">Checkout</h1>

            <!-- Invoice dan No Meja -->
            <div class="bg-zinc-700 p-6 rounded-lg shadow-lg mb-6">
                <h2 class="text-xl font-semibold mb-4">Detail Pesanan</h2>
                <p class="mb-2">
                    No. Invoice: <span class="font-bold">#INV123456</span>
                </p>
                <p>No. Meja: <span class="font-bold">12</span></p>
            </div>

            <!-- Status Pesanan -->
            <div
                class="bg-zinc-700 p-6 rounded-lg shadow-lg md:mx-auto flex flex-col md:flex-row w-full justify-between items-center"
            >
                <h2 class="text-xl font-semibold mb-4">Status Pesanan</h2>
                <div class="flex items-center gap-4">
                    <!-- Status Text -->
                    <div>
                        <h3 class="text-lg font-semibold text-yellow-500">
                            Menunggu Pembayaran
                        </h3>
                        <p class="text-sm text-gray-400">
                            Silakan lakukan pembayaran untuk melanjutkan proses.
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <!-- FOOTER / MEDIA SOCIAL -->
        @include('components.footer2')
        <!-- FOOTER / MEDIA SOCIAL -->
    </body>
</html>
