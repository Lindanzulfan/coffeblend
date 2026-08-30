<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Categories - CoffeeBlend Admin</title>

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


    {{-- MAIN --}}
    <main class="flex-1">

        <header class="bg-white border-b border-stone-200 px-8 py-5">

            <div class="flex items-center justify-between">

                <div>
                    <p class="text-sm text-stone-500">
                        Management
                    </p>

                    <h2 class="text-2xl font-bold">
                        Categories
                    </h2>
                </div>

                <a
                    href="{{ route('admin.categories.create') }}"
                    class="bg-amber-700 hover:bg-amber-800 text-white px-5 py-3 rounded-xl font-medium"
                >
                    + Add Category
                </a>

            </div>

        </header>


        <div class="p-8">

            @if(session('success'))

                <div class="mb-6 bg-green-100 border border-green-200 text-green-800 px-5 py-4 rounded-xl">
                    {{ session('success') }}
                </div>

            @endif


            @if(session('error'))

                <div class="mb-6 bg-red-100 border border-red-200 text-red-800 px-5 py-4 rounded-xl">
                    {{ session('error') }}
                </div>

            @endif


            <div class="bg-white rounded-2xl border border-stone-200 shadow-sm overflow-hidden">

                <div class="px-6 py-5 border-b border-stone-200">

                    <h3 class="font-bold text-lg">
                        All Categories
                    </h3>

                    <p class="text-sm text-stone-500 mt-1">
                        Manage your CoffeeBlend product categories.
                    </p>

                </div>


                <div class="overflow-x-auto">

                    <table class="w-full">

                        <thead class="bg-stone-50">

                            <tr>

                                <th class="text-left px-6 py-4">
                                    Category
                                </th>

                                <th class="text-left px-6 py-4">
                                    Description
                                </th>

                                <th class="text-center px-6 py-4">
                                    Products
                                </th>

                                <th class="text-right px-6 py-4">
                                    Actions
                                </th>

                            </tr>

                        </thead>


                        <tbody class="divide-y divide-stone-100">

                            @forelse($categories as $category)

                                <tr class="hover:bg-stone-50">

                                    <td class="px-6 py-5">

                                        <div class="flex items-center gap-3">

                                            <div class="w-10 h-10 rounded-xl bg-amber-100 flex items-center justify-center">
                                                ☕
                                            </div>

                                            <div>

                                                <p class="font-semibold">
                                                    {{ $category->name }}
                                                </p>

                                                <p class="text-sm text-stone-500">
                                                    Category #{{ $category->id }}
                                                </p>

                                            </div>

                                        </div>

                                    </td>


                                    <td class="px-6 py-5 text-stone-600">

                                        {{ $category->description ?: '-' }}

                                    </td>


                                    <td class="px-6 py-5 text-center">

                                        <span class="px-3 py-1 bg-stone-100 rounded-full">
                                            {{ $category->products_count }}
                                        </span>

                                    </td>


                                    <td class="px-6 py-5">

                                        <div class="flex justify-end gap-2">

                                            <a
                                                href="{{ route('admin.categories.show', $category) }}"
                                                class="px-3 py-2 bg-stone-100 rounded-lg"
                                            >
                                                View
                                            </a>

                                            <a
                                                href="{{ route('admin.categories.edit', $category) }}"
                                                class="px-3 py-2 bg-blue-600 text-white rounded-lg"
                                            >
                                                Edit
                                            </a>

                                            <form
                                                action="{{ route('admin.categories.destroy', $category) }}"
                                                method="POST"
                                            >

                                                @csrf
                                                @method('DELETE')

                                                <button
                                                    type="submit"
                                                    onclick="return confirm('Hapus kategori ini?')"
                                                    class="px-3 py-2 bg-red-600 text-white rounded-lg"
                                                >
                                                    Delete
                                                </button>

                                            </form>

                                        </div>

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="4" class="text-center py-12 text-stone-500">
                                        Belum ada kategori.
                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>


                <div class="px-6 py-5 border-t border-stone-200">

                    {{ $categories->links() }}

                </div>

            </div>

        </div>

    </main>

</div>

</body>
</html>