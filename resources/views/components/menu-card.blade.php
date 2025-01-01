<div
    class="w-[360px] h-40 p-4 bg-zinc-700 hover:shadow-lg hover:shadow-zinc-700 border border-zinc-600 rounded-lg shadow flex gap-4">
    <img class="rounded-2xl w-32 h-32" src="{{ asset('storage/' . $menu->image) }}" />
    <div class="flex flex-col gap-2 w-full">
        <h5 class="text-md font-bold text-left tracking-tight text-white">
            {{ $menu->name }}
        </h5>
        <p class="text-md font-bold text-zinc-300">Rp. {{ number_format($menu->price) }}</p>

        <div class="gap-4 text-center justify-between items-center flex">
            <div
                @click="$store.cart.removeFromCart({{ $menu->id }})"
                class="bg-zinc-600 border border-zinc-500 w-8 h-8 text-center justify-center items-center flex rounded-xl font-semibold text-zinc-200 cursor-pointer">
                -
            </div>
            <h1 class="text-white font-bold text-xl" x-text="$store.cart.getItemQuantity({{ $menu->id }})"></h1>
            <div @click="$store.cart.addToCart({{ $menu->id }}, '{{ $menu->name }}', {{ $menu->price }}, {{ $menu->point }})"
                class="bg-zinc-600 border border-zinc-500 w-8 h-8 text-center justify-center items-center flex rounded-xl font-semibold text-zinc-200 cursor-pointer">
                +
            </div>
        </div>
    </div>
</div>
