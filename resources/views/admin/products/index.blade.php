<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Products - CoffeeBlend Admin</title>

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


            {{-- NAVIGATION --}}
            <nav class="flex-1 px-4 py-6">

                <p class="text-xs uppercase text-stone-500 font-semibold px-3 mb-3">
                    Menu
                </p>

                <a
                    href="#"
                    class="flex items-center gap-3 px-3 py-3 rounded-lg text-stone-400 hover:bg-stone-800 hover:text-white mb-1"
                >
                    📊
                    Dashboard
                </a>

                <a
                    href="{{ route('admin.products.index') }}"
                    class="flex items-center gap-3 px-3 py-3 rounded-lg bg-amber-700 text-white mb-1"
                >
                    ☕
                    Products
                </a>

                <a
                    href="#"
                    class="flex items-center gap-3 px-3 py-3 rounded-lg text-stone-400 hover:bg-stone-800 hover:text-white mb-1"
                >
                    🏷️
                    Categories
                </a>

                <a
                    href="#"
                    class="flex items-center gap-3 px-3 py-3 rounded-lg text-stone-400 hover:bg-stone-800 hover:text-white mb-1"
                >
                    📦
                    Orders
                </a>

                <a
                    href="#"
                    class="flex items-center gap-3 px-3 py-3 rounded-lg text-stone-400 hover:bg-stone-800 hover:text-white mb-1"
                >
                    👥
                    Customers
                </a>
            </nav>
            {{-- ADMIN PROFILE --}}
            <div class="border-t border-stone-800 p-4">

                <div class="flex items-center gap-3">

                    <div class="w-10 h-10 rounded-full bg-stone-700 flex items-center justify-center">
                        A
                    </div>

                    <div>
                        <p class="text-sm font-medium">
                            Administrator
                        </p>

                        <p class="text-xs text-stone-500">
                            CoffeeBlend
                        </p>
                    </div>

                </div>

            </div>

        </aside>


        {{-- MAIN CONTENT --}}
        <main class="flex-1">

            {{-- TOP BAR --}}
            <header class="bg-white border-b border-stone-200 px-8 py-5">

                <div class="flex items-center justify-between">

                    <div>
                        <p class="text-sm text-stone-500">
                            Management
                        </p>

                        <h2 class="text-2xl font-bold">
                            Products
                        </h2>
                    </div>

                    <a
                        href="{{ route('admin.products.create') }}"
                        class="bg-amber-700 hover:bg-amber-800 text-white px-5 py-3 rounded-xl font-medium shadow-sm"
                    >
                        + Add Product
                    </a>

                </div>

            </header>


            {{-- CONTENT --}}
            <div class="p-8">


                {{-- SUCCESS MESSAGE --}}
                @if(session('success'))

                    <div class="mb-6 bg-green-100 border border-green-200 text-green-800 px-5 py-4 rounded-xl">

                        {{ session('success') }}

                    </div>

                @endif


                {{-- STATISTICS --}}
                <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-8">


                    <div class="bg-white rounded-2xl p-6 shadow-sm border border-stone-200">

                        <p class="text-sm text-stone-500">
                            Total Products
                        </p>

                        <p class="text-3xl font-bold mt-2">
                            {{ $products->total() }}
                        </p>

                    </div>


                    <div class="bg-white rounded-2xl p-6 shadow-sm border border-stone-200">

                        <p class="text-sm text-stone-500">
                            Categories
                        </p>

                        <p class="text-3xl font-bold mt-2">
                            {{ \App\Models\Category::count() }}
                        </p>

                    </div>


                    <div class="bg-white rounded-2xl p-6 shadow-sm border border-stone-200">

                        <p class="text-sm text-stone-500">
                            Low Stock
                        </p>

                        <p class="text-3xl font-bold mt-2">
                            {{ \App\Models\Product::where('stock', '<', 10)->count() }}
                        </p>

                    </div>

                </div>


                {{-- PRODUCT TABLE --}}
                <div class="bg-white rounded-2xl border border-stone-200 shadow-sm overflow-hidden">


                    <div class="px-6 py-5 border-b border-stone-200 flex items-center justify-between">

                        <div>

                            <h3 class="font-bold text-lg">
                                All Products
                            </h3>

                            <p class="text-sm text-stone-500 mt-1">
                                Manage your CoffeeBlend products
                            </p>

                        </div>

                    </div>


                    <div class="overflow-x-auto">

                        <table class="w-full">

                            <thead class="bg-stone-50">

                                <tr>

                                    <th class="text-left px-6 py-4 text-sm font-semibold text-stone-600">
                                        Product
                                    </th>

                                    <th class="text-left px-6 py-4 text-sm font-semibold text-stone-600">
                                        Category
                                    </th>

                                    <th class="text-left px-6 py-4 text-sm font-semibold text-stone-600">
                                        Price
                                    </th>

                                    <th class="text-left px-6 py-4 text-sm font-semibold text-stone-600">
                                        Stock
                                    </th>

                                    <th class="text-right px-6 py-4 text-sm font-semibold text-stone-600">
                                        Actions
                                    </th>

                                </tr>

                            </thead>


                            <tbody class="divide-y divide-stone-100">

                                @forelse($products as $product)

                                    <tr class="hover:bg-stone-50 transition">


                                        {{-- PRODUCT --}}

                                        <td class="px-6 py-5">

                                            <div class="flex items-center gap-4">

                                                @if($product->image)
    <img
        src="{{ asset('storage/' . $product->image) }}"
        alt="{{ $product->name }}"
        class="w-12 h-12 rounded-xl object-cover"
    >
