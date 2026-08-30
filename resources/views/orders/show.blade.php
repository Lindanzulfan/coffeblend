<x-app-layout>

    <div class="py-12">
        <div class="max-w-4xl mx-auto px-6">

            <div class="mb-8">
                <p class="text-sm text-orange-600 font-semibold uppercase">
                    COFFEEBLEND
                </p>

                <h1 class="text-4xl font-bold text-gray-900 mt-2">
                    Order Details
                </h1>
            </div>

            {{-- Order Header --}}
            <div class="bg-white rounded-2xl shadow-sm p-6 mb-6">

                <div class="flex justify-between items-start">

                    <div>
                        <p class="text-gray-500 text-sm">
                            Order Number
                        </p>

                        <h2 class="text-2xl font-bold text-gray-900 mt-1">
                            {{ $order->order_number }}
                        </h2>

                        <p class="text-gray-500 mt-2">
                            {{ $order->created_at->format('d M Y, H:i') }}
                        </p>
                    </div>

                    <div>
                        @if($order->status === 'pending')
                            <span class="px-4 py-2 rounded-full bg-yellow-100 text-yellow-700 font-semibold">
                                Pending
                            </span>
                        @elseif($order->status === 'processing')
                            <span class="px-4 py-2 rounded-full bg-blue-100 text-blue-700 font-semibold">
                                Processing
                            </span>
                        @elseif($order->status === 'completed')
                            <span class="px-4 py-2 rounded-full bg-green-100 text-green-700 font-semibold">
                                Completed
                            </span>
                        @else
                            <span class="px-4 py-2 rounded-full bg-red-100 text-red-700 font-semibold">
                                {{ ucfirst($order->status) }}
                            </span>
                        @endif
                    </div>

                </div>

            </div>

            {{-- Customer Information --}}
            <div class="bg-white rounded-2xl shadow-sm p-6 mb-6">

                <h2 class="text-xl font-bold mb-5">
                    Customer Information
                </h2>

                <div class="grid md:grid-cols-2 gap-5">

                    <div>
                        <p class="text-gray-500 text-sm">
                            Name
                        </p>

                        <p class="font-semibold mt-1">
                            {{ $order->customer_name }}
                        </p>
                    </div>

                    <div>
                        <p class="text-gray-500 text-sm">
                            Email
                        </p>

                        <p class="font-semibold mt-1">
                            {{ $order->customer_email }}
                        </p>
                    </div>

                    <div>
                        <p class="text-gray-500 text-sm">
                            Phone
                        </p>

                        <p class="font-semibold mt-1">
                            {{ $order->customer_phone }}
                        </p>
                    </div>

                    <div>
                        <p class="text-gray-500 text-sm">
                            Delivery Address
                        </p>

                        <p class="font-semibold mt-1">
                            {{ $order->delivery_address }}
                        </p>
                    </div>

                </div>

            </div>

            {{-- Order Items --}}
            <div class="bg-white rounded-2xl shadow-sm p-6 mb-6">

                <h2 class="text-xl font-bold mb-5">
                    Order Items
                </h2>

                <div class="space-y-4">

                    @foreach($order->items as $item)

                        <div class="flex justify-between items-center border-b pb-4">

                            <div>
                                <h3 class="font-semibold text-lg">
                                    {{ $item->product_name ?? $item->product->name }}
                                </h3>

                                <p class="text-gray-500">
                                    {{ $item->quantity }}
                                    ×
                                    Rp {{ number_format($item->price, 0, ',', '.') }}
                                </p>
                            </div>

                            <p class="font-bold">
                                Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                            </p>

                        </div>

                    @endforeach

                </div>

                {{-- Total --}}
                <div class="flex justify-between items-center mt-6 pt-5 border-t">

                    <span class="text-xl font-bold">
                        Total
                    </span>

                    <span class="text-2xl font-bold text-orange-600">
                        Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                    </span>

                </div>

            </div>

            {{-- Back --}}
            <div class="flex gap-4">

                <a
                    href="{{ route('orders.index') }}"
                    class="flex-1 text-center bg-orange-600 hover:bg-orange-700 text-white font-semibold py-4 rounded-xl"
                >
                    ← Back to My Orders
                </a>

                <a
                    href="{{ url('/') }}"
                    class="flex-1 text-center border border-gray-300 hover:bg-gray-50 font-semibold py-4 rounded-xl"
                >
                    Back to Home
                </a>

            </div>

        </div>
    </div>

</x-app-layout>