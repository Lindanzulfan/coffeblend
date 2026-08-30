<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $product->name }} - CoffeeBlend</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-stone-100">

<div class="min-h-screen">

    <header class="bg-stone-950 text-white px-8 py-5">

        <div class="max-w-5xl mx-auto flex justify-between items-center">

            <h1 class="text-xl font-bold">
                ☕ CoffeeBlend
            </h1>

            <a
                href="{{ route('admin.products.index') }}"
                class="text-sm text-stone-300"
            >
                ← Back
            </a>

        </div>

    </header>


    <main class="max-w-5xl mx-auto p-8">

        <div class="bg-white rounded-2xl shadow-sm border border-stone-200 overflow-hidden">

            <div class="grid md:grid-cols-2">

                {{-- IMAGE --}}

                <div class="bg-stone-100 flex items-center justify-center p-8">

                    @if($product->image)

                        <img
                            src="{{ asset('storage/' . $product->image) }}"
                            alt="{{ $product->name }}"
                            class="w-full max-w-md aspect-square object-cover rounded-2xl"
                        >

                    @else

                        <div class="w-full max-w-md aspect-square bg-amber-100 rounded-2xl flex items-center justify-center text-7xl">
                            ☕
                        </div>

                    @endif

                </div>


                {{-- INFORMATION --}}

                <div class="p-8">

                    <span class="inline-block bg-stone-100 px-3 py-1 rounded-full text-sm">
                        {{ $product->category->name }}
                    </span>

                    <h2 class="text-3xl font-bold mt-4">
                        {{ $product->name }}
                    </h2>

                    <p class="text-2xl font-bold text-amber-700 mt-4">
                        Rp {{ number_format($product->price, 0, ',', '.') }}
                    </p>

                    <div class="mt-6">

                        <h3 class="font-semibold">
                            Description
                        </h3>

                        <p class="text-stone-600 mt-2 leading-relaxed">
                            {{ $product->description ?: 'No description available.' }}
                        </p>

                    </div>

                    <div class="mt-6">

                        <h3 class="font-semibold">
                            Stock
                        </h3>

                        <p class="mt-2">
                            {{ $product->stock }} units
                        </p>

                    </div>

                    <div class="mt-8 flex gap-3">

                        <a
                            href="{{ route('admin.products.edit', $product) }}"
                            class="px-5 py-3 bg-blue-600 text-white rounded-xl"
                        >
                            Edit Product
                        </a>

                        <a
                            href="{{ route('admin.products.index') }}"
                            class="px-5 py-3 border border-stone-300 rounded-xl"
                        >
                            Back
                        </a>

                    </div>

                </div>

            </div>

        </div>

    </main>

</div>

</body>

</html>