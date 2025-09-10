@extends('customer.layouts.guest', ['title' => 'Orders'])

@section('content')
    <div class="container mx-auto px-4 py-10">
        <h1 class="text-2xl font-bold mb-6 text-gray-800 dark:text-white">🛒 Orders</h1>

        @if ($orders->isNotEmpty())
            @foreach ($orders as $order)
                <div>OrderId:{{ $order->uuid }}</div>
                @if ($order->orderProducts->isNotEmpty())
                    <div class="overflow-x-auto">
                        <table class="w-full border-collapse rounded-lg shadow">
                            <thead class="bg-gray-100 dark:bg-gray-800">
                                <tr>
                                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 dark:text-gray-200">
                                        Product</th>
                                    <th class="px-6 py-3 text-center text-sm font-medium text-gray-700 dark:text-gray-200">
                                        Price</th>
                                    <th class="px-6 py-3 text-center text-sm font-medium text-gray-700 dark:text-gray-200">
                                        Quantity
                                    </th>
                                    <th class="px-6 py-3 text-center text-sm font-medium text-gray-700 dark:text-gray-200">
                                        Subtotal
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                @foreach ($order->orderProducts as $order_product)
                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-900 transition">
                                        <td class="flex items-center gap-4 px-6 py-4">
                                            <img src="{{ asset('storage/' . $order_product->product->image) }}"
                                                alt="{{ $order_product->product->name }}"
                                                class="w-16 h-16 object-cover rounded">
                                            <span class="text-gray-900 dark:text-gray-100 font-medium">
                                                {{ $order_product->product->name }}
                                            </span>
                                        </td>

                                        <td class="px-6 py-4 text-center text-gray-700 dark:text-gray-200">
                                            ${{ number_format($order_product->product->price, 2) }}
                                        </td>

                                        <td class="px-6 py-4 text-center text-gray-700 dark:text-gray-200">
                                            {{ $order_product->quantity }}
                                        </td>

                                        <td class="px-6 py-4 text-center font-semibold text-gray-900 dark:text-white">
                                            ${{ number_format($order_product->sub_total, 2) }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="flex justify-end mt-6">
                        <div class="bg-gray-100 dark:bg-gray-800 p-6 rounded-lg shadow-md w-full md:w-1/3">
                            <h2 class="text-lg font-bold mb-4 text-gray-900 dark:text-white">Order Summary</h2>
                            <div class="flex justify-between text-gray-700 dark:text-gray-200 mb-2">
                                <span>Total Items</span>
                                <span>{{ $order->orderProducts->sum('quantity') }}</span>
                            </div>
                            <div class="flex justify-between text-gray-900 dark:text-white font-bold text-lg">
                                <span>Total</span>
                                <span>
                                    ${{ number_format($order->orderProducts->sum('sub_total'), 2) }}
                                </span>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        @else
            <p class="text-center text-gray-600 dark:text-gray-300 text-lg mt-10">
                Your Have No Orders 🛍️
            </p>
        @endif
    </div>
@endsection
