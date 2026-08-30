<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>CoffeeBlend - Good Coffee, Better Moments</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>


<body class="bg-stone-50 text-stone-900">

    {{-- NAVBAR --}}

    <nav class="bg-white border-b border-stone-200">

        <div class="max-w-7xl mx-auto px-6">

            <div class="h-20 flex items-center justify-between">

                {{-- LOGO --}}

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


                {{-- NAVIGATION --}}

                <div class="hidden md:flex items-center gap-8">

                    <a
                        href="{{ route('home') }}"
                        class="font-medium text-amber-700"
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
                        href="#about"
                        class="text-stone-600 hover:text-amber-700"
                    >
                        About
                    </a>

                    <a
                        href="#contact"
                        class="text-stone-600 hover:text-amber-700"
                    >
                        Contact
                    </a>

                </div>


                {{-- AUTH --}}

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
                            class="text-stone-600 hover:text-amber-700"
                        >
                            Login
                        </a>

                        <a
                            href="{{ route('register') }}"
                            class="px-4 py-2 rounded-lg bg-amber-700 text-white hover:bg-amber-800"
                        >
                            Register
                        </a>

                    @endauth

                </div>

            </div>

        </div>

    </nav>


    {{-- HERO --}}

    <section class="bg-stone-950 text-white">

        <div
            class="max-w-7xl mx-auto px-6 py-24 md:py-32"
        >

            <div class="max-w-3xl">

                <p
                    class="text-amber-400 uppercase tracking-[0.3em] text-sm font-semibold mb-6"
                >
                    Welcome to CoffeeBlend
                </p>

                <h2
                    class="text-5xl md:text-7xl font-bold leading-tight"
                >
                    Good coffee,
                    <span class="text-amber-500">
                        better moments.
                    </span>
                </h2>

                <p
                    class="text-stone-300 text-lg md:text-xl mt-6 max-w-2xl leading-relaxed"
                >
                    Nikmati kopi berkualitas dan makanan pilihan
                    yang dibuat untuk menemani setiap momenmu.
                </p>

                <div class="flex flex-wrap gap-4 mt-10">

                    <a
                         href="{{ route('menu') }}"
                            class="px-7 py-4 bg-amber-700 hover:bg-amber-800 rounded-xl font-semibold"
                        >
                        Explore Menu
                    </a>    

                    <a
                        href="#about"
                        class="px-7 py-4 border border-stone-600 hover:bg-stone-800 rounded-xl font-semibold"
                    >
                        About CoffeeBlend
                    </a>

                </div>

            </div>

        </div>

    </section>


    {{-- CATEGORIES --}}

    <section class="py-20">

        <div class="max-w-7xl mx-auto px-6">

            <div class="text-center mb-12">

                <p class="text-amber-700 font-semibold">
                    EXPLORE
                </p>

                <h2 class="text-3xl md:text-4xl font-bold mt-2">
                    What are you craving?
                </h2>

                <p class="text-stone-500 mt-3">
                    Pilih kategori favoritmu.
                </p>

            </div>


            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-5">

                @foreach($categories as $category)

                    <a
                        href="#menu"
                        class="group bg-white border border-stone-200 rounded-2xl p-6 hover:border-amber-600 hover:shadow-lg transition"
                    >

                        <div
                            class="w-14 h-14 bg-amber-100 rounded-2xl flex items-center justify-center text-2xl group-hover:bg-amber-700 group-hover:text-white transition"
                        >
                            ☕
                        </div>

                        <h3 class="font-bold text-lg mt-5">
                            {{ $category->name }}
                        </h3>

                        <p class="text-sm text-stone-500 mt-1">
                            {{ $category->products_count }} products
                        </p>

                    </a>

                @endforeach

            </div>

        </div>

    </section>


    {{-- FEATURED PRODUCTS --}}

    <section
        id="menu"
        class="bg-stone-100 py-20"
    >

        <div class="max-w-7xl mx-auto px-6">

            <div class="flex items-end justify-between mb-10">

                <div>

                    <p class="text-amber-700 font-semibold">
                        OUR MENU
                    </p>

                    <h2 class="text-3xl md:text-4xl font-bold mt-2">
                        Popular Picks
                    </h2>

                </div>

                <span class="hidden md:block text-stone-500">
                    Freshly prepared for you.
                </span>

            </div>


            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

                @foreach($featuredProducts as $product)

                    <div
                        class="bg-white rounded-2xl overflow-hidden border border-stone-200 hover:shadow-xl transition"
                    >

                        {{-- IMAGE --}}

                        @if($product->image)

                            <img
                                src="{{ asset('storage/' . $product->image) }}"
                                alt="{{ $product->name }}"
                                class="w-full h-56 object-cover"
                            >

                        @else

                            <div
                                class="w-full h-56 bg-amber-100 flex items-center justify-center text-6xl"
                            >
                                ☕
                            </div>

                        @endif


                        {{-- CONTENT --}}

                        <div class="p-6">

                            <div class="flex items-center justify-between">

                                <span
                                    class="text-xs bg-stone-100 px-3 py-1 rounded-full text-stone-600"
                                >
                                    {{ $product->category->name }}
                                </span>

                                <span class="text-sm text-stone-500">
                                    {{ $product->stock }} available
                                </span>

                            </div>


                            <h3 class="text-xl font-bold mt-4">
                                {{ $product->name }}
                            </h3>


                            <p class="text-stone-500 text-sm mt-2 line-clamp-2">
                                {{ $product->description }}
                            </p>


                            <div class="flex items-center justify-between mt-6">

                                <p class="text-xl font-bold text-amber-700">
                                    Rp {{ number_format($product->price, 0, ',', '.') }}
                                </p>

                                <button
                                    class="w-10 h-10 rounded-xl bg-stone-900 text-white hover:bg-amber-700 transition"
                                >
                                    +
                                </button>

                            </div>

                        </div>

                    </div>

                @endforeach

            </div>

        </div>

    </section>


    {{-- ABOUT --}}

    <section
        id="about"
        class="py-20"
    >

        <div class="max-w-7xl mx-auto px-6">

            <div class="max-w-3xl">

                <p class="text-amber-700 font-semibold">
                    ABOUT COFFEEBLEND
                </p>

                <h2 class="text-3xl md:text-4xl font-bold mt-2">
                    More than just a cup of coffee.
                </h2>

                <p class="text-stone-600 text-lg leading-relaxed mt-6">
                    CoffeeBlend hadir sebagai tempat untuk menikmati
                    kopi berkualitas, makanan lezat, dan suasana yang
                    nyaman. Setiap produk dibuat dengan perhatian
                    terhadap rasa dan kualitas.
                </p>

            </div>

        </div>

    </section>


    {{-- CTA --}}

    <section class="bg-amber-700 text-white">

        <div class="max-w-7xl mx-auto px-6 py-20 text-center">

            <h2 class="text-4xl font-bold">
                Ready for your next coffee?
            </h2>

            <p class="mt-4 text-amber-100">
                Temukan minuman favoritmu di CoffeeBlend.
            </p>

            <a
                href="#menu"
                class="inline-block mt-8 px-7 py-4 bg-white text-amber-800 rounded-xl font-bold hover:bg-stone-100"
            >
                Explore Our Menu
            </a>

        </div>

    </section>


    {{-- FOOTER --}}

    <footer
        id="contact"
        class="bg-stone-950 text-stone-400"
    >

        <div class="max-w-7xl mx-auto px-6 py-12">

            <div class="flex flex-col md:flex-row justify-between gap-8">

                <div>

                    <h3 class="text-white font-bold text-xl">
                        ☕ CoffeeBlend
                    </h3>

                    <p class="mt-2 max-w-sm">
                        Good coffee, better moments.
                    </p>

                </div>

                <div>

                    <p class="text-white font-semibold">
                        Contact
                    </p>

                    <p class="mt-2">
                        hello@coffeeblend.test
                    </p>

                    <p>
                        +62 812 3456 7890
                    </p>

                </div>

            </div>


            <div class="border-t border-stone-800 mt-10 pt-6 text-sm">

                © {{ date('Y') }} CoffeeBlend. All rights reserved.

            </div>

        </div>

    </footer>

</body>

</html>