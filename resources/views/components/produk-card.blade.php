<div class="w-[380px] bg-zinc-700 p-4 flex h-44 rounded-3xl shadow gap-4">
    <div class="flex flex-col justify-between">
        <div class="flex flex-col gap-2">
            <h5 class="text-lg font-semibold tracking-tight text-white">
                {{ $product->name }}
            </h5>
            <p class="text-sm font-normal tracking-tight text-zinc-300">
                Rp. {{ number_format($product->price, 0, ',', '.') }}
            </p>
        </div>
        <!-- add -->
        <div class="gap-4 text-center justify-between items-center flex">
            <div @click="$store.cart.removeFromCart({{ $product->id }})"
                class="bg-zinc-600 cursor-pointer border border-zinc-500 w-8 h-8 text-center justify-center items-center flex rounded-xl font-semibold text-zinc-200">
                -
            </div>
            <h1 class="text-white font-bold text-xl" x-text="$store.cart.getItemQuantity({{ $product->id }})"></h1>
            <div @click="$store.cart.addToCart({{ $product->id }}, '{{ $product->name }}', {{ $product->price }}, {{ $product->point }})"
                class="bg-zinc-600 border border-zinc-500 cursor-pointer w-8 h-8 text-center justify-center items-center flex rounded-xl font-semibold text-zinc-200">
                +
            </div>
        </div>
    </div>
    <img class="rounded-2xl w-36 h-36 mx-auto" src="{{ asset('storage/' . $product->image) }}" alt="" />
</div>
