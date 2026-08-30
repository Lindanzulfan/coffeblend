<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Menu - CoffeeBlend</title>

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
                        class="text-stone-600 hover:text-amber-700"
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


{{-- HEADER --}}

<section class="bg-stone-950 text-white">

    <div class="max-w-7xl mx-auto px-6 py-20">

        <p class="text-amber-400 font-semibold uppercase tracking-widest">
            OUR MENU
        </p>

        <h2 class="text-5xl font-bold mt-3">
            Find your favorite.
        </h2>

        <p class="text-stone-400 text-lg mt-4 max-w-xl">
            Explore our selection of coffee, non-coffee drinks,
            and delicious food.
        </p>

    </div>

</section>


{{-- CATEGORY FILTER --}}

<section class="py-8 bg-white border-b border-stone-200">

    <div class="max-w-7xl mx-auto px-6">

        <div class="flex flex-wrap gap-3">

            {{-- ALL --}}

            <a
                href="{{ route('menu') }}"
                class="px-5 py-2.5 rounded-full
                {{ !request('category')
                    ? 'bg-amber-700 text-white'
                    : 'bg-stone-100 text-stone-700 hover:bg-stone-200'
                }}"
            >
                All
            </a>


            {{-- CATEGORIES --}}

            @foreach($categories as $category)

                <a
                    href="{{ route('menu', ['category' => $category->id]) }}"
                    class="px-5 py-2.5 rounded-full
                    {{ request('category') == $category->id
                        ? 'bg-amber-700 text-white'
                        : 'bg-stone-100 text-stone-700 hover:bg-stone-200'
                    }}"
                >
                    {{ $category->name }}

                    <span class="text-xs opacity-70">
                        ({{ $category->products_count }})
                    </span>

                </a>

            @endforeach

        </div>

    </div>

</section>


{{-- PRODUCTS --}}

<section class="py-16">

    <div class="max-w-7xl mx-auto px-6">


        <div class="flex items-center justify-between mb-8">

            <div>

                <h2 class="text-2xl font-bold">
                    {{ request('category')
                        ? $categories->firstWhere('id', request('category'))->name
                        : 'All Products'
                    }}
                </h2>

                <p class="text-stone-500 mt-1">
                    {{ $products->total() }} products available
                </p>

            </div>

        </div>


        @if($products->count())

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">


                @foreach($products as $product)

                   <a
                        href="{{ route('product.show', $product) }}"
                        class="block bg-white border border-stone-200 rounded-2xl overflow-hidden hover:shadow-xl transition"
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

                        <div class="p-5">


                            <span
                                class="inline-block text-xs bg-stone-100 text-stone-600 px-3 py-1 rounded-full"
                            >
                                {{ $product->category->name }}
                            </span>


                            <h3 class="font-bold text-xl mt-4">
                                {{ $product->name }}
                            </h3>


                            <p class="text-sm text-stone-500 mt-2 line-clamp-2 min-h-[40px]">
                                {{ $product->description }}
                            </p>


                            <div class="flex items-center justify-between mt-5">


                                <div>

                                    <p class="font-bold text-lg text-amber-700">
                                        Rp {{ number_format($product->price, 0, ',', '.') }}
                                    </p>

                                    <p class="text-xs text-stone-500 mt-1">
                                        {{ $product->stock }} available
                                    </p>

                                </div>


                                <button
                                    class="w-10 h-10 bg-stone-900 hover:bg-amber-700 text-white rounded-xl transition"
                                >
                                    +
                                </button>

                            </div>

                        </div>

                    </a>

                @endforeach


            </div>


            {{-- PAGINATION --}}

            <div class="mt-12">

                {{ $products->links() }}

            </div>


        @else

            <div class="text-center py-20">

                <div class="text-6xl">
                    ☕
                </div>

                <h3 class="text-xl font-bold mt-5">
                    No products found
                </h3>

                <p class="text-stone-500 mt-2">
                    Belum ada produk pada kategori ini.
                </p>

            </div>

        @endif


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


</body>
</html>