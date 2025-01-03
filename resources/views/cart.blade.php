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
        rel="stylesheet" />
    <!-- <link rel="stylesheet" href="https://cdn.tailwindcss.com">
      -->
</head>

<body class="bg-zinc-800 text-white flex flex-col min-h-screen justify-between" x-data="checkout()">
    @php
        $cart = session()->get('cart', []);

        $total = 0;
        foreach ($cart as $item) {
            $total += $item['total_price'];
        }

        $filteredItems = array_filter($cart, function ($item) {
            return isset($item['type']) && $item['type'] == 'product';
        });

        $filteredMenus = array_filter($cart, function ($item) {
            return isset($item['type']) && $item['type'] == 'menu';
        });

        $product_id = array_map(function ($item) {
            return $item['id'];
        }, $filteredItems);

        $product_quantity = array_map(function ($item) {
            return $item['quantity'];
        }, $filteredItems);

        $product_total_amount = 0;
        foreach ($filteredItems as $item) {
            $product_total_amount += $item['total_price'];
        }

        $product_total_points = 0;
        foreach ($filteredItems as $item) {
            $product_total_points += $item['point'];
        }

        $product_prices = array_map(function ($item) {
            return $item['price'];
        }, $filteredItems);

        $product_subtotal_prices = array_map(function ($item) {
            return $item['total_price'];
        }, $filteredItems);

        $menu_id = array_map(function ($item) {
            return $item['id'];
        }, $filteredMenus);

        $menu_quantity = array_map(function ($item) {
            return $item['quantity'];
        }, $filteredMenus);

        $menu_prices = array_map(function ($item) {
            return $item['price'];
        }, $filteredMenus);

        $menu_subtotal_prices = array_map(function ($item) {
            return $item['total_price'];
        }, $filteredMenus);

        $menu_total_amount = 0;
        foreach ($filteredMenus as $item) {
            $menu_total_amount += $item['total_price'];
        }

        $menu_total_points = 0;
        foreach ($filteredMenus as $item) {
            $menu_total_points += $item['point'];
        }

        $total_points = $product_total_points + $menu_total_points;
        $total_price = $product_total_amount + $menu_total_amount;
    @endphp
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
            <div class="flex justify-between items-center border-b border-zinc-600 pb-4 mb-4">
                <span class="text-lg font-semibold">Nama Barang</span>
                <span class="text-lg font-semibold">Harga</span>
                <span class="text-lg font-semibold">Jumlah</span>
            </div>
            @if (count($cart) > 0)
                @foreach ($cart as $item)
                    <div class="flex justify-between items-center border-b border-zinc-600 pb-4 mb-4">
                        <span>{{ $item['name'] }}</span>
                        <span>Rp {{ number_format($item['price'], 0, ',', '.') }}</span>
                        <span>{{ $item['quantity'] }}</span>
                    </div>
                @endforeach
            @else
                <div class="flex justify-center items-center">
                    <span class="text-lg font-semibold">Keranjang Kosong</span>
                </div>
            @endif
        </div>

        <!-- Total dan Tombol Pesan -->
        <div class="flex justify-between items-center">
            <h2 class="text-xl font-semibold">
                Total: <span class="text-red-500">Rp {{ number_format($total, 0, ',', '.') }}</span>
            </h2>
            <div class="flex gap-4">
                <input type="text" class="w-full p-2 rounded-lg text-black" placeholder="Kode Voucher"
                    x-model="voucherCode">
                <input type="number" class="w-full p-2 rounded-lg text-black" placeholder="Nomor Meja"
                    x-model="tableNumber">
                <button type="button" class="bg-red-600 text-white py-2 px-6 rounded-lg shadow hover:bg-red-700"
                    @click="submitOrder()">
                    PESAN
                </button>
            </div>
        </div>
    </div>
    <!-- FOOTER / MEDIA SOCIAL -->
    @include('components.footer2')
    <!-- FOOTER / MEDIA SOCIAL -->

    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
    <script>
        function checkout() {
            return {
                tableNumber: '',
                voucherCode: '',
                submitOrder() {
                    if (this.tableNumber == '') {
                        alert('Nomor Meja Harus Diisi');
                        return;
                    }

                    const data = {
                        products: @json($product_id),
                        menus: @json($menu_id),
                        quantities_products: @json($product_quantity),
                        quantities_menus: @json($menu_quantity),
                        prices_products: @json($product_prices),
                        prices_menus: @json($menu_prices),
                        subtotal_prices_products: @json($product_subtotal_prices),
                        subtotal_prices_menus: @json($menu_subtotal_prices),
                        table_number: parseInt(this.tableNumber),
                        voucher_code: this.voucherCode,
                        total_points: {{ $total_points }},
                        total_price: {{ $total_price }}
                    };

                    console.log(data);

                    fetch('{{ route('checkout') }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            },
                            body: JSON.stringify(data),
                        }).then(response => response.json())
                        .then(data => {
                            alert('Transaksi berhasil');
                            this.items = [];
                            this.tableNumber = '';
                            console.log(data);

                            const url = new URL('{{ route('payment.receipt') }}');
                            url.searchParams.append('invoice_number', data.data.invoice_number);
                            window.location.href = url.toString();
                        }).catch(error => {
                            console.error('Error:', error);
                            alert('Transaksi gagal: ' + error.message);
                        });
                }
            }
        }
    </script>
</body>

</html>
