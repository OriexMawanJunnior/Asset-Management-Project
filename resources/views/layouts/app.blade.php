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
        @include('components.sidebar')
        <main class="flex-1 p-8">
            <div class="flex justify-between items-center mb-8">
                <h1 class="text-2xl font-bold">
                    @if (Route::is('dashboard'))
                        Dashboard
                    @elseif (Route::is('assets.index'))
                        Assets
                    @elseif (Route::is('users.index'))
                        Users
                    @elseif (Route::is('borrowings.index'))
                        Borrowing
                    @else
                        Page
                    @endif
                </h1>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="bg-white px-6 py-2 rounded-full hover:bg-gray-50">
                        Logout
                    </button>
                </form>
            </div>
            @yield('content')
        </main>
    </div>
</body>
</html>