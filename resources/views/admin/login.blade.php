@extends('admin.layouts.guest',['title' => 'Admin Login'])

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-100">
    <div class="w-full max-w-md bg-white shadow-lg rounded-lg p-8">
        <h2 class="text-2xl font-bold text-center mb-6 text-gray-800">Admin Login</h2>

        @if(session('error'))
            <div class="bg-red-100 text-red-700 px-4 py-2 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('admin.login') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label for="email" class="block text-gray-700 font-medium mb-1">Email</label>
                <input type="email" name="email" id="email" placeholder="Enter your email"
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password" class="block text-gray-700 font-medium mb-1">Password</label>
                <input type="password" name="password" id="password" placeholder="Enter your password"
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-between">
                <div>
                    <input type="checkbox" name="remember" id="remember" class="mr-1">
                    <label for="remember" class="text-gray-600 text-sm">Remember Me</label>
                </div>
                {{-- <a href="{{ route('admin.password.request') }}" class="text-blue-500 text-sm hover:underline">Forgot password?</a> --}}
            </div>

            <button type="submit" class="w-full bg-blue-500 text-white font-semibold py-2 rounded hover:bg-blue-600">
                Login
            </button>
        </form>
    </div>
</div>
@endsection
