<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $category->name }} - CoffeeBlend</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-stone-100 text-stone-900">

<div class="min-h-screen">

    <header class="bg-stone-950 text-white px-8 py-5">

        <div class="max-w-6xl mx-auto flex justify-between items-center">

            <div>

                <h1 class="text-xl font-bold">
                    ☕ CoffeeBlend
                </h1>

                <p class="text-sm text-stone-400">
                    Category Details
                </p>

            </div>

            <a
                href="{{ route('admin.categories.index') }}"
                class="text-sm text-stone-300 hover:text-white"
            >
                ← Back to Categories
            </a>

        </div>

    </header>


    <main class="max-w-6xl mx-auto p-8">

        <div class="bg-white rounded-2xl border border-stone-200 shadow-sm overflow-hidden">

            <div class="p-8 border-b border-stone-200">

                <div class="flex items-center justify-between">

                    <div class="flex items-center gap-4">

                        <div class="w-16 h-16 rounded-2xl bg-amber-100 flex items-center justify-center text-3xl">
                            ☕
                        </div>

                        <div>

                            <h2 class="text-3xl font-bold">
                                {{ $category->name }}
                            </h2>

                            <p class="text-stone-500 mt-1">
                                {{ $category->products->count() }} products
                            </p>

                        </div>

                    </div>


                    <a
                        href="{{ route('admin.categories.edit', $category) }}"
                        class="px-5 py-3 bg-blue-600 text-white rounded-xl"
                    >
                        Edit Category
                    </a>

                </div>


                @if($category->description)

                    <p class="text-stone-600 mt-6 max-w-3xl">
                        {{ $category->description }}
                    </p>

                @endif

            </div>


            <div class="p-8">

                <h3 class="text-xl font-bold mb-6">
                    Products in this Category
                </h3>


                @if($category->products->count())

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-5">

                        @foreach($category->products as $product)

                            <div class="border border-stone-200 rounded-2xl overflow-hidden">

                                @if($product->image)

                                    <img
                                        src="{{ asset('storage/' . $product->image) }}"
                                        alt="{{ $product->name }}"
                                        class="w-full h-48 object-cover"
                                    >

                                @else

                                    <div class="w-full h-48 bg-amber-100 flex items-center justify-center text-5xl">
                                        ☕
                                    </div>

                                @endif


                                <div class="p-5">

                                    <h4 class="font-bold">
                                        {{ $product->name }}
                                    </h4>

                                    <p class="text-amber-700 font-semibold mt-2">
                                        Rp {{ number_format($product->price, 0, ',', '.') }}
                                    </p>

                                    <p class="text-sm text-stone-500 mt-1">
                                        Stock: {{ $product->stock }}
                                    </p>

                                </div>

                            </div>

                        @endforeach

                    </div>

                @else

                    <div class="text-center py-12 text-stone-500">

                        <div class="text-5xl mb-4">
                            ☕
                        </div>

                        <p>
                            Belum ada produk dalam kategori ini.
                        </p>

                    </div>

                @endif

            </div>

        </div>

    </main>

</div>

</body>
</html>