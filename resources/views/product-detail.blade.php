<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>{{ $product->name }} - CoffeeBlend</title>

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


            <div class="hidden md:flex items-center gap-8">

                <a
                    href="{{ route('home') }}"
                    class="text-stone-600 hover:text-amber-700"
                >
                    Home
                </a>

                <a
                    href="{{ route('menu') }}"
                    class="font-semibold text-amber-700"
                >
                    Menu
                </a>

                <a
                    href="{{ route('home') }}#about"
                    class="text-stone-600 hover:text-amber-700"
                >
                    About
                </a>

                <a
                    href="{{ route('home') }}#contact"
                    class="text-stone-600 hover:text-amber-700"
                >
                    Contact
                </a>

            </div>


            <div class="flex items-center gap-3">

                @auth

                    <a
                        href="{{ route('dashboard') }}"
                        class="px-4 py-2 rounded-lg bg-stone-900 text-white"
                    >
                        Dashboard
                    </a>

                @else

                    <a
                        href="{{ route('login') }}"
                        class="text-stone-600"
                    >
                        Login
                    </a>

                    <a
                        href="{{ route('register') }}"
                        class="px-4 py-2 rounded-lg bg-amber-700 text-white"
                    >
                        Register
                    </a>

                @endauth

            </div>

        </div>

    </div>

</nav>


{{-- BREADCRUMB --}}

<div class="max-w-7xl mx-auto px-6 pt-8">

    <div class="text-sm text-stone-500">

        <a
            href="{{ route('home') }}"
            class="hover:text-amber-700"
        >
            Home
        </a>

        <span class="mx-2">
            /
        </span>

        <a
            href="{{ route('menu') }}"
            class="hover:text-amber-700"
        >
            Menu
        </a>

        <span class="mx-2">
            /
        </span>

        <span class="text-stone-900">
            {{ $product->name }}
        </span>

    </div>

</div>


{{-- PRODUCT DETAIL --}}

<section class="py-12">

    <div class="max-w-7xl mx-auto px-6">

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">


            {{-- IMAGE --}}

            <div>

                @if($product->image)

                    <img
                        src="{{ asset('storage/' . $product->image) }}"
                        alt="{{ $product->name }}"
                        class="w-full h-[500px] object-cover rounded-3xl"
                    >

                @else

                    <div
                        class="w-full h-[500px] bg-amber-100 rounded-3xl flex items-center justify-center text-8xl"
                    >
                        ☕
                    </div>

                @endif

            </div>


            {{-- INFORMATION --}}

            <div class="flex flex-col justify-center">

                <span
                    class="inline-block w-fit bg-amber-100 text-amber-800 px-4 py-2 rounded-full text-sm font-semibold"
                >
                    {{ $product->category->name }}
                </span>


                <h1 class="text-4xl md:text-5xl font-bold mt-5">
                    {{ $product->name }}
                </h1>


                <p class="text-3xl font-bold text-amber-700 mt-5">
                    Rp {{ number_format($product->price, 0, ',', '.') }}
                </p>


                <div class="mt-6 text-stone-600 leading-relaxed">

                    @if($product->description)

                        {{ $product->description }}

                    @else

                        Nikmati {{ $product->name }} dengan rasa
                        yang dibuat khusus oleh CoffeeBlend.

                    @endif

                </div>


                {{-- STOCK --}}

                <div class="mt-6">

                    @if($product->stock > 0)

                        <p class="text-green-700 font-semibold">
                            ✓ {{ $product->stock }} available
                        </p>

                    @else

                        <p class="text-red-600 font-semibold">
                            Out of stock
                        </p>

                    @endif

                </div>


                {{-- QUANTITY & ADD TO CART --}}

                <form
                    action="{{ route('cart.add', $product) }}"
                    method="POST"
                >
                    @csrf

                    <div class="mt-8">

                        <label class="font-semibold block mb-3">
                            Quantity
                        </label>

                        <div class="flex items-center gap-3">

                            {{-- MINUS --}}
                            <button
                                type="button"
                                id="minusButton"
                                class="w-11 h-11 border border-stone-300 rounded-xl hover:bg-stone-100"
                            >
                                −
                            </button>

                            {{-- QUANTITY DISPLAY --}}
                            <input
                                type="number"
                                id="quantityDisplay"
                                value="1"
                                min="1"
                                max="{{ $product->stock }}"
                                class="w-20 h-11 border border-stone-300 rounded-xl text-center"
                            >

                            {{-- PLUS --}}
                            <button
                                type="button"
                                id="plusButton"
                                class="w-11 h-11 border border-stone-300 rounded-xl hover:bg-stone-100"
                            >
                                +
                            </button>

                        </div>

                        {{-- NILAI QUANTITY YANG DIKIRIM KE LARAVEL --}}
                        <input
                            type="hidden"
                            name="quantity"
                            id="quantityInput"
                            value="1"
                            data-max="{{ $product->stock }}"
                        >

                    </div>

                    {{-- ADD TO CART --}}
                    <button
                        type="submit"
                        class="mt-8 w-full bg-amber-700 hover:bg-amber-800 text-white py-4 rounded-xl font-bold text-lg disabled:opacity-50 disabled:cursor-not-allowed"
                        {{ $product->stock <= 0 ? 'disabled' : '' }}
                    >
                        Add to Cart
                    </button>

                </form>


                <a
                    href="{{ route('menu') }}"
                    class="mt-3 w-full border border-stone-300 hover:bg-stone-100 py-4 rounded-xl font-semibold text-center"
                >
                    ← Continue Shopping
                </a>

            </div>

        </div>

    </div>

</section>


{{-- FOOTER --}}

<footer class="bg-stone-950 text-stone-400">

    <div class="max-w-7xl mx-auto px-6 py-10">

        <div class="flex justify-between items-center">

            <div>

                <p class="text-white font-bold">
                    ☕ CoffeeBlend
                </p>

                <p class="text-sm mt-1">
                    Good coffee, better moments.
                </p>

            </div>

            <p class="text-sm">
                © {{ date('Y') }} CoffeeBlend
            </p>

        </div>

    </div>

</footer>
<script>
    const quantityInput = document.getElementById('quantityInput');
    const quantityDisplay = document.getElementById('quantityDisplay');
    const minusButton = document.getElementById('minusButton');
    const plusButton = document.getElementById('plusButton');

    if (
        quantityInput &&
        quantityDisplay &&
        minusButton &&
        plusButton
    ) {

        // KURANGI QUANTITY
        minusButton.addEventListener('click', function () {

            let quantity = parseInt(quantityDisplay.value) || 1;

            if (quantity > 1) {
                quantity--;
            }

            quantityDisplay.value = quantity;
            quantityInput.value = quantity;
        });


        // TAMBAH QUANTITY
        plusButton.addEventListener('click', function () {

            let quantity = parseInt(quantityDisplay.value) || 1;
            let maxStock = parseInt(quantityInput.dataset.max);

            if (quantity < maxStock) {
                quantity++;
            }

            quantityDisplay.value = quantity;
            quantityInput.value = quantity;
        });


        // JIKA USER MENGETIK QUANTITY MANUAL
        quantityDisplay.addEventListener('change', function () {

            let quantity = parseInt(quantityDisplay.value) || 1;
            let maxStock = parseInt(quantityInput.dataset.max);

            if (quantity < 1) {
                quantity = 1;
            }

            if (quantity > maxStock) {
                quantity = maxStock;
            }

            quantityDisplay.value = quantity;
            quantityInput.value = quantity;
        });

    }
</script>

</body>
</html>