<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Orders - CoffeeBlend Admin</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100">

<div class="min-h-screen flex">

    <!-- SIDEBAR -->
    <aside class="w-64 bg-[#0d0b0b] text-white min-h-screen">

        <!-- Logo -->
        <div class="p-6 border-b border-gray-800">

            <div class="flex items-center gap-3">

                <div class="w-12 h-12 rounded-xl bg-orange-600 flex items-center justify-center">
                    ☕
                </div>

                <div>
                    <h1 class="text-xl font-bold">
                        CoffeeBlend
                    </h1>

                    <p class="text-sm text-gray-400">
                        Admin Panel
                    </p>
                </div>

            </div>

        </div>


        <!-- MENU -->
        <div class="p-4">

            <p class="text-xs text-gray-500 uppercase mb-4">
                Menu
            </p>


            <!-- Dashboard -->
            <a href="{{ route('dashboard') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-lg mb-2 hover:bg-gray-800">

                📊

                <span>
                    Dashboard
                </span>

            </a>


            <!-- Products -->
            <a href="{{ route('admin.products.index') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-lg mb-2 hover:bg-gray-800">

                ☕

                <span>
                    Products
                </span>

            </a>


            <!-- Categories -->
            <a href="{{ route('admin.categories.index') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-lg mb-2 hover:bg-gray-800">

                🏷️

                <span>
                    Categories
                </span>

            </a>


            <!-- Orders -->
            <a href="{{ route('admin.orders.index') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-lg mb-2 bg-orange-600">

                📦

                <span>
                    Orders
                </span>

            </a>

        </div>

    </aside>


    <!-- MAIN CONTENT -->
    <main class="flex-1">

        <!-- HEADER -->
        <header class="bg-white border-b px-8 py-6">

            <div>

                <p class="text-gray-500">
                    Management
                </p>

                <h1 class="text-3xl font-bold">
                    Orders
                </h1>

            </div>

        </header>


        <!-- CONTENT -->
        <div class="p-8">


            <!-- SUCCESS MESSAGE -->
            @if(session('success'))

                <div class="mb-6 p-4 bg-green-100 text-green-700 rounded-lg">

                    {{ session('success') }}

                </div>

            @endif


            <!-- ORDER TABLE -->
            <div class="bg-white rounded-2xl shadow-sm overflow-hidden">

                <div class="p-6 border-b">

                    <h2 class="text-xl font-bold">
                        All Orders
                    </h2>

                    <p class="text-gray-500 mt-1">
                        Manage customer orders
                    </p>

                </div>


                <div class="overflow-x-auto">

                    <table class="w-full">

                        <thead class="bg-gray-50">

                            <tr>

                                <th class="px-6 py-4 text-left text-sm font-semibold">
                                    Order
                                </th>

                                <th class="px-6 py-4 text-left text-sm font-semibold">
                                    Customer
                                </th>

                                <th class="px-6 py-4 text-left text-sm font-semibold">
                                    Status
                                </th>

                                <th class="px-6 py-4 text-left text-sm font-semibold">
                                    Total
                                </th>

                                <th class="px-6 py-4 text-left text-sm font-semibold">
                                    Action
                                </th>

                            </tr>

                        </thead>


                        <tbody>

                            @forelse($orders as $order)

                                <tr class="border-t hover:bg-gray-50">

                                    <!-- ORDER -->
                                    <td class="px-6 py-5">

                                        <div class="font-semibold">
                                            {{ $order->order_number }}
                                        </div>

                                        <div class="text-sm text-gray-500 mt-1">

                                            {{ $order->created_at->format('d M Y, H:i') }}

                                        </div>

                                    </td>


                                    <!-- CUSTOMER -->
                                    <td class="px-6 py-5">

                                        <div class="font-medium">
                                            {{ $order->customer_name }}
                                        </div>

                                        <div class="text-sm text-gray-500">
                                            {{ $order->customer_email }}
                                        </div>

                                    </td>


                                    <!-- STATUS -->
                                    <td class="px-6 py-5">

                                        @if($order->status === 'pending')

                                            <span class="inline-flex px-3 py-1 rounded-full text-sm bg-yellow-100 text-yellow-700">
                                                Pending
                                            </span>

                                        @elseif($order->status === 'processing')

                                            <span class="inline-flex px-3 py-1 rounded-full text-sm bg-blue-100 text-blue-700">
                                                Processing
                                            </span>

                                        @elseif($order->status === 'completed')

                                            <span class="inline-flex px-3 py-1 rounded-full text-sm bg-green-100 text-green-700">
                                                Completed
                                            </span>

                                        @elseif($order->status === 'cancelled')

                                            <span class="inline-flex px-3 py-1 rounded-full text-sm bg-red-100 text-red-700">
                                                Cancelled
                                            </span>

                                        @else

                                            <span class="inline-flex px-3 py-1 rounded-full text-sm bg-gray-100 text-gray-700">
                                                {{ ucfirst($order->status) }}
                                            </span>

                                        @endif

                                    </td>


                                    <!-- TOTAL -->
                                    <td class="px-6 py-5 font-semibold text-orange-700">

                                        Rp {{ number_format($order->total_amount, 0, ',', '.') }}

                                    </td>


                                    <!-- ACTION -->
                                    <td class="px-6 py-5">

                                        <a
                                            href="{{ route('admin.orders.show', $order) }}"
                                            class="inline-block px-4 py-2 bg-orange-600 hover:bg-orange-700 text-white rounded-lg font-medium">

                                            View

                                        </a>

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="5" class="px-6 py-12 text-center">

                                        <div class="text-gray-400 text-4xl mb-3">
                                            📦
                                        </div>

                                        <p class="text-gray-500">
                                            No orders found.
                                        </p>

                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>


                <!-- PAGINATION -->
                @if($orders->hasPages())

                    <div class="p-6 border-t">

                        {{ $orders->links() }}

                    </div>

                @endif

            </div>

        </div>

    </main>

</div>

</body>

</html>