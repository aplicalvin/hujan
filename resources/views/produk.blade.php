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
        <div class="px-8 grid grid-cols-1 md:grid-cols-3 grid-flow-row gap-4 max-w-fit mx-auto" id="menu">
            @foreach ($products as $product)
                <x-produk-card :product="$product"
                    x-on:add-to-cart="$store.cart.addToCart($event.detail.product_id, $event.detail.name, $event.detail.price, $event.detail.point)"
                    x-on:remove-from-cart="$store.cart.removeFromCart($event.detail.product_id)" />
            @endforeach
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
            <button @click="$store.cart.submitOrder()"
                class="bg-red-600 text-zinc-50 font-semibold py-2 px-4 rounded-lg">
                Pesan
            </button>
    </div>
    </div>
    <!-- KERANJANG -->

    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.store('cart', {
                items: [],
                get cartCount() {
                    return this.items.reduce((count, item) => count + item.quantity, 0);
                },
                get totalPrice() {
                    return this.items.reduce((total, item) => total + item.quantity * item.price, 0);
                },
                getItemQuantity(id) {
                    const items = this.items.filter(item => item.product_id == id);
                    return items.reduce((total, item) => total + item.quantity, 0);
                },
                getCart() {
                    fetch('{{ route('product.cart') }}')
                        .then(response => response.json())
                        .then(data => {
                            this.items = Object.values(data).map(item => ({
                                product_id: item.product_id,
                                name: item.name,
                                price: Number(item.price) || 0,
                                point: Number(item.point) || 0,
                                quantity: Number(item.quantity) || 0,
                                total_price: Number(item.total_price) || 0,
                            }));
                            console.log(this.items);
                        })
                        .catch(error => {
                            console.error('Error:', error);
                        });
                },
                removeFromCart(id) {
                    this.items = this.items.map(item => {
                        if (item.product_id === id) {
                            item.quantity -= 1;
                            item.total_price = item.price * item.quantity;
                        }
                        return item;
                    });
                    fetch('{{ route('product.remove.from.cart') }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            },
                            body: JSON.stringify({
                                product_id: id
                            }),
                        }).then(response => response.json())
                        .then(data => {
                            console.log(data);
                        })
                        .catch(error => {
                            console.error('Error:', error);
                        });
                },
                addToCart(id, name, price, point) {
                    const existingItem = this.items.find(item => item.product_id === id);
                    if (existingItem) {
                        existingItem.quantity++;
                    } else {
                        this.items.push({
                            product_id: id,
                            name,
                            price,
                            point,
                            quantity: 1,
                            total_price: price * this.quantity,
                        });
                    }
                    fetch('{{ route('product.add.to.cart') }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            },
                            body: JSON.stringify({
                                product_id: id,
                                name,
                                price,
                                quantity: 1,
                                total_price: price * 1
                            }),
                        }).then(response => response.json())
                        .then(data => {
                            console.log(data);
                        })
                        .catch(error => {
                            console.error('Error:', error);
                        });
                },
                submitOrder() {
                    if (this.items.length === 0) {
                        alert('Keranjang kosong');
                        return;
                    }

                    window.location.href = '{{ route('cart') }}';
                },
                formatPrice(value) {
                    return new Intl.NumberFormat('id-ID', {
                        style: 'currency',
                        currency: 'IDR',
                        minimumFractionDigits: 0,
                    }).format(value);
                },
            });
            Alpine.store('cart').getCart();
        });
    </script>
</body>

</html>
