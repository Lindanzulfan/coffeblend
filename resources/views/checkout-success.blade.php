<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Order Successful - CoffeeBlend</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#faf9f7] text-stone-900">

    {{-- NAVBAR --}}
    <nav class="bg-white border-b border-stone-200">
        <div class="max-w-6xl mx-auto px-6 py-5 flex items-center justify-between">

            <a href="{{ url('/') }}" class="flex items-center gap-3">

                <div class="w-11 h-11 rounded-xl bg-amber-700
                            flex items-center justify-center text-xl">
                    ☕
                </div>

                <div>
                    <h1 class="font-bold text-xl leading-none">
                        CoffeeBlend
                    </h1>

                    <p class="text-xs text-stone-500 mt-1">
                        Good Coffee, Better Moments
                    </p>
                </div>

            </a>

            <a
                href="{{ url('/') }}"
                class="text-sm font-semibold text-stone-600 hover:text-amber-700"
            >
                Home
            </a>

        </div>
    </nav>


    {{-- MAIN --}}
    <main class="min-h-[calc(100vh-90px)] flex items-center justify-center px-6 py-12">

        <div class="max-w-2xl w-full">

            {{-- SUCCESS ICON --}}
            <div class="flex justify-center mb-7">

                <div class="w-24 h-24 rounded-full bg-green-100
                            flex items-center justify-center">

                    <div class="w-16 h-16 rounded-full bg-green-500
                                flex items-center justify-center">

                        <span class="text-white text-4xl font-bold">
                            ✓
                        </span>

                    </div>

                </div>

            </div>


            {{-- TITLE --}}
            <div class="text-center">

                <p class="text-amber-700 font-bold tracking-[0.2em] text-sm">
                    ORDER CONFIRMED
                </p>

                <h2 class="text-4xl md:text-5xl font-bold mt-3">
                    Thank You!
                </h2>

                <p class="text-stone-500 mt-4 text-lg">
                    Pesanan kamu berhasil dibuat.
                    Kami akan segera menyiapkannya.
                </p>

            </div>


            {{-- ORDER CARD --}}
            <div class="bg-white rounded-3xl shadow-sm border border-stone-200
                        mt-10 overflow-hidden">

                {{-- ORDER HEADER --}}
                <div class="bg-stone-900 text-white px-7 py-6">

                    <div class="flex items-center justify-between">

                        <div>
                            <p class="text-stone-400 text-sm">
                                Order Number
                            </p>

                            <p class="text-xl font-bold mt-1">
                                {{ $order->order_number }}
                            </p>
                        </div>

                        <div class="text-right">

                            <p class="text-stone-400 text-sm">
                                Status
                            </p>

                            <span class="inline-block mt-1
                                         bg-amber-600 text-white
                                         px-4 py-1.5 rounded-full
                                         text-sm font-semibold">

                                {{ ucfirst($order->status) }}

                            </span>

                        </div>

                    </div>

                </div>


                {{-- CUSTOMER --}}
                <div class="px-7 py-6">

                    <h3 class="font-bold text-lg mb-5">
                        Customer Information
                    </h3>

                    <div class="grid md:grid-cols-2 gap-5">

                        <div>
                            <p class="text-sm text-stone-500">
                                Full Name
                            </p>

                            <p class="font-semibold mt-1">
                                {{ $order->customer_name }}
                            </p>
                        </div>

                        <div>
                            <p class="text-sm text-stone-500">
                                Email
                            </p>

                            <p class="font-semibold mt-1 break-all">
                                {{ $order->customer_email }}
                            </p>
                        </div>

                        <div>
                            <p class="text-sm text-stone-500">
                                Phone Number
                            </p>

                            <p class="font-semibold mt-1">
                                {{ $order->customer_phone }}
                            </p>
                        </div>

                        <div>
                            <p class="text-sm text-stone-500">
                                Order Date
                            </p>

                            <p class="font-semibold mt-1">
                                {{ $order->created_at->format('d M Y, H:i') }}
                            </p>
                        </div>

                    </div>

                </div>


                {{-- DELIVERY --}}
                <div class="border-t border-stone-200 px-7 py-6">

                    <h3 class="font-bold text-lg mb-3">
                        Delivery Address
                    </h3>

                    <p class="text-stone-600 leading-relaxed">
                        {{ $order->delivery_address }}
                    </p>

                </div>


                {{-- TOTAL --}}
                <div class="border-t border-stone-200 bg-stone-50
                            px-7 py-6">

                    <div class="flex items-center justify-between">

                        <div>
                            <p class="text-sm text-stone-500">
                                Total Payment
                            </p>

                            <p class="text-3xl font-bold text-amber-700 mt-1">
                                Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                            </p>
                        </div>

                        <div class="text-5xl">
                            ☕
                        </div>

                    </div>

                </div>

            </div>


            {{-- BUTTONS --}}
            <div class="grid md:grid-cols-2 gap-4 mt-7">

                <a
                    href="{{ url('/') }}"
                    class="flex items-center justify-center
                           bg-amber-700 hover:bg-amber-800
                           text-white py-4 rounded-xl
                           font-bold transition"
                >
                    ← Back to Home
                </a>

                <a
                    href="{{ url('/orders') }}"
                    class="flex items-center justify-center
                           bg-white border border-stone-300
                           hover:bg-stone-100
                           text-stone-800 py-4 rounded-xl
                           font-bold transition"
                >
                    View My Orders →
                </a>

            </div>


            {{-- FOOTER MESSAGE --}}
            <p class="text-center text-sm text-stone-400 mt-8">
                Thank you for choosing CoffeeBlend ☕
            </p>

        </div>

    </main>

</body>
</html>