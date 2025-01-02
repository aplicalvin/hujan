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

<body class="bg-zinc-800" x-data="productCart()">
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
                    x-on:add-to-cart="$store.productCart.addToCart($event.detail.product_id, $event.detail.name, $event.detail.price, $event.detail.point)"
                    x-on:remove-from-cart="$store.productCart.removeFromCart($event.detail.product_id)" />
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
    <!-- KERANJANG -->

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
                    fetch('{{ route('product.cart') }}')
                        .then(response => response.json())
                        .then(data => {
                            this.items = data;
                            console.log(Object.values(data));
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

            Alpine.store('productCart', {
                items: [],
                getItemQuantity(id) {
                    const products = this.items.filter(item => item.id == id && item.type == 'product');
                    return products.reduce((total, product) => total + product.quantity, 0);
                },
                getCart() {
                    fetch('{{ route('product.cart') }}')
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
                    fetch('{{ route('product.remove.from.cart') }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            },
                            body: JSON.stringify({
                                id: id,
                                type: 'product',
                            }),
                        }).then(response => response.json())
                        .then(data => {
                            console.log(data);
                            Alpine.store('combinedCart').getCart();
                            Alpine.store('productCart').getCart();
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
                    } else {
                        this.items.push({
                            id: id,
                            type: 'product',
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
                                id: id,
                                type: 'product',
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
                            Alpine.store('productCart').getCart();
                        })
                        .catch(error => {
                            console.error('Error:', error);
                        });
                },
            });
        });

        document.addEventListener('DOMContentLoaded', () => {
            Alpine.store('combinedCart').getCart();
            Alpine.store('productCart').getCart();
        });
    </script>
</body>

</html>
