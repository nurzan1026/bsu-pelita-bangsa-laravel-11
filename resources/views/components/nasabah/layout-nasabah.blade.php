<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>NASABAH</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500;600;700&display=swap" rel="stylesheet" />
    {{-- icon aksi read, delete, edit --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 font-Quicksand leading-normal tracking-normal">
    <!-- Sidebar -->
    <x-nasabah.aside-nasabah></x-nasabah.aside-nasabah>

    <!-- Main Content -->
    <div id="mainContent" class="main-content flex-1 flex flex-col overflow-hidden ml-[16rem]">
        <!-- Header -->
        <x-nasabah.navbar-nasabah></x-nasabah.navbar-nasabah>
        <!-- Content -->
        <main class="flex-1 overflow-y-auto p-6 mt-20">
            @yield('content')
        </main>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const sidebar = document.getElementById("sidebar");
            const mainContent = document.getElementById("mainContent");
            const hamburgerButton = document.getElementById("hamburgerButton");

            hamburgerButton.addEventListener("click", () => {
                sidebar.classList.toggle("collapsed");
                mainContent.classList.toggle("sidebar-collapsed");
            });
        });
        document.addEventListener('DOMContentLoaded', function() {
            const adminButton = document.getElementById('adminButton');
            const adminDropdown = document.getElementById('adminDropdown');

            adminButton.addEventListener('click', function() {
                adminDropdown.classList.toggle('hidden');
            });

            // Optional: Hide the dropdown when clicking outside of it
            document.addEventListener('click', function(event) {
                if (!adminButton.contains(event.target) && !adminDropdown.contains(event.target)) {
                    adminDropdown.classList.add('hidden');
                }
            });
        });
    </script>
</body>

</html>
