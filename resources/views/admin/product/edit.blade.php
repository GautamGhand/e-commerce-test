@extends('admin.layouts.app', ['title' => 'Admin Products Edit'])

@section('content')
    <div class="mb-6">
        <a href="{{ route('admin.products.index') }}"
            class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-gray-200 rounded-lg shadow hover:bg-gray-300 dark:bg-gray-700 dark:text-white dark:hover:bg-gray-600">
            ← Return Back
        </a>
    </div>

    <div class="bg-white dark:bg-gray-800 shadow-lg rounded-xl p-6 max-w-2xl">
        <h2 class="text-2xl font-semibold text-gray-800 dark:text-white mb-6">Update Product</h2>

        <form method="POST" action="{{ route('admin.products.update',$product->uuid) }}" enctype="multipart/form-data" class="space-y-5">
            @csrf
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Name</label>
                <input type="text" name="name" value="{{ $product->name }}"
                    class="w-full px-4 py-2 border rounded-lg shadow-sm focus:ring focus:ring-indigo-300 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                    placeholder="Enter product name" />
                @error('name')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Description</label>
                <textarea name="description"
                    class="w-full px-4 py-2 border rounded-lg shadow-sm focus:ring focus:ring-indigo-300 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                    rows="3" placeholder="Enter product description">{{$product->description}}</textarea>
                @error('description')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Price</label>
                <input type="number" step="0.01" name="price" value="{{ $product->price }}"
                    class="w-full px-4 py-2 border rounded-lg shadow-sm focus:ring focus:ring-indigo-300 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                    placeholder="Enter product price" />
                @error('price')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Stock Quantity</label>
                <input type="number" name="stock_quantity" value="{{ $product->stock_quantity }}"
                    class="w-full px-4 py-2 border rounded-lg shadow-sm focus:ring focus:ring-indigo-300 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                    placeholder="Enter stock quantity" />
                @error('stock_quantity')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Product Image</label>
                <div>Old Image</div>
                <img src="{{ asset('storage/'.$product->image) }}" />
                <input type="file" name="image"
                    class="w-full text-sm text-gray-700 dark:text-gray-300 file:mr-4 file:py-2 file:px-4
                           file:rounded-lg file:border-0 file:text-sm file:font-semibold
                           file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100
                           dark:file:bg-gray-600 dark:file:text-white dark:hover:file:bg-gray-500" />
                @error('image')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="pt-4">
                <button type="submit"
                    class="w-full px-6 py-3 text-white bg-indigo-600 rounded-lg shadow hover:bg-indigo-700 focus:ring-4 focus:ring-indigo-300 dark:focus:ring-indigo-800">
                    Update Product
                </button>
            </div>
        </form>
    </div>
@endsection
