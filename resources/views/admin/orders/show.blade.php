<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        Order {{ $order->order_number }} - CoffeeBlend
    </title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>


<body class="bg-gray-100">


<div class="min-h-screen flex">


    <!-- SIDEBAR -->

    <aside class="w-64 bg-[#0d0b0b] text-white min-h-screen">

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


        <div class="p-4">

            <p class="text-xs text-gray-500 uppercase mb-4">
                Menu
            </p>


            <a href="{{ route('dashboard') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-lg mb-2 hover:bg-gray-800">

                📊 Dashboard

            </a>


            <a href="{{ route('admin.products.index') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-lg mb-2 hover:bg-gray-800">

                ☕ Products

            </a>


            <a href="{{ route('admin.categories.index') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-lg mb-2 hover:bg-gray-800">

                🏷️ Categories

            </a>


            <a href="{{ route('admin.orders.index') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-lg mb-2 bg-orange-600">

                📦 Orders

            </a>

        </div>

    </aside>



    <!-- MAIN -->

    <main class="flex-1">


        <!-- HEADER -->

        <header class="bg-white border-b px-8 py-6">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-gray-500">
                        Order Details
                    </p>

                    <h1 class="text-3xl font-bold">
                        {{ $order->order_number }}
                    </h1>

                </div>


                <a
                    href="{{ route('admin.orders.index') }}"
                    class="px-5 py-2 border border-gray-300 rounded-lg hover:bg-gray-50">

                    ← Back to Orders

                </a>

            </div>

        </header>



        <!-- CONTENT -->

        <div class="p-8">


            @if(session('success'))

                <div class="mb-6 p-4 bg-green-100 text-green-700 rounded-lg">

                    {{ session('success') }}

                </div>

            @endif



            <!-- TOP CARDS -->

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">


                <!-- ORDER INFO -->

                <div class="bg-white rounded-2xl shadow-sm p-6">

                    <p class="text-sm text-gray-500">
                        Order Number
                    </p>

                    <h2 class="text-xl font-bold mt-2">
                        {{ $order->order_number }}
                    </h2>

                    <p class="text-gray-500 mt-2">

                        {{ $order->created_at->format('d M Y, H:i') }}

                    </p>

                </div>



                <!-- CUSTOMER -->

                <div class="bg-white rounded-2xl shadow-sm p-6">

                    <p class="text-sm text-gray-500">
                        Customer
                    </p>

                    <h2 class="text-xl font-bold mt-2">
                        {{ $order->customer_name }}
                    </h2>

                    <p class="text-gray-500 mt-1">
                        {{ $order->customer_email }}
                    </p>

                    <p class="text-gray-500 mt-1">
                        {{ $order->customer_phone }}
                    </p>

                </div>



                <!-- STATUS -->

                <div class="bg-white rounded-2xl shadow-sm p-6">

                    <p class="text-sm text-gray-500">
                        Current Status
                    </p>


                    @if($order->status === 'pending')

                        <span class="inline-block mt-3 px-4 py-2 rounded-full bg-yellow-100 text-yellow-700">

                            Pending

                        </span>

                    @elseif($order->status === 'processing')

                        <span class="inline-block mt-3 px-4 py-2 rounded-full bg-blue-100 text-blue-700">

                            Processing

                        </span>

                    @elseif($order->status === 'completed')

                        <span class="inline-block mt-3 px-4 py-2 rounded-full bg-green-100 text-green-700">

                            Completed

                        </span>

                    @elseif($order->status === 'cancelled')

                        <span class="inline-block mt-3 px-4 py-2 rounded-full bg-red-100 text-red-700">

                            Cancelled

                        </span>

                    @endif

                </div>

            </div>



            <!-- ORDER ITEMS -->

            <div class="bg-white rounded-2xl shadow-sm overflow-hidden mb-6">


                <div class="p-6 border-b">

                    <h2 class="text-xl font-bold">
                        Order Items
                    </h2>

                </div>



                <div class="divide-y">


                    @foreach($order->items as $item)

                        <div class="p-6 flex justify-between items-center">


                            <div>

                                <h3 class="font-semibold text-lg">

                                    {{ $item->product_name ?? $item->product?->name ?? 'Product' }}

                                </h3>


                                <p class="text-gray-500 mt-1">

                                    {{ $item->quantity }}

                                    ×

                                    Rp {{ number_format($item->price, 0, ',', '.') }}

                                </p>

                            </div>


                            <div class="font-semibold text-lg">

                                Rp {{ number_format(
                                    $item->subtotal ?? ($item->price * $item->quantity),
                                    0,
                                    ',',
                                    '.'
                                ) }}

                            </div>

                        </div>

                    @endforeach

                </div>



                <!-- TOTAL -->

                <div class="p-6 border-t bg-gray-50 flex justify-between items-center">

                    <span class="text-lg font-semibold">
                        Total
                    </span>

                    <span class="text-2xl font-bold text-orange-600">

                        Rp {{ number_format($order->total_amount, 0, ',', '.') }}

                    </span>

                </div>

            </div>



            <!-- DELIVERY -->

            <div class="bg-white rounded-2xl shadow-sm p-6 mb-6">

                <h2 class="text-xl font-bold mb-4">
                    Delivery Information
                </h2>


                <p class="text-gray-500 mb-2">
                    Delivery Address
                </p>

                <p class="font-medium">

                    {{ $order->delivery_address }}

                </p>

            </div>



            <!-- UPDATE STATUS -->

            <div class="bg-white rounded-2xl shadow-sm p-6">


                <h2 class="text-xl font-bold mb-4">

                    Update Order Status

                </h2>


                <form
                    method="POST"
                    action="{{ route('admin.orders.update', $order) }}"
                    class="flex flex-col md:flex-row gap-4">

                    @csrf

                    @method('PUT')


                    <select
                        name="status"
                        class="border-gray-300 rounded-lg px-4 py-3 flex-1">

                        <option
                            value="pending"
                            {{ $order->status === 'pending' ? 'selected' : '' }}>

                            Pending

                        </option>


                        <option
                            value="processing"
                            {{ $order->status === 'processing' ? 'selected' : '' }}>

                            Processing

                        </option>


                        <option
                            value="completed"
                            {{ $order->status === 'completed' ? 'selected' : '' }}>

                            Completed

                        </option>


                        <option
                            value="cancelled"
                            {{ $order->status === 'cancelled' ? 'selected' : '' }}>

                            Cancelled

                        </option>

                    </select>


                    <button
                        type="submit"
                        class="px-6 py-3 bg-orange-600 hover:bg-orange-700 text-white font-semibold rounded-lg">

                        Update Status

                    </button>

                </form>

            </div>


        </div>

    </main>

</div>


</body>

</html>