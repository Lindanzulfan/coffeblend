<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Edit Product - CoffeeBlend</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-stone-100 text-stone-900">

<div class="min-h-screen">

    <header class="bg-stone-950 text-white px-8 py-5">

        <div class="max-w-5xl mx-auto flex justify-between items-center">

            <div>
                <h1 class="text-xl font-bold">
                    ☕ CoffeeBlend
                </h1>

                <p class="text-sm text-stone-400">
                    Edit Product
                </p>
            </div>

            <a
                href="{{ route('admin.products.index') }}"
                class="text-sm text-stone-300 hover:text-white"
            >
                ← Back to Products
            </a>

        </div>

    </header>


    <main class="max-w-5xl mx-auto p-8">

        <div class="bg-white rounded-2xl border border-stone-200 shadow-sm">

            <div class="px-6 py-5 border-b border-stone-200">

                <h2 class="text-xl font-bold">
                    Edit {{ $product->name }}
                </h2>

                <p class="text-sm text-stone-500 mt-1">
                    Update product information.
                </p>

            </div>


            @if ($errors->any())

                <div class="mx-6 mt-6 bg-red-100 text-red-700 p-4 rounded-xl">

                    <ul class="list-disc ml-5">

                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach

                    </ul>

                </div>

            @endif


            <form
                action="{{ route('admin.products.update', $product) }}"
                method="POST"
                enctype="multipart/form-data"
                class="p-6"
            >

                @csrf
                @method('PUT')


                <div class="mb-6">

                    <label class="block font-semibold mb-2">
                        Product Name
                    </label>

                    <input
                        type="text"
                        name="name"
                        value="{{ old('name', $product->name) }}"
                        class="w-full border border-stone-300 rounded-xl px-4 py-3"
                        required
                    >

                </div>


                <div class="mb-6">

                    <label class="block font-semibold mb-2">
                        Category
                    </label>

                    <select
                        name="category_id"
                        class="w-full border border-stone-300 rounded-xl px-4 py-3"
                        required
                    >

                        @foreach($categories as $category)

                            <option
                                value="{{ $category->id }}"
                                {{ $product->category_id == $category->id ? 'selected' : '' }}
                            >
                                {{ $category->name }}
                            </option>

                        @endforeach

                    </select>

                </div>


                <div class="mb-6">

                    <label class="block font-semibold mb-2">
                        Description
                    </label>

                    <textarea
                        name="description"
                        rows="5"
                        class="w-full border border-stone-300 rounded-xl px-4 py-3"
                    >{{ old('description', $product->description) }}</textarea>

                </div>


                <div class="grid md:grid-cols-2 gap-6 mb-6">

                    <div>

                        <label class="block font-semibold mb-2">
                            Price
                        </label>

                        <input
                            type="number"
                            name="price"
                            value="{{ old('price', $product->price) }}"
                            min="0"
                            class="w-full border border-stone-300 rounded-xl px-4 py-3"
                            required
                        >

                    </div>


                    <div>

                        <label class="block font-semibold mb-2">
                            Stock
                        </label>

                        <input
                            type="number"
                            name="stock"
                            value="{{ old('stock', $product->stock) }}"
                            min="0"
                            class="w-full border border-stone-300 rounded-xl px-4 py-3"
                            required
                        >

                    </div>

                </div>


                {{-- CURRENT IMAGE --}}

                @if($product->image)

                    <div class="mb-6">

                        <p class="font-semibold mb-2">
                            Current Image
                        </p>

                        <img
                            src="{{ asset('storage/' . $product->image) }}"
                            alt="{{ $product->name }}"
                            class="w-40 h-40 object-cover rounded-2xl"
                        >

                    </div>

                @endif


                <div class="mb-8">

                    <label class="block font-semibold mb-2">
                        Replace Image
                    </label>

                    <input
                        type="file"
                        name="image"
                        accept="image/*"
                        class="w-full border border-stone-300 rounded-xl px-4 py-3"
                    >

                    <p class="text-xs text-stone-500 mt-2">
                        Leave empty if you don't want to change the image.
                    </p>

                </div>


                <div class="flex justify-end gap-3">

                    <a
                        href="{{ route('admin.products.index') }}"
                        class="px-5 py-3 border border-stone-300 rounded-xl"
                    >
                        Cancel
                    </a>

                    <button
                        type="submit"
                        class="px-6 py-3 bg-amber-700 hover:bg-amber-800 text-white rounded-xl font-semibold"
                    >
                        Update Product
                    </button>

                </div>

            </form>

        </div>

    </main>

</div>

</body>

</html>