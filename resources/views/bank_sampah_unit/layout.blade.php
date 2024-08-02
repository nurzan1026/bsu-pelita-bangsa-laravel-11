<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bank Sampah Unit</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('node_modules/@fortawesome/fontawesome-free/css/all.min.css') }}">
    <script src="https://kit.fontawesome.com/d9247fd719.js" crossorigin="anonymous"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<style>
    .navbar,
    .sidebar-header {
        height: 64px;
    }

    .search-input {
        padding-left: 2.5rem;
    }

    .search-icon {
        left: 0.75rem;
        top: 0.75rem;
    }

    .dropdown-menu {
        display: none;
        position: absolute;
        right: 0;
        background-color: white;
        min-width: 160px;
        box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
        z-index: 1;
    }

    .dropdown-menu.show {
        display: block;
    }

    .dropdown-menu a {
        color: black;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
    }

    .dropdown-menu a:hover {
        background-color: #f1f1f1;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 1rem;
    }

    th,
    td {
        padding: 1rem;
        border: 1px solid #ddd;
        text-align: left;
    }

    th {
        background-color: #f2f2f2;
        font-weight: bold;
    }

    tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    tr:hover {
        background-color: #f1f1f1;
    }

    .table-header {
        background-color: #4CAF50;
        color: white;
    }

    .table-row:hover {
        background-color: #e0f7fa;
    }
</style>

<body class="bg-gray-100">
    @include('bank_sampah_unit.sidebar')
    <div class="flex-1 ml-64 flex flex-col">
        <!-- Navbar -->
        <nav class="navbar bg-green-700 p-4 flex items-center justify-between">
            <div class="relative w-1/3">
                <input type="text" class="search-input w-full p-2 rounded-lg" placeholder="Search...">
                <i class="fas fa-search absolute search-icon text-gray-500"></i>
            </div>
            {{-- @if (Auth::guard('bank_sampah_unit')->check())
                <div class="relative">
                    <button id="dropdown-toggle" class="flex items-center focus:outline-none">
                        <img src="https://via.placeholder.com/40" alt="Profile Picture" class="rounded-full mr-2">
                        <div class="text-left">
                            <div class="font-bold text-white">{{ Auth::guard('bank_sampah_unit')->user()->name }}</div>
                        </div>
                    </button>
                    <div id="dropdown-menu"
                        class="dropdown-menu absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg z-10">
                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-green-100">Setting</a>
                        <a href="{{ route('unit.logout') }}"
                            onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-green-100">
                            Logout
                        </a>
                        <form id="logout-form" action="{{ route('unit.logout') }}" method="POST"
                            style="display: none;">
                            @csrf
                        </form>
                    </div>
                </div>
            @endif --}}
        </nav>
        <!-- Content -->
        <div class="p-6">
            @yield('content')
        </div>
    </div>
    </div>

    @yield('modals')

    @yield('scripts')

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var dropdownToggle = document.getElementById('dropdown-toggle');
            var dropdownMenu = document.getElementById('dropdown-menu');

            dropdownToggle.addEventListener('click', function(event) {
                event.stopPropagation();
                dropdownMenu.classList.toggle('show');
            });

            window.addEventListener('click', function() {
                if (dropdownMenu.classList.contains('show')) {
                    dropdownMenu.classList.remove('show');
                }
            });

            dropdownMenu.addEventListener('click', function(event) {
                event.stopPropagation();
            });
        });
    </script>
</body>

</html>
