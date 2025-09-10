@extends('customer.layouts.guest', ['title' => 'Home'])

@section('content')
    <div class="container mx-auto px-4 py-6">
        <!-- Products Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach ($products as $product)
                <div class="border p-4 rounded shadow">
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                        class="w-full h-40 object-cover mb-2">
                    <h2 class="text-lg font-semibold">{{ $product->name }}</h2>
                    <p class="text-gray-600 mb-2">${{ $product->price }}</p>

                    @role('customer')
                        <form action="{{ route('addToCart', $product->uuid) }}" method="POST">
                            @csrf
                            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 w-full">
                                Add to Cart
                            </button>
                        </form>
                    @endrole
                </div>
            @endforeach
        </div>
    </div>
@endsection
