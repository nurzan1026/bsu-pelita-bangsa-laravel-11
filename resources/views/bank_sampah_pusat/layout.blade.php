<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Bank Sampah Pusat</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var links = document.querySelectorAll('.sidebar-link');
            var currentUrl = window.location.href;

            links.forEach(function (link) {
                if (link.href === currentUrl) {
                    link.classList.add('bg-green-800', 'text-white');
                }

                link.addEventListener('click', function () {
                    links.forEach(function (link) {
                        link.classList.remove('bg-green-800', 'text-white');
                    });
                    link.classList.add('bg-green-800', 'text-white');
                });
            });
        });
    </script>
</head>
<body class="bg-gray-100 h-screen flex">
    <!-- Sidebar -->
    <div class="w-64 bg-white h-full shadow-lg flex flex-col">
        <div class="bg-green-700 p-4 text-center">
            <div class="text-white text-2xl font-bold">UPTD Bank Sampah Makassar</div>
        </div>
        <nav class="flex-1 px-4 space-y-4 mt-4">
            <a href="{{ route('pusat.dashboard') }}" class="sidebar-link text-black flex items-center p-2 rounded-lg hover:bg-green-800 transition">
                <i class="fas fa-home mr-3"></i>Dashboard
            </a>
            <a href="/pusat/permintaan_pengangkutan" class="sidebar-link text-black flex items-center p-2 rounded-lg hover:bg-green-800 transition">
                <i class="fas fa-list-alt mr-3"></i>Daftar Permintaan
            </a>
            <a href="/pusat/laporan" class="sidebar-link text-black flex items-center p-2 rounded-lg hover:bg-green-800 transition">
                <i class="fas fa-file-alt mr-3"></i>Laporan
            </a>
            <a href="/pusat/jadwal_pengangkutan" class="sidebar-link text-black flex items-center p-2 rounded-lg hover:bg-green-800 transition">
                <i class="fas fa-calendar-alt mr-3"></i>Jadwal
            </a>
            <a href="/pusat/riwayat_pengambilan" class="sidebar-link text-black flex items-center p-2 rounded-lg hover:bg-green-800 transition">
                <i class="fas fa-history mr-3"></i>Riwayat Pengambilan Sampah
            </a>
        </nav>
        <div class="px-4 mb-4">
            <form method="POST" action="{{ route('pusat.logout') }}">
                @csrf
                <button type="submit" class="w-full bg-red-600 text-white p-2 rounded-lg hover:bg-red-700 transition">
                    <i class="fas fa-sign-out-alt mr-3"></i>Logout
                </button>
            </form>
        </div>
    </div>
    <!-- Main Content -->
    <div class="flex-1 p-4 overflow-auto">
        @yield('content')
    </div>
</body>
</html>
