<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>My Orders - CoffeeBlend</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#faf9f7] text-stone-900">

    {{-- NAVBAR --}}
    <nav class="bg-white border-b border-stone-200">

        <div class="max-w-6xl mx-auto px-6 py-5
                    flex items-center justify-between">

            <a href="{{ url('/') }}"
               class="flex items-center gap-3">

                <div class="w-11 h-11 rounded-xl bg-amber-700
                            flex items-center justify-center text-xl">
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

            <a href="{{ url('/') }}"
               class="font-semibold text-stone-600
                      hover:text-amber-700">

                Home

            </a>

        </div>

    </nav>


    {{-- CONTENT --}}
    <main class="max-w-6xl mx-auto px-6 py-12">

        <div class="mb-10">

            <p class="text-amber-700 font-semibold tracking-widest text-sm">
                COFFEEBLEND
            </p>

            <h1 class="text-4xl font-bold mt-2">
                My Orders
            </h1>

            <p class="text-stone-500 mt-3">
                Lihat semua pesanan yang pernah kamu buat.
            </p>

        </div>


        @if($orders->count() > 0)

            <div class="space-y-5">

                @foreach($orders as $order)

                    <div class="bg-white border border-stone-200
                                rounded-2xl p-6 shadow-sm">

                        <div class="flex flex-col md:flex-row
                                    md:items-center
                                    md:justify-between gap-5">

                            <div>

                                <p class="text-sm text-stone-500">
                                    Order Number
                                </p>

                                <h2 class="font-bold text-lg mt-1">
                                    {{ $order->order_number }}
                                </h2>

                                <p class="text-sm text-stone-500 mt-2">
                                    {{ $order->created_at->format('d M Y, H:i') }}
                                </p>

                            </div>


                            <div>

                                <span class="inline-block
                                             px-4 py-2
                                             rounded-full
                                             bg-amber-100
                                             text-amber-700
                                             text-sm font-semibold">

                                    {{ ucfirst($order->status) }}

                                </span>

                            </div>


                            <div class="text-left md:text-right">

                                <p class="text-sm text-stone-500">
                                    Total
                                </p>

                                <p class="text-xl font-bold text-amber-700">
                                    Rp {{ number_format(
                                        $order->total_amount,
                                        0,
                                        ',',
                                        '.'
                                    ) }}
                                </p>

                            </div>


                            <div>

                                <a
                                    href="{{ route('orders.show', $order) }}"
                                    class="..."
                                >
                                    View Details
                                </a>

                            </div>

                        </div>

                    </div>

                @endforeach

            </div>

        @else

            <div class="bg-white border border-stone-200
                        rounded-2xl p-12 text-center">

                <div class="text-6xl mb-5">
                    ☕
                </div>

                <h2 class="text-2xl font-bold">
                    No Orders Yet
                </h2>

                <p class="text-stone-500 mt-2">
                    Kamu belum memiliki pesanan.
                </p>

                <a
                    href="{{ url('/') }}"
                    class="inline-block mt-6
                           bg-amber-700
                           text-white
                           px-6 py-3
                           rounded-xl
                           font-semibold"
                >
                    Explore Menu
                </a>

            </div>

        @endif

    </main>

</body>
</html>