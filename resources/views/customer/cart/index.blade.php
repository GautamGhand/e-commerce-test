@extends('customer.layouts.guest', ['title' => 'Cart Items'])

@section('content')
    <div class="container mx-auto px-4 py-10">
        <h1 class="text-2xl font-bold mb-6 text-gray-800 dark:text-white">🛒 Your Shopping Cart</h1>

        @if ($cart)
            @if ($cart->cartProducts->isNotEmpty())
                <div class="overflow-x-auto">
                    <table class="w-full border-collapse rounded-lg shadow">
                        <thead class="bg-gray-100 dark:bg-gray-800">
                            <tr>
                                <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 dark:text-gray-200">Product
                                </th>
                                <th class="px-6 py-3 text-center text-sm font-medium text-gray-700 dark:text-gray-200">Price
                                </th>
                                <th class="px-6 py-3 text-center text-sm font-medium text-gray-700 dark:text-gray-200">
                                    Quantity
                                </th>
                                <th class="px-6 py-3 text-center text-sm font-medium text-gray-700 dark:text-gray-200">
                                    Subtotal
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach ($cart->cartProducts as $cart_product)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-900 transition">
                                    <td class="flex items-center gap-4 px-6 py-4">
                                        <img src="{{ asset('storage/' . $cart_product->product->image) }}"
                                            alt="{{ $cart_product->product->name }}" class="w-16 h-16 object-cover rounded">
                                        <span class="text-gray-900 dark:text-gray-100 font-medium">
                                            {{ $cart_product->product->name }}
                                        </span>
                                    </td>

                                    <td class="px-6 py-4 text-center text-gray-700 dark:text-gray-200">
                                        ${{ number_format($cart_product->product->price, 2) }}
                                    </td>

                                    <td class="px-6 py-4 text-center text-gray-700 dark:text-gray-200">
                                        {{ $cart_product->quantity }}
                                    </td>

                                    <td class="px-6 py-4 text-center font-semibold text-gray-900 dark:text-white">
                                        ${{ number_format($cart_product->sub_total, 2) }}
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
                            <span>{{ $cart->cartProducts->sum('quantity') }}</span>
                        </div>
                        <div class="flex justify-between text-gray-900 dark:text-white font-bold text-lg">
                            <span>Total</span>
                            <span>
                                ${{ number_format($cart->cartProducts->sum('sub_total'), 2) }}
                            </span>
                        </div>
                        <a
                            href="{{ route('checkout') }}"class="mt-6 w-full bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-lg font-semibold shadow">
                            Proceed to Checkout
                        </a>
                    </div>
                </div>
            @endif
        @else
            <p class="text-center text-gray-600 dark:text-gray-300 text-lg mt-10">
                Your cart is empty 🛍️
            </p>
        @endif
    </div>
@endsection
