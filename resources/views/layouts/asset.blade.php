<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AMS - @yield('title')</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-[#FFF3E0]">
    <div class="min-h-screen flex">
        <main class="flex-1 p-8">
            @yield('content')
        </main>
    </div>
</body>
</html>