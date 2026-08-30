<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Cart - CoffeeBlend</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-stone-50 text-stone-900">


{{-- NAVBAR --}}

<nav class="bg-white border-b border-stone-200">

    <div class="max-w-7xl mx-auto px-6">

        <div class="h-20 flex items-center justify-between">

            <a
                href="{{ route('home') }}"
                class="flex items-center gap-3"
            >

                <div
                    class="w-11 h-11 rounded-xl bg-amber-700 text-white flex items-center justify-center text-xl"
                >
                    ☕
                </div>

                <div>

                    <h1 class="font-bold text-xl">
                        CoffeeBlend
                    </h1>

                    <p class="text-xs text-stone-500">
                        Good Coffee, Better Moments
                    </p>

                </div>

            </a>


            <div class="flex items-center gap-6">

                <a
                    href="{{ route('home') }}"
                    class="text-stone-600 hover:text-amber-700"
                >
                    Home
                </a>

                <a
                    href="{{ route('menu') }}"
                    class="text-stone-600 hover:text-amber-700"
                >
                    Menu
                </a>

                <a
                    href="{{ route('cart.index') }}"
                    class="font-semibold text-amber-700"
                >
                    🛒 Cart
                </a>

            </div>

        </div>

    </div>

</nav>


{{-- CONTENT --}}

