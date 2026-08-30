<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Checkout - CoffeeBlend</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-stone-50 text-stone-900">

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

            <a
                href="{{ route('cart.index') }}"
                class="text-stone-600 hover:text-amber-700"
            >
                ← Back to Cart
            </a>

        </div>

    </div>

</nav>


<main class="max-w-6xl mx-auto px-6 py-12">

    <div class="mb-8">

        <p class="text-amber-700 font-semibold">
            CHECKOUT
        </p>

        <h1 class="text-4xl font-bold mt-2">
            Complete Your Order
        </h1>

    </div>


    @if(session('error'))

        <div class="mb-6 bg-red-100 border border-red-200 text-red-800 px-5 py-4 rounded-xl">
            {{ session('error') }}
        </div>

    @endif


    @if($errors->any())

        <div class="mb-6 bg-red-100 border border-red-200 text-red-800 px-5 py-4 rounded-xl">

            <ul class="list-disc pl-5">

                @foreach($errors->all() as $error)

                    <li>
                        {{ $error }}
                    </li>

                @endforeach

            </ul>

        </div>

    @endif


   <form
    action="{{ route('checkout.store') }}"
    method="POST"
>
    @csrf

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">


            {{-- CUSTOMER INFORMATION --}}

            <div class="lg:col-span-2">

                <div class="bg-white border border-stone-200 rounded-2xl p-7">

                    <h2 class="text-2xl font-bold">
                        Customer Information
                    </h2>


                    {{-- NAME --}}

                    <div class="mt-6">

                        <label class="block font-semibold mb-2">
                            Full Name
                        </label>

                        <input
                            type="text"
                            name="customer_name"
                            value="{{ old('customer_name', auth()->user()->name ?? '') }}"
                            required
                            class="w-full border border-stone-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-amber-600"
                            placeholder="Your name"
                        >

                    </div>


                    {{-- EMAIL --}}

                    <div class="mt-5">

                        <label class="block font-semibold mb-2">
                            Email
                        </label>

                        <input
                            type="email"
                            name="customer_email"
                            value="{{ old('customer_email', auth()->user()->email ?? '') }}"
                            required
                            class="w-full border border-stone-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-amber-600"
                            placeholder="you@example.com"
                        >

                    </div>


                    {{-- PHONE --}}

                    <div class="mt-5">

                        <label class="block font-semibold mb-2">
                            Phone Number
                        </label>

                        <input
                            type="text"
                            name="customer_phone"
                            value="{{ old('customer_phone') }}"
                            required
                            class="w-full border border-stone-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-amber-600"
                            placeholder="08xxxxxxxxxx"
                        >

                    </div>


                    {{-- ADDRESS --}}

                    <div class="mt-5">

                        <label class="block font-semibold mb-2">
                            Delivery Address
                        </label>

                        <textarea
                            name="delivery_address"
                            rows="5"
                            required
                            class="w-full border border-stone-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-amber-600"
                            placeholder="Enter your delivery address"
                        >{{ old('delivery_address') }}</textarea>

                    </div>

                </div>

            </div>


            {{-- ORDER SUMMARY --}}

            <div>

                <div class="bg-white border border-stone-200 rounded-2xl p-6 sticky top-6">

                    <h2 class="text-xl font-bold">
                        Order Summary
                    </h2>


                    <div class="mt-6 space-y-4">

                        @foreach($cart as $item)

                            <div class="flex justify-between gap-4">

                                <div>

                                    <p class="font-semibold">
                                        {{ $item['name'] }}
                                    </p>

                                    <p class="text-sm text-stone-500">
                                        {{ $item['quantity'] }} ×
                                        Rp {{ number_format($item['price'], 0, ',', '.') }}
                                    </p>

                                </div>

                                <p class="font-semibold">

                                    Rp
                                    {{ number_format(
                                        $item['price'] * $item['quantity'],
                                        0,
                                        ',',
                                        '.'
                                    ) }}

                                </p>

                            </div>

                        @endforeach

                    </div>


                    <div class="border-t border-stone-200 mt-6 pt-6">

                        <div class="flex justify-between">

                            <span class="font-semibold">
                                Total
                            </span>

                            <span class="text-xl font-bold text-amber-700">

                                Rp {{ number_format($total, 0, ',', '.') }}

                            </span>

                        </div>

                    </div>

                    
                    <button
                        type="submit"
                        class="w-full mt-6 bg-amber-700 hover:bg-amber-800 text-white py-4 rounded-xl font-bold"
                    >
                        Place Order
                    </button>

                </div>

            </div>

        </div>

    </form>

</main>

</body>
</html>