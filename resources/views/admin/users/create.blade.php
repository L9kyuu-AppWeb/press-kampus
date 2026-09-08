<x-layouts.app title="Tambah Pengguna">
    <div class="max-w-2xl mx-auto">
        <h2 class="text-2xl font-bold mb-6">Tambah Pengguna</h2>

        @if ($errors->any())
            <div class="mb-6 p-4 bg-red-100 text-red-700 dark:bg-red-900/50 dark:text-red-400 rounded-lg">
                <ul class="list-disc list-inside text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('admin.users.store') }}" class="space-y-6">
            @csrf

            <div>
                <label for="name" class="block text-sm font-medium mb-1">Nama</label>
                <input
                    type="text"
                    id="name"
                    name="name"
                    value="{{ old('name') }}"
                    required
                    class="w-full px-3 py-2 border rounded-lg bg-white dark:bg-[#161615] dark:border-[#3E3E3A] focus:outline-none focus:ring-2 focus:ring-[#f53003]"
                >
            </div>

            <div>
                <label for="email" class="block text-sm font-medium mb-1">Email</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    value="{{ old('email') }}"
                    required
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

            <div>
                <label for="password_confirmation" class="block text-sm font-medium mb-1">Konfirmasi Password</label>
                <input
                    type="password"
                    id="password_confirmation"
                    name="password_confirmation"
                    required
                    class="w-full px-3 py-2 border rounded-lg bg-white dark:bg-[#161615] dark:border-[#3E3E3A] focus:outline-none focus:ring-2 focus:ring-[#f53003]"
                >
            </div>

            <div>
                <label for="role" class="block text-sm font-medium mb-1">Role</label>
                <select
                    id="role"
                    name="role"
                    required
                    class="w-full px-3 py-2 border rounded-lg bg-white dark:bg-[#161615] dark:border-[#3E3E3A] focus:outline-none focus:ring-2 focus:ring-[#f53003]"
                >
                    <option value="user" {{ old('role') === 'user' ? 'selected' : '' }}>User</option>
                    <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>Admin</option>
                </select>
            </div>

            <div class="flex gap-3">
                <button
                    type="submit"
                    class="px-6 py-2 bg-[#f53003] text-white rounded-lg hover:bg-[#d02803] transition-colors"
                >
                    Simpan
                </button>
                <a
                    href="{{ route('admin.users.index') }}"
                    class="px-6 py-2 border rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-[#252520] transition-colors"
                >
                    Batal
                </a>
            </div>
        </form>
    </div>
</x-layouts.app>