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
    <body class="font-poppins flex flex-col min-h-screen">
        <!-- INI UNTUK HEADING -->
        <nav class="bg-slate-100 px-24 py-6">
            <h1 class="font-bold italic text-3xl mx-auto w-fit">
                Angkringan<span class="text-red-600">789</span>
            </h1>
        </nav>
        <!-- INI UNTUK HEADING -->

        <!-- Login Form -->
        <div class="flex flex-1 items-center justify-center bg-red-100">
            <div class="max-w-md w-full bg-white p-6 rounded-md shadow-lg">
                <h2 class="text-2xl font-semibold text-center mb-6">
                    Login to Angkringan789
                </h2>
                <form action="#" method="POST">
                    <div class="mb-4">
                        <label
                            for="username"
                            class="block text-sm font-medium text-gray-700"
                            >Username</label
                        >
                        <input
                            type="text"
                            id="username"
                            name="username"
                            class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-red-600"
                            placeholder="Masukkan Username Anda"
                            required
                        />
                    </div>
                    <div class="mb-4">
                        <label
                            for="password"
                            class="block text-sm font-medium text-gray-700"
                            >Password</label
                        >
                        <input
                            type="password"
                            id="password"
                            name="password"
                            class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-red-600"
                            placeholder="Masukkan Password Anda"
                            required
                        />
                    </div>
                    <div
                        class="flex flex-col items-center gap-4 justify-between"
                    >
                        <button
                            type="submit"
                            class="w-full bg-red-600 text-white py-2 px-4 rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-600"
                        >
                            Login
                        </button>
                        <p class="text-sm font-medium text-zinc-700">
                            Belum punya akun?
                            <a href="/signup" class="underline text-red-600"
                                >daftar disini</a
                            >
                        </p>
                    </div>
                </form>
            </div>
        </div>
        <!-- FOOTER / MEDIA SOCIAL -->
        @include('components.footer2')
        <!-- FOOTER / MEDIA SOCIAL -->
    </body>
</html>
