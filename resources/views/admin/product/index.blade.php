@extends('admin.layouts.app', ['title' => 'Admin Products'])

@section('content')
    <div class="mb-6 flex justify-between items-center">
        <h2 class="text-2xl font-semibold text-gray-800 dark:text-white">Products</h2>
        <a href="{{ route('admin.products.create') }}"
            class="px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg shadow hover:bg-indigo-700 focus:ring-4 focus:ring-indigo-300 dark:focus:ring-indigo-800">
            + Create Product
        </a>
    </div>

    <div class="overflow-x-auto bg-white dark:bg-gray-800 rounded-lg shadow">
        <table class="min-w-full border-collapse">
            <thead class="bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300">
                <tr>
                    <th class="px-6 py-3 text-left text-sm font-semibold">ID</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold">Name</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold">Description</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold">Price</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold">Stock</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold">Image</th>
                    <th class="px-6 py-3 text-sm font-semibold text-center">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 dark:divide-gray-600">
                @forelse ($products as $product)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                        <td class="px-6 py-4 text-sm text-gray-900 dark:text-white">{{ $product->uuid }}</td>
                        <td class="px-6 py-4 text-sm text-gray-900 dark:text-white">{{ $product->name }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-300">{{ $product->description }}</td>
                        <td class="px-6 py-4 text-sm font-medium text-green-600 dark:text-green-400">
                            ₹{{ number_format($product->price, 2) }}</td>
                        <td class="px-6 py-4 text-sm text-gray-900 dark:text-white">{{ $product->stock_quantity }}</td>
                        <td class="px-6 py-4 text-sm text-gray-900 dark:text-white">
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                class="w-20 h-20 object-cover rounded-lg shadow" />
                        </td>
                        <td class="px-6 py-4 flex justify-center space-x-2">
                            <a href="{{ route('admin.products.edit', $product->uuid) }}"
                                class="px-3 py-1 bg-blue-500 text-white text-xs rounded-lg hover:bg-blue-600">
                                Edit
                            </a>
                            <form method="POST" action="{{ route('admin.products.destroy', $product->uuid) }}"
                                onsubmit="return confirm('Are you sure you want to delete this product?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="px-3 py-1 bg-red-500 text-white text-xs rounded-lg hover:bg-red-600">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-4 text-center text-gray-500 dark:text-gray-300">
                            No products found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        {{ $products->links() }}
    </div>
@endsection
