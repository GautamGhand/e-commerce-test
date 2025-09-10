<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name') }} | {{ $title }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-white">
    <!-- Navbar -->
    <div class="bg-white dark:bg-gray-800 shadow-md px-6 py-4 flex justify-between items-center">
        <a href="{{ route('home') }}" class="text-xl font-bold text-blue-600 dark:text-blue-400">
            Home
        </a>
        <div class="flex items-center gap-4">
            @role('customer')
                <a href="{{ route('cart.index') }}"
                    class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                    🛒 Cart
                </a>
                <a href="{{ route('orders.index') }}" class="text-xl font-bold text-blue-600 dark:text-blue-400">
                    Orders
                </a>
                <span class="text-gray-700 dark:text-gray-300">Welcome, {{ auth()->user()->name }}</span>
                <a href="{{ route('customer.logout') }}" class="text-red-500 hover:underline">
                    Logout
                </a>
            @else
                <a href="{{ route('customer.login.index') }}"
                    class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                    Customer Login
                </a>
            @endrole
        </div>
    </div>

    <!-- Flash Message -->
    @if (session('success'))
        <div class="container mx-auto mt-4">
            <div class="bg-green-100 text-green-700 px-4 py-2 rounded mb-4">
                {{ session('success') }}
            </div>
        </div>
    @endif

    @yield('content')
</body>

</html>
