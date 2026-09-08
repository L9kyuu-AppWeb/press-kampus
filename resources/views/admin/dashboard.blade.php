<x-layouts.app title="Dashboard">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
        <div class="p-4 border rounded-lg bg-white dark:bg-[#161615] dark:border-[#3E3E3A]">
            <p class="text-sm text-gray-500 dark:text-gray-400">Pengguna</p>
            <p class="text-2xl font-bold">{{ Auth::user()->name }}</p>
        </div>
        <div class="p-4 border rounded-lg bg-white dark:bg-[#161615] dark:border-[#3E3E3A]">
            <p class="text-sm text-gray-500 dark:text-gray-400">Role</p>
            <p class="text-2xl font-bold">{{ ucfirst(Auth::user()->role) }}</p>
        </div>
        <div class="p-4 border rounded-lg bg-white dark:bg-[#161615] dark:border-[#3E3E3A]">
            <p class="text-sm text-gray-500 dark:text-gray-400">Email</p>
            <p class="text-sm font-medium truncate">{{ Auth::user()->email }}</p>
        </div>
    </div>

    @if (Auth::user()->isAdmin())
        <section class="p-6 border rounded-lg bg-white dark:bg-[#161615] dark:border-[#3E3E3A]">
            <h3 class="font-bold mb-2">Panel Admin</h3>
            <p class="text-sm text-gray-600 dark:text-gray-400">Selamat datang di panel admin. Anda dapat mengelola pengguna dan data di sini.</p>
        </section>
    @endif
</x-layouts.app>