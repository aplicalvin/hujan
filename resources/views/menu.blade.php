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

<body class="bg-zinc-800" x-data="menuCart()">
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
                <span id="count" class="text-sm" x-text="$store.combinedCart.cartCount">
                </span>
                <span class="text-sm">Item</span>
            </div>
            <div class="w-fit float-right text-right flex flex-col gap-4">
                <p class="text-lg">
                    Total
                    <span class="font-bold text-2xl" id="cart-total"
                        x-text="$store.combinedCart.formatPrice($store.combinedCart.totalPrice)">
                    </span>
                </p>
            </div>
            <button @click="$store.combinedCart.submitOrder()"
                class="bg-red-600 text-zinc-50 font-semibold py-2 px-4 rounded-lg">
                Pesan
            </button>
        </div>
    </div>
    <!-- Keranjang -->
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
    <script>
        document.addEventListener('alpine:init', () => {

            Alpine.store('combinedCart', {
                items: [],
                get cartCount() {
                    return this.items.reduce((count, item) => count + item.quantity, 0);
                },
                get totalPrice() {
                    return this.items.reduce((total, item) => total + item.quantity * item.price, 0);
                },
                getCart() {
                    fetch('{{ route('menu.cart') }}')
                        .then(response => response.json())
                        .then(data => {
                            this.items = data;
                            console.log(this.items);
                        });
                },
                formatPrice(value) {
                    return new Intl.NumberFormat('id-ID', {
                        style: 'currency',
                        currency: 'IDR',
                        minimumFractionDigits: 0,
                    }).format(value);
                },
                submitOrder() {
                    if (this.items.length == 0) {
                        alert('Keranjang kosong');
                        return;
                    }

                    window.location.href = '{{ route('cart') }}';
                }
            });

            Alpine.store('menuCart', {
                items: [],
                getItemQuantity(id) {
                    const menus = this.items.filter(item => item.id == id && item.type == 'menu');
                    return menus.reduce((total, menu) => total + menu.quantity, 0);
                },
                getCart() {
                    fetch('{{ route('menu.cart') }}')
                        .then(response => response.json())
                        .then(data => {
                            this.items = data;
                        });
                },
                removeFromCart(id) {
                    const itemIndex = this.items.findIndex(item => item.id === id);
                    if (itemIndex !== -1) {
                        this.items[itemIndex].quantity--;
                        this.items[itemIndex].total_price = this.items[itemIndex].price * this.items[
                            itemIndex].quantity;

                        if (this.items[itemIndex].quantity <= 0) {
                            this.items.splice(itemIndex, 1);
                        }
                    }
                    fetch('{{ route('menu.remove.from.cart') }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            },
                            body: JSON.stringify({
                                id: id,
                                type: 'menu',
                            }),
                        }).then(response => response.json())
                        .then(data => {
                            Alpine.store('combinedCart').getCart();
                            Alpine.store('menuCart').getCart();
                        })
                        .catch(error => {
                            console.error('Error:', error);
                        });
                },
                addToCart(id, name, price, point) {
                    const existingItem = this.items.find(item => item.id === id);

                    if (existingItem) {
                        existingItem.quantity++;
                        existingItem.total_price = existingItem.price * existingItem.quantity;
                    } else if (this.items.length == 1) {
                        this.items[0].quantity++;
                        this.items[0].total_price = this.items[0].price * this.items[0].quantity;
                    } else {
                        this.items.push({
                            id: id,
                            type: 'menu',
                            name,
                            price,
                            point,
                            quantity: 1,
                            total_price: price * this.quantity,
                        });
                    }

                    fetch('{{ route('menu.add.to.cart') }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            },
                            body: JSON.stringify({
                                id: id,
                                type: 'menu',
                                name,
                                price,
                                point,
                                quantity: 1,
                                total_price: price
                            }),
                        })
                        .then(response => response.json())
                        .then(data => {
                            console.log(data);
                            Alpine.store('combinedCart').getCart();
                            Alpine.store('menuCart').getCart();
                        })
                        .catch(error => {
                            console.error('Error:', error);
                        });
                }
            });
        });

        document.addEventListener('DOMContentLoaded', () => {
            Alpine.store('combinedCart').getCart();
            Alpine.store('menuCart').getCart();
        });
    </script>
</body>

</html>
