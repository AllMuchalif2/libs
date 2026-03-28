<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Buku Tamu - {{ config('app.name') }}</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'figtree', sans-serif;
        }
    </style>
    @livewireStyles
</head>

<body class="bg-gray-100 dark:bg-gray-900 min-h-screen flex items-center justify-center p-6 antialiased">
    <div class="fixed top-0 left-0 w-full h-1 bg-blue-600"></div>

    <div class="w-full">
        @livewire('guest-book-form')

        <div class="mt-12 text-center text-gray-500 text-sm">
            &copy; {{ date('Y') }} {{ config('app.name') }} - <a href="https://github.com/allmuchalif2">arnama</a>
        </div>
    </div>

    @livewireScripts
</body>

</html>
