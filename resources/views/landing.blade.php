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
        <div class="pt-16">
            <video class="w-full h-full object-cover" autoplay loop muted>
                <source
                    src="{{ asset('assets/bgvids.mp4') }}"
                    type="video/mp4"
                />
                Your browser does not support the video tag.
            </video>
            @include('components.nav-bar')
        </div>
        <!-- INI UNTUK HEADING -->
        <div class="mt-10">
            <!-- TENTANG KAMI -->
            <section class="bg-zinc-800 text-white py-16 px-6">
                <div class="mx-auto flex gap-12 flex-col md:flex-row w-fit">
                    <!-- Ilustrasi SVG di Kiri -->
                    <div class="w-fit">
                        <img
                            src="{{ asset('assets/illustrasi.png') }}"
                            alt=""
                            class="w-96"
                        />
                    </div>

                    <!-- Teks di Kanan -->
                    <div class="max-w-lg text-left">
                        <h2 class="text-4xl font-extrabold mb-4">
                            Tentang Kami
                        </h2>
                        <p class="text-zinc-300 text-lg mb-6">
                            Mahasiswa Semarang, merapat! Angkringan 789 adalah
                            tempat yang pas buat nongkrong sambil mengerjakan
                            tugas.
                            <br />
                            Menu lengkap, harga mahasiswa, dan suasana yang
                            mendukung konsentrasi. Yuk, cobain Angkringan 789!
                        </p>

                        <p class="text-lg text-zinc-300 mb-6">
                            Menu lengkap, rasa mantap, dan suasana yang bikin
                            betah. Jangan sampai ketinggalan ya!
                        </p>

                        <p class="text-sm text-zinc-400">
                            #Angkringan789 #KulinerSemarang #NongkrongAsik
                        </p>
                    </div>
                </div>
            </section>

            <!-- TENTANG KAMI -->

            <!-- MENU KAMI -->
            <div class="px-8 py-12 flex flex-col gap-3" id="menu">
                <h1 class="w-fit mx-auto font-bold text-2xl text-zinc-100">
                    Menu Kami
                </h1>
                <div class="flex gap-2 mx-auto w-fit">
                    {{-- <x-menu-card />
                    <x-menu-card />
                    <x-menu-card /> --}}
                </div>
            </div>
            <!-- MENU KAMI -->

            <!-- Produk KAMI -->
            <div class="px-8 py-12 flex flex-col gap-3" id="produk">
                <h1 class="w-fit mx-auto font-bold text-2xl text-zinc-100">
                    Produk Kami
                </h1>
                <div class="flex gap-2 mx-auto w-fit">
                    <x-Produk-card />
                    <x-Produk-card />
                    <x-Produk-card />
                </div>
            </div>
            <!-- Produk KAMI -->

            <!-- BEST SELLER PRODUCT -->
            <!-- <h1>Best Seller Product</h1> -->
            <!-- BEST SELLER PRODUCT -->
        </div>

        <!-- FOOTER / MEDIA SOCIAL -->
        <!-- <h1>Footer / Media Social</h1> -->
        @include('components.footer2')
        <!-- FOOTER / MEDIA SOCIAL -->

        <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
    </body>
</html>
