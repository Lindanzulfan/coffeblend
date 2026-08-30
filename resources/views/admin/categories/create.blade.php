<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Add Category - CoffeeBlend Admin</title>

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
                href="{{ route('admin.products.index') }}"
                class="flex items-center gap-3 px-3 py-3 rounded-lg text-stone-400 hover:bg-stone-800 mb-1"
            >
                ☕ Products
            </a>

            <a
                href="{{ route('admin.categories.index') }}"
                class="flex items-center gap-3 px-3 py-3 rounded-lg bg-amber-700 text-white mb-1"
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
                    Categories
                </p>

                <h2 class="text-2xl font-bold">
                    Add New Category
                </h2>

            </div>

        </header>


        <div class="p-8">

            <div class="max-w-3xl">

                <div class="bg-white rounded-2xl border border-stone-200 shadow-sm">

                    <div class="px-6 py-5 border-b border-stone-200">

                        <h3 class="text-lg font-bold">
                            Category Information
                        </h3>

                        <p class="text-sm text-stone-500 mt-1">
                            Create a new product category.
                        </p>

                    </div>


                    {{-- VALIDATION ERROR --}}

                    @if ($errors->any())

                        <div class="mx-6 mt-6 bg-red-100 border border-red-200 text-red-700 p-4 rounded-xl">

                            <ul class="list-disc ml-5">

                                @foreach ($errors->all() as $error)

                                    <li>{{ $error }}</li>

                                @endforeach

                            </ul>

                        </div>

                    @endif


                    <form
                        action="{{ route('admin.categories.store') }}"
                        method="POST"
                        class="p-6"
                    >

                        @csrf


                        {{-- NAME --}}

                        <div class="mb-6">

                            <label class="block text-sm font-semibold mb-2">
                                Category Name
                            </label>

                            <input
                                type="text"
                                name="name"
                                value="{{ old('name') }}"
                                placeholder="Example: Coffee"
                                class="w-full border border-stone-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-amber-600 focus:outline-none"
                                required
                            >

                        </div>


                        {{-- DESCRIPTION --}}

                        <div class="mb-8">

                            <label class="block text-sm font-semibold mb-2">
                                Description
                            </label>

                            <textarea
                                name="description"
                                rows="5"
                                placeholder="Describe this category..."
                                class="w-full border border-stone-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-amber-600 focus:outline-none"
                            >{{ old('description') }}</textarea>

                        </div>


                        {{-- BUTTONS --}}

                        <div class="flex justify-end gap-3">

                            <a
                                href="{{ route('admin.categories.index') }}"
                                class="px-5 py-3 border border-stone-300 rounded-xl hover:bg-stone-100"
                            >
                                Cancel
                            </a>

                            <button
                                type="submit"
                                class="px-6 py-3 bg-amber-700 hover:bg-amber-800 text-white rounded-xl font-semibold"
                            >
                                Save Category
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