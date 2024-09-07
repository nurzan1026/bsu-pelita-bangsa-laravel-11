<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bank Sampah Unit</title>
    <link rel="stylesheet" href="{{ asset('node_modules/@fortawesome/fontawesome-free/css/all.min.css') }}">
    <script src="https://kit.fontawesome.com/d9247fd719.js" crossorigin="anonymous"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<style>
    .navbar,
    .sidebar-header {
        height: 64px;
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

    .overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 256px;
        right: 0;
        bottom: 0;
        z-index: 20;
    }

    .overlay.show {
        display: block;
    }

    .ml-64 {
        margin-left: 256px;
    }
</style>

<body class="bg-gray-100 flex  flex-col md:flex-row">
    @include('bank_sampah_unit.sidebar')

    <div class="overlay" id="overlay"></div>

    <div class="flex-1 flex flex-col md:ml-64">
        <nav class="navbar bg-green-700 p-4 fixed w-full">
            <div class="md:hidden menu-toggle-btn fixed">
                <button id="menu-toggle" class="text-white focus:outline-none">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
            @if (Auth::guard('bank_sampah_unit')->check())
                <div class="w-full flex justify-end md:pr-[260px]">
                    <div class="relative">
                        <button id="dropdown-toggle" class="flex items-center focus:outline-none">
                            <img src="https://via.placeholder.com/40" alt="Profile Picture" class="rounded-full mr-2">
                            <div class="text-left">
                                <div class="font-bold text-white">{{ Auth::guard('bank_sampah_unit')->user()->name }}
                                </div>
                            </div>
                        </button>
                        <div id="dropdown-menu"
                            class="dropdown-menu absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg z-10">
                            <a href="#"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-green-100">Setting</a>
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
                </div>
            @endif
        </nav>
        <div class="p-6">
            @yield('content')
        </div>
    </div>

    @yield('modals')

    @yield('scripts')

    <script>
        document.getElementById('menu-toggle').addEventListener('click', function() {
            var sidebar = document.querySelector('.w-64');
            var overlay = document.getElementById('overlay');
            var menuToggle = document.getElementById('menu-toggle');

            sidebar.classList.toggle('hidden');
            overlay.classList.toggle('show');

            if (sidebar.classList.contains('hidden')) {
                menuToggle.classList.remove('ml-64');
            } else {
                menuToggle.classList.add('ml-64');
            }
        });

        document.getElementById('overlay').addEventListener('click', function() {
            var sidebar = document.querySelector('.w-64');
            var overlay = document.getElementById('overlay');
            var menuToggle = document.getElementById('menu-toggle');

            sidebar.classList.add('hidden');
            overlay.classList.remove('show');
            menuToggle.classList.remove('ml-64');
        });

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
