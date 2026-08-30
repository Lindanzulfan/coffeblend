<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Add Product - CoffeeBlend</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-stone-100 text-stone-900">

<div class="min-h-screen flex">

    {{-- SIDEBAR --}}
    <aside class="w-64 bg-stone-950 text-white flex flex-col">

        <div class="px-6 py-7 border-b border-stone-800">

            <div class="flex items-center gap-3">

                <div class="w-10 h-10 rounded-xl bg-amber-700 flex items-center justify-center">
                    ☕
                </div>

                <div>
                    <h1 class="font-bold text-lg">
                        CoffeeBlend
                    </h1>

                    <p class="text-xs text-stone-400">
                        Admin Panel
                    </p>
                </div>

            </div>

        </div>

        <nav class="flex-1 px-4 py-6">

            <p class="text-xs uppercase text-stone-500 font-semibold px-3 mb-3">
                Menu
            </p>

            <a
                href="#"
                class="flex items-center gap-3 px-3 py-3 rounded-lg text-stone-400 hover:bg-stone-800 mb-1"
            >
                📊 Dashboard
            </a>

            <a
                href="{{ route('admin.products.index') }}"
                class="flex items-center gap-3 px-3 py-3 rounded-lg bg-amber-700 text-white mb-1"
            >
                ☕ Products
            </a>

            <a
                href="#"
                class="flex items-center gap-3 px-3 py-3 rounded-lg text-stone-400 hover:bg-stone-800 mb-1"
            >
                🏷️ Categories
            </a>

            <a
                href="#"
                class="flex items-center gap-3 px-3 py-3 rounded-lg text-stone-400 hover:bg-stone-800 mb-1"
            >
                📦 Orders
            </a>

            <a
                href="#"
                class="flex items-center gap-3 px-3 py-3 rounded-lg text-stone-400 hover:bg-stone-800 mb-1"
            >
                👥 Customers
            </a>

        </nav>

    </aside>


    {{-- MAIN CONTENT --}}
    <main class="flex-1">

        <header class="bg-white border-b border-stone-200 px-8 py-5">

            <div>

                <p class="text-sm text-stone-500">
                    Products
                </p>

                <h2 class="text-2xl font-bold">
                    Add New Product
                </h2>

            </div>

        </header>


        <div class="p-8">

            <div class="max-w-4xl">

                <div class="bg-white rounded-2xl border border-stone-200 shadow-sm">

                    <div class="px-6 py-5 border-b border-stone-200">

                        <h3 class="text-lg font-bold">
                            Product Information
                        </h3>

                        <p class="text-sm text-stone-500 mt-1">
                            Add a new product to your CoffeeBlend menu.
                        </p>

                    </div>


                    {{-- ERRORS --}}

                    @if ($errors->any())

                        <div class="mx-6 mt-6 bg-red-100 border border-red-200 text-red-700 rounded-xl p-4">

                            <p class="font-semibold mb-2">
                                Please fix the following errors:
                            </p>

                            <ul class="list-disc ml-5 text-sm">

                                @foreach ($errors->all() as $error)

                                    <li>{{ $error }}</li>

                                @endforeach

                            </ul>

                        </div>

                    @endif


                    <form
                        action="{{ route('admin.products.store') }}"
                        method="POST"
                        enctype="multipart/form-data"
                        class="p-6"
                    >

                        @csrf


                        {{-- PRODUCT NAME --}}

                        <div class="mb-6">

                            <label class="block text-sm font-semibold mb-2">
                                Product Name
                            </label>

                            <input
                                type="text"
                                name="name"
                                value="{{ old('name') }}"
                                placeholder="Example: Caramel Macchiato"
                                class="w-full border border-stone-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-amber-600 focus:outline-none"
                                required
                            >

                        </div>


                        {{-- CATEGORY --}}

                        <div class="mb-6">

                            <label class="block text-sm font-semibold mb-2">
                                Category
                            </label>

                            <select
                                name="category_id"
                                class="w-full border border-stone-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-amber-600 focus:outline-none"
                                required
                            >

                                <option value="">
                                    Select category
                                </option>

                                @foreach($categories as $category)

                                    <option
                                        value="{{ $category->id }}"
                                        {{ old('category_id') == $category->id ? 'selected' : '' }}
                                    >
                                        {{ $category->name }}
                                    </option>

                                @endforeach

                            </select>

                        </div>


                        {{-- DESCRIPTION --}}

                        <div class="mb-6">

                            <label class="block text-sm font-semibold mb-2">
                                Description
                            </label>

                            <textarea
                                name="description"
                                rows="5"
                                placeholder="Describe the product..."
                                class="w-full border border-stone-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-amber-600 focus:outline-none"
                            >{{ old('description') }}</textarea>

                        </div>


                        {{-- PRICE & STOCK --}}

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">

                            <div>

                                <label class="block text-sm font-semibold mb-2">
                                    Price
                                </label>

                                <div class="relative">

                                    <span class="absolute left-4 top-3 text-stone-500">
                                        Rp
                                    </span>

                                    <input
                                        type="number"
                                        name="price"
                                        value="{{ old('price') }}"
                                        min="0"
                                        placeholder="25000"
                                        class="w-full border border-stone-300 rounded-xl pl-12 pr-4 py-3 focus:ring-2 focus:ring-amber-600 focus:outline-none"
                                        required
                                    >

                                </div>

                            </div>


                            <div>

                                <label class="block text-sm font-semibold mb-2">
                                    Stock
                                </label>

                                <input
                                    type="number"
                                    name="stock"
                                    value="{{ old('stock', 0) }}"
                                    min="0"
                                    placeholder="50"
                                    class="w-full border border-stone-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-amber-600 focus:outline-none"
                                    required
                                >

                            </div>

                        </div>


                        {{-- IMAGE --}}

                        <div class="mb-8">

                            <label class="block text-sm font-semibold mb-2">
                                Product Image
                            </label>

                            <input
                                type="file"
                                name="image"
                                accept="image/*"
                                class="w-full border border-stone-300 rounded-xl px-4 py-3"
                            >

                            <p class="text-xs text-stone-500 mt-2">
                                JPG, PNG, WEBP. Maximum 2MB.
                            </p>

                        </div>


                        {{-- BUTTONS --}}

                        <div class="flex items-center justify-end gap-3">

                            <a
                                href="{{ route('admin.products.index') }}"
                                class="px-5 py-3 rounded-xl border border-stone-300 hover:bg-stone-100"
                            >
                                Cancel
                            </a>

                            <button
                                type="submit"
                                class="px-6 py-3 rounded-xl bg-amber-700 hover:bg-amber-800 text-white font-semibold"
                            >
                                Save Product
                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </main>

</div>

</body>

</html>