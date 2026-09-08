<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - {{ config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen flex items-center justify-center bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] dark:text-[#EDEDEC]">
    <div class="w-full max-w-sm">
        <h1 class="text-xl font-bold mb-6 text-center">Login</h1>

        @if ($errors->any())
            <div class="mb-4 p-3 rounded bg-red-100 text-red-700 dark:bg-red-900/50 dark:text-red-400">
                <ul class="list-disc list-inside text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="space-y-4">
            @csrf

            <div>
                <label for="email" class="block text-sm font-medium mb-1">Email</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    value="{{ old('email') }}"
                    required
                    autofocus
                    class="w-full px-3 py-2 border rounded-lg bg-white dark:bg-[#161615] dark:border-[#3E3E3A] focus:outline-none focus:ring-2 focus:ring-[#f53003]"
                >
            </div>

            <div>
                <label for="password" class="block text-sm font-medium mb-1">Password</label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    required
                    class="w-full px-3 py-2 border rounded-lg bg-white dark:bg-[#161615] dark:border-[#3E3E3A] focus:outline-none focus:ring-2 focus:ring-[#f53003]"
                >
            </div>

            <div class="flex items-center">
                <input
                    type="checkbox"
                    id="remember"
                    name="remember"
                    class="rounded border-[#3E3E3A] text-[#f53003] focus:ring-[#f53003]"
                >
                <label for="remember" class="ml-2 text-sm">Ingat saya</label>
            </div>

            <button
                type="submit"
                class="w-full py-2 px-4 bg-[#1b1b18] dark:bg-[#eeeeec] text-white dark:text-[#1C1C1A] rounded-lg hover:bg-black dark:hover:bg-white transition-colors"
            >
                Login
            </button>
        </form>
    </div>
</body>
</html>