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
        rel="stylesheet" />
</head>

<body class="bg-zinc-800" x-data="cart()">
    {{-- @dd($menus) --}}
    <!-- INI UNTUK HEADING -->
    <!-- <h1>Heading</h1> -->
    @include('components.nav-bar')
    <div class="mt-20 pt-12 pb-8 bg-zinc-700 flex flex-col gap-4">
        <h1 class="text-zinc-100 font-bold text-3xl text-center">
            Our Menu
        </h1>
        @include('components.menu-search-bar')
    </div>
    <!-- INI ISINYA PER KATEGORI -->
    <div class="flex flex-col gap-8 my-8">
        <!-- INI UNTUK HEADING per kategori-->
        @foreach ($categories as $category)
            <div class="w-fit mx-auto flex gap-4 flex-col">
                <!-- MENU KAMI -->
                <h1 class="font-semibold text-2xl text-white">{{ $category->name }}</h1>
                <div class="grid grid-cols-1 md:grid-cols-3 grid-flow-row gap-8 max-w-fit mx-auto" id="menu">
                    @foreach ($category->menus as $menu)
                        <x-menu-card :menu="$menu"
                            x-on:add-to-cart="addToCart($event.detail.id, $event.detail.name, $event.detail.price, $event.detail.point)"
                            x-on:remove-from-cart="removeFromCart($event.detail.id)" />
                    @endforeach
                </div>
                <!-- MENU KAMI -->
            </div>
        @endforeach
    </div>
    <!-- FOOTER / MEDIA SOCIAL -->
    <!-- <h1>Footer / Media Social</h1> -->
    <div class="mb-20">@include('components.footer2')</div>
    <!-- FOOTER / MEDIA SOCIAL -->
    <!-- disini saya ingin menambahkan halaman  -->

    <div class="fixed bottom-0 left-0 right-0 bg-zinc-500 p-4 text-white">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="text-lg font-semibold">Keranjang</h2>
                <span id="count" class="text-sm" x-text="$store.cart.cartCount">
                </span>
                <span class="text-sm">Item</span>
            </div>
            <div class="w-fit float-right text-right flex flex-col gap-4">
                <p class="text-lg">
                    Total
                    <span class="font-bold text-2xl" id="cart-total"
                        x-text="$store.cart.formatPrice($store.cart.totalPrice)">
                    </span>
                </p>
            </div>
            <divclass="flex gap-4">
            <input type="text" id="table-number"
                class="w-28 text-sm text-center text-black outline-none border border-zinc-600 rounded-lg"
                placeholder="Nomor Meja" x-model="$store.cart.tableNumber">
            <button @click="$store.cart.submitOrder()"
                class="bg-red-600 text-zinc-50 font-semibold py-2 px-4 rounded-lg">
                Pesan
            </button>
        </div>
    </div>
    </div>
    <!-- Keranjang -->
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.store('cart', {
                items: [],
                tableNumber: '',
                get cartCount() {
                    return this.items.reduce((count, item) => count + item.quantity, 0);
                },
                get totalPrice() {
                    return this.items.reduce((total, item) => total + item.quantity * item.price, 0);
                },
                getItemQuantity(id) {
                    const item = this.items.find(item => item.id === id);
                    return item ? item.quantity : 0;
                },
                removeFromCart(id) {
                    this.items = this.items.filter(item => item.id !== id);
                },
                addToCart(id, name, price, point) {
                    const existingItem = this.items.find(item => item.id === id);
                    if (existingItem) {
                        existingItem.quantity++;
                    } else {
                        this.items.push({
                            id,
                            name,
                            price,
                            point,
                            quantity: 1
                        });
                    }
                },
                submitOrder() {
                    if (this.items.length === 0) {
                        alert('Keranjang kosong');
                        return;
                    }

                    if (!this.tableNumber.trim()) {
                        alert('Nomor meja harus diisi');
                        return;
                    }

                    const data = {
                        menus: this.items.map(item => item.id),
                        quantities: this.items.map(item => item.quantity),
                        prices: this.items.map(item => item.price),
                        table_number: parseInt(this.tableNumber),
                        subtotal_prices: this.items.map(item => item.quantity * item.price),
                        total_points: this.items.reduce((total, item) => total + item.quantity * item
                            .point, 0),
                        total_price: this.items.reduce((total, item) => total + item.quantity * item
                            .price, 0)
                    };

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
                        }).catch(error => {
                            console.error('Error:', error);
                            alert('Transaksi gagal: ' + data.message);
                        });
                },
                formatPrice(value) {
                    return new Intl.NumberFormat('id-ID', {
                        style: 'currency',
                        currency: 'IDR',
                        minimumFractionDigits: 0,
                    }).format(value);
                },
            });
        });
    </script>
</body>

</html>
