<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name') }} | {{ $title }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100">
    <div class="flex h-screen">

        {{-- Sidebar --}}
        @include('admin.layouts.sidebar')

        {{-- Main Content --}}
        <div class="flex-1 ml-64 p-6 overflow-y-auto">
            @yield('content')
        </div>
    </div>
</body>

</html>