@else
    <div class="w-12 h-12 rounded-xl bg-amber-100 flex items-center justify-center text-xl">
        ☕
    </div>
@endif

                                                <div>

                                                    <p class="font-semibold">
                                                        {{ $product->name }}
                                                    </p>

                                                    <p class="text-sm text-stone-500">
                                                        Product #{{ $product->id }}
                                                    </p>

                                                </div>

                                            </div>

                                        </td>


                                        {{-- CATEGORY --}}

                                        <td class="px-6 py-5">

                                            <span class="px-3 py-1 bg-stone-100 rounded-full text-sm">

                                                {{ $product->category->name }}

                                            </span>

                                        </td>


                                        {{-- PRICE --}}

                                        <td class="px-6 py-5 font-medium">

                                            Rp {{ number_format($product->price, 0, ',', '.') }}

                                        </td>


                                        {{-- STOCK --}}

                                        <td class="px-6 py-5">

                                            @if($product->stock < 10)

                                                <span class="px-3 py-1 bg-red-100 text-red-700 rounded-full text-sm">
                                                    {{ $product->stock }} Low
                                                </span>

                                            @else

                                                <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-sm">
                                                    {{ $product->stock }} Available
                                                </span>

                                            @endif

                                        </td>


                                        {{-- ACTIONS --}}

                                        <td class="px-6 py-5">

                                            <div class="flex justify-end gap-2">

                                                <a
                                                    href="{{ route('admin.products.show', $product) }}"
                                                    class="px-3 py-2 bg-stone-100 hover:bg-stone-200 rounded-lg text-sm"
                                                >
                                                    View
                                                </a>


                                                <a
                                                    href="{{ route('admin.products.edit', $product) }}"
                                                    class="px-3 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg text-sm"
                                                >
                                                    Edit
                                                </a>


                                                <form
                                                    action="{{ route('admin.products.destroy', $product) }}"
                                                    method="POST"
                                                >

                                                    @csrf

                                                    @method('DELETE')

                                                    <button
                                                        type="submit"
                                                        onclick="return confirm('Are you sure you want to delete this product?')"
                                                        class="px-3 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg text-sm"
                                                    >
                                                        Delete
                                                    </button>

                                                </form>

                                            </div>

                                        </td>

                                    </tr>

                                @empty

                                    <tr>

                                        <td
                                            colspan="5"
                                            class="text-center py-16 text-stone-500"
                                        >

                                            No products found.

                                        </td>

                                    </tr>

                                @endforelse

                            </tbody>

                        </table>

                    </div>


                    {{-- PAGINATION --}}

                    <div class="px-6 py-5 border-t border-stone-200">

                        {{ $products->links() }}

                    </div>

                </div>

            </div>

        </main>

    </div>

</body>

</html>