<main class="max-w-6xl mx-auto px-6 py-12">

    <div class="mb-8">

        <p class="text-amber-700 font-semibold">
            YOUR ORDER
        </p>

        <h1 class="text-4xl font-bold mt-2">
            Shopping Cart
        </h1>

    </div>


    {{-- SUCCESS --}}

    @if(session('success'))

        <div class="mb-6 bg-green-100 border border-green-200 text-green-800 px-5 py-4 rounded-xl">
            {{ session('success') }}
        </div>

    @endif


    {{-- ERROR --}}

    @if(session('error'))

        <div class="mb-6 bg-red-100 border border-red-200 text-red-800 px-5 py-4 rounded-xl">
            {{ session('error') }}
        </div>

    @endif


    @if(count($cart) > 0)

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">


            {{-- CART ITEMS --}}

            <div class="lg:col-span-2 space-y-4">

                @foreach($cart as $item)

                    <div
                        class="bg-white border border-stone-200 rounded-2xl p-5"
                    >

                        <div class="flex gap-5">


                            {{-- IMAGE --}}

                            @if($item['image'])

                                <img
                                    src="{{ asset('storage/' . $item['image']) }}"
                                    alt="{{ $item['name'] }}"
                                    class="w-28 h-28 object-cover rounded-xl"
                                >

                            @else

                                <div
                                    class="w-28 h-28 bg-amber-100 rounded-xl flex items-center justify-center text-4xl"
                                >
                                    ☕
                                </div>

                            @endif


                            {{-- PRODUCT INFO --}}

                            <div class="flex-1">

                                <div class="flex justify-between gap-4">

                                    <div>

                                        <h2 class="font-bold text-xl">
                                            {{ $item['name'] }}
                                        </h2>

                                        <p class="text-amber-700 font-semibold mt-1">
                                            Rp {{ number_format($item['price'], 0, ',', '.') }}
                                        </p>

                                    </div>


                                    {{-- REMOVE --}}

                                    <form
                                        action="{{ route('cart.remove', $item['id']) }}"
                                        method="POST"
                                    >

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="text-red-600 hover:text-red-800 text-sm"
                                        >
                                            Remove
                                        </button>

                                    </form>

                                </div>


                                {{-- QUANTITY --}}

                                <div class="flex items-center justify-between mt-6">

                            <form
                                action="{{ route('cart.update', $item['id']) }}"
                                method="POST"
                                class="flex items-center gap-3"
                            >
                                @csrf
                                @method('PATCH')

                                <label class="text-sm text-stone-500">
                                    Quantity
                                </label>

                                <div class="flex items-center border border-stone-300 rounded-xl overflow-hidden">

                                    {{-- MINUS --}}

                                    <button
                                        type="button"
                                        onclick="changeQuantity(this, -1)"
                                        class="w-10 h-10 hover:bg-stone-100 text-lg"
                                    >
                                        −
                                    </button>


                                    {{-- QUANTITY --}}

                                    <input
                                        type="number"
                                        name="quantity"
                                        value="{{ $item['quantity'] }}"
                                        min="1"
                                        max="{{ $item['stock'] }}"
                                        class="w-14 h-10 border-x border-stone-300 text-center focus:outline-none"
                                    >


                                    {{-- PLUS --}}

                                    <button
                                        type="button"
                                        onclick="changeQuantity(this, 1)"
                                        class="w-10 h-10 hover:bg-stone-100 text-lg"
                                    >
                                        +
                                    </button>

                                </div>


                                <button
                                    type="submit"
                                    class="px-4 py-2 bg-stone-900 text-white rounded-lg text-sm hover:bg-stone-800"
                                >
                                    Update
                                </button>

                            </form>


                                    {{-- SUBTOTAL --}}

                                    <div class="text-right">

                                        <p class="text-xs text-stone-500">
                                            Subtotal
                                        </p>

                                        <p class="font-bold text-lg">
                                            Rp
                                            {{ number_format(
                                                $item['price'] * $item['quantity'],
                                                0,
                                                ',',
                                                '.'
                                            ) }}
                                        </p>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                @endforeach


                {{-- CLEAR CART --}}

                <form
                    action="{{ route('cart.clear') }}"
                    method="POST"
                    class="pt-2"
                >

                    @csrf
                    @method('DELETE')

                    <button
                        type="submit"
                        onclick="return confirm('Kosongkan seluruh cart?')"
                        class="text-red-600 text-sm hover:text-red-800"
                    >
                        Clear Cart
                    </button>

                </form>

            </div>


            {{-- SUMMARY --}}

            <div>

                <div
                    class="bg-white border border-stone-200 rounded-2xl p-6 sticky top-6"
                >

                    <h2 class="text-xl font-bold">
                        Order Summary
                    </h2>


                    <div class="flex justify-between mt-6 text-stone-600">

                        <span>
                            Items
                        </span>

                        <span>
                            {{ count($cart) }}
                        </span>

                    </div>


                    <div class="border-t border-stone-200 mt-5 pt-5">

                        <div class="flex justify-between items-center">

                            <span class="font-semibold">
                                Total
                            </span>

                            <span class="text-2xl font-bold text-amber-700">
                                Rp {{ number_format($total, 0, ',', '.') }}
                            </span>

                        </div>

                    </div>


                    <a
                        href="{{ route('checkout.index') }}"
                        class="block w-full mt-6 bg-amber-700 hover:bg-amber-800 text-white py-4 rounded-xl font-bold text-center"
                    >
                        Proceed to Checkout
                    </a>


                    <a
                        href="{{ route('menu') }}"
                        class="block text-center mt-4 text-stone-600 hover:text-amber-700"
                    >
                        ← Continue Shopping
                    </a>

                </div>

            </div>

        </div>


    @else

        {{-- EMPTY CART --}}

        <div class="bg-white border border-stone-200 rounded-2xl text-center py-20">

            <div class="text-7xl">
                🛒
            </div>

            <h2 class="text-2xl font-bold mt-6">
                Your cart is empty
            </h2>

            <p class="text-stone-500 mt-2">
                Belum ada produk yang kamu pilih.
            </p>

            <a
                href="{{ route('menu') }}"
                class="inline-block mt-8 bg-amber-700 hover:bg-amber-800 text-white px-6 py-3 rounded-xl font-semibold"
            >
                Browse Menu
            </a>

        </div>

    @endif

</main>


<footer class="bg-stone-950 text-stone-400 mt-20">

    <div class="max-w-7xl mx-auto px-6 py-10">

        <p class="text-white font-bold">
            ☕ CoffeeBlend
        </p>

        <p class="text-sm mt-1">
            Good coffee, better moments.
        </p>

    </div>

</footer>

<script>

function changeQuantity(button, amount)
{
    const form = button.closest('form');

    const input = form.querySelector('input[name="quantity"]');

    let quantity = parseInt(input.value) || 1;

    const min = parseInt(input.min) || 1;

    const max = parseInt(input.max) || 999;

    quantity += amount;

    if (quantity < min) {
        quantity = min;
    }

    if (quantity > max) {
        quantity = max;
    }

    input.value = quantity;
}

</script>


</body>
</html>