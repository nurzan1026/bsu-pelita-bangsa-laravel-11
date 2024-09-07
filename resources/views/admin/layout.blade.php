<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/d9247fd719.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/2.8.2/alpine.js" defer></script>
</head>
<body class="bg-gray-100">
    <div x-data="{ open: false }" class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <div :class="open ? 'translate-x-0' : '-translate-x-full'" class="fixed inset-y-0 left-0 w-64 bg-white text-black transform transition-transform duration-300 ease-in-out md:relative md:translate-x-0">
            <div class="flex items-center justify-between p-4 bg-green-500">
                <h1 class="text-2xl font-bold text-white">Halaman Admin </h1>
                <button @click="open = !open" class="text-white md:hidden">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <ul class="mt-8 space-y-2">
                <li><a href="{{ route('admin.dashboard') }}" class="block py-2 px-4 rounded {{ request()->routeIs('admin.dashboard') ? 'bg-green-500 text-white' : 'hover:bg-green-500' }}">
                    <i class="fas fa-tachometer-alt mr-2"></i>
                    Dashboard
                </a></li>
                <li><a href="{{ route('admin.data_sampah') }}" class="block py-2 px-4 rounded {{ request()->routeIs('admin.data_sampah') ? 'bg-green-500 text-white' : 'hover:bg-green-500' }}">
                    <i class="fas fa-trash-alt mr-2"></i>
                    Data Sampah
                </a></li>
                <li><a href="{{ route('admin.daftar_harga_sampah_pusat') }}" class="block py-2 px-4 rounded {{ request()->routeIs('admin.daftar_harga_sampah_pusat') ? 'bg-green-500 text-white' : 'hover:bg-green-500' }}">
                    <i class="fas fa-tags mr-2"></i>
                    Daftar Harga BSP
                </a></li>
                <li><a href="{{ route('admin.daftar_harga_sampah_unit') }}" class="block py-2 px-4 rounded {{ request()->routeIs('admin.daftar_harga_sampah_unit') ? 'bg-green-500 text-white' : 'hover:bg-green-500' }}">
                    <i class="fas fa-tags mr-2"></i>
                    Daftar Harga BSU
                </a></li>
                <li><a href="{{ route('admin.daftar_akun.bank_sampah_unit') }}" class="block py-2 px-4 rounded {{ request()->routeIs('admin.daftar_akun.bank_sampah_unit') ? 'bg-green-500 text-white' : 'hover:bg-green-500' }}">
                    <i class="fas fa-users mr-2"></i>
                    Akun Bank Sampah Unit
                </a></li>
                <li><a href="{{ route('admin.daftar_akun.nasabah') }}" class="block py-2 px-4 rounded {{ request()->routeIs('admin.daftar_akun.nasabah') ? 'bg-green-500 text-white' : 'hover:bg-green-500' }}">
                    <i class="fas fa-user-friends mr-2"></i>
                    Akun Nasabah
                </a></li>
            </ul>
        </div>
        <!-- Main Content -->
        <div class="flex-1 flex flex-col">
            <!-- Toggle Button -->
            <header class="flex items-center justify-between bg-white shadow p-4 md:hidden">
                <button @click="open = !open" class="text-green-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
                <h1 class="text-xl  font-bold text-white">Admin Dashboard</h1>
            </header>
            <main class="flex-1 p-6">
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>
