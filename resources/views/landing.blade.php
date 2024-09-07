<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bank Sampah Pusat Kota Makassar</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="crossorigin=""/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Istok+Web:wght@400;700&display=swap">
    <script src="https://kit.fontawesome.com/d9247fd719.js" crossorigin="anonymous"></script>
     <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="crossorigin=""></script>
</head>



</head>
<body>
<!-- Header Section with Navigation Bar -->
<header class="text-center bg-green-800 bg-opacity-75 text-white header-section rounded-b-lg shadow-md fade-in bg-cover-custom" style="background-image: url('{{ asset('images/bg.jpg') }}');">
    <nav class="bg-green-800 bg-opacity-75 text-white p-4 shadow-md fixed w-full z-10 top-0 left-0">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-2xl font-bold">Bank Sampah Pusat Makassar</h1>
            <div class="hidden md:flex">
                <a href="#about" class="mx-2 p-2 hover:bg-green-700 rounded transition duration-300"><i class="fas fa-info-circle"></i> About</a>
                <a href="#features" class="mx-2 p-2 hover:bg-green-700 rounded transition duration-300"><i class="fas fa-cogs"></i> Features</a>
                <a href="#contact" class="mx-2 p-2 hover:bg-green-700 rounded transition duration-300"><i class="fas fa-envelope"></i> Contact</a>
                <a href="{{ route('pusat.login') }}" class="mx-2 p-2 bg-green-600 hover:bg-green-700 rounded transition duration-300 open-modal"><i class="fas fa-sign-in-alt"></i> Login</a>
            </div>
        </div>
    </nav>
    <div class="container mx-auto mt-16">
        <h1 class="text-4xl font-bold">Selamat Datang di Bank Sampah Pusat Makassar</h1>
        <p class="text-xl mt-4">Sistem Informalasan Sampah Terpadu untuk Kota Makassar yang Bersih dan Hijau</p>
        <div class="mt-8">
            <a href="#get-started" class="bg-green-600 hover:bg-green-700 text-white py-2 px-4 rounded-lg transition duration-300 open-modal"><i class="fas fa-play-circle"></i> Get Started</a>
        </div>
    </div>
</header>

<!-- About Section -->
<section id="about" class="my-16 p-8 bg-white bg-opacity-90 rounded-lg shadow-md fade-in">
    <div class="container mx-auto">
        <h2 class="text-3xl font-bold mb-6 text-center"><i class="fas fa-info-circle"></i> Tentang Kami</h2>
        <p class="text-lg text-center mb-8">
            Bank Sampah Pusat Kota Makassar adalah inisiatif yang berfokus pada pengelolaan sampah dengan cara yang berkelanjutan dan ramah lingkungan. Kami menyediakan layanan pengumpulan, pemilahan, dan daur ulang sampah untuk masyarakat Makassar.
        </p>
    </div>
</section>

<!-- Features Section -->
<section id="features" class="my-16 p-8 bg-white bg-opacity-90 rounded-lg shadow-md fade-in">
    <div class="container mx-auto">
        <h2 class="text-3xl font-bold mb-6 text-center"><i class="fas fa-cogs"></i> Fitur Kami</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 text-center">
            <div class="feature-box">
                <div class="feature-icon"><i class="fas fa-truck"></i></div>
                <h3 class="text-2xl font-bold mb-4">Pengumpulan Sampah</h3>
                <p>Kami menyediakan layanan pengumpulan sampah dari rumah-rumah warga untuk memastikan lingkungan tetap bersih.</p>
            </div>
            <div class="feature-box">
                <div class="feature-icon"><i class="fas fa-recycle"></i></div>
                <h3 class="text-2xl font-bold mb-4">Pemilahan Sampah</h3>
                <p>Sampah yang dikumpulkan dipilah sesuai dengan jenisnya untuk memudahkan proses daur ulang.</p>
            </div>
            <div class="feature-box">
                <div class="feature-icon"><i class="fas fa-calendar-alt"></i></div>
                <h3 class="text-2xl font-bold mb-4">Penjadwalan</h3>
                <p>Kami menyediakan fitur penjadwalan pengumpulan sampah untuk memudahkan koordinasi dengan warga.</p>
            </div>
            <div class="feature-box">
                <div class="feature-icon"><i class="fas fa-leaf"></i></div>
                <h3 class="text-2xl font-bold mb-4">Daur Ulang</h3>
                <p>Kami mengolah sampah yang dapat didaur ulang menjadi produk yang berguna dan ramah lingkungan.</p>
            </div>
        </div>
    </div>
</section>

<!-- Partners Section -->
<section id="partners" class="my-16 p-8 bg-white bg-opacity-90 rounded-lg shadow-md fade-in">
    <div class="container mx-auto">
        <h2 class="text-3xl font-bold mb-6 text-center"><i class="fas fa-handshake"></i> Partner Kami</h2>
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8 text-center">
            <div class="p-8">
                <img src="{{ asset('images/partner1.png') }}" alt="Partner 1" class="partner-logo">
                <p class="text-lg">RETRON.id</p>
            </div>
            <div class="p-8">
                <img src="{{ asset('images/partner2.png') }}" alt="Partner 2" class="partner-logo">
                <p class="text-lg">DLH Makassar</p>
            </div>
            <div class="p-8">
                <img src="{{ asset('images/partner3.png') }}" alt="Partner 3" class="partner-logo">
                <p class="text-lg">Partner 3</p>
            </div>
            <div class="p-8">
                <img src="{{ asset('images/partner4.png') }}" alt="Partner 4" class="partner-logo">
                <p class="text-lg">Partner 4</p>
            </div>
        </div>
    </div>
</section>

<!-- Map Section -->
<section id="map-section" class="my-16 p-8 bg-white bg-opacity-90 rounded-lg shadow-md fade-in">
    <div class="container mx-auto">
        <h2 class="text-3xl font-bold mb-6 text-center"><i class="fas fa-map-marker-alt"></i> Lokasi Kami</h2>
        <div id="map" class="rounded-lg shadow-md"></div>
    </div>
</section>

<!-- Contact Section -->
<section id="contact" class="my-16 p-8 bg-white bg-opacity-90 rounded-lg shadow-md fade-in">
    <div class="container mx-auto">
        <h2 class="text-3xl font-bold mb-6 text-center"><i class="fas fa-envelope"></i> Kontak Kami</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="bg-green-300 p-8 rounded-lg shadow-md">
                <h3 class="text-2xl font-bold"><i class="fas fa-map-marker-alt"></i> Lokasi Kami</h3>
                <p>Jalan Contoh No. 123, Kota Makassar, Sulawesi Selatan</p>
            </div>
            <div class="bg-green-300 p-8 rounded-lg shadow-md">
                <h3 class="text-2xl font-bold"><i class="fas fa-phone-alt"></i> Kontak Kami</h3>
                <p>Email: info@banksampahmakassar.com</p>
                <p>Telepon: (0411) 123-4567</p>
            </div>
        </div>
    </div>
</section>

<!-- Footer Section -->
<footer class="text-center bg-green-800 bg-opacity-75 text-white p-4 rounded-t-lg shadow-md">
    <p>&copy; 2024 Bank Sampah Makassar. All rights reserved.</p>
</footer>

{{-- <!-- Modal Login -->
<div id="loginModal" class="modal {{ session('login_error') ? 'modal-active' : '' }}">
    <div class="modal-content bg-white p-6 rounded-lg shadow-lg relative">
        <div class="login-header flex justify-between items-center mb-4">
            <h2 class="text-2xl font-bold">Login</h2>
            <span id="closeLoginModal" class="close">&times;</span>
        </div>
        <div id="loginError" class="alert {{ session('login_error') ? '' : 'hidden' }} bg-red-100 text-red-700 p-4 rounded mb-4">
            {{ session('login_error') }}
        </div>
        <form id="loginForm" method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-4">
                <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email:</label>
                <input type="email" name="email" id="email" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('email') }}">
                @error('email')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-4">
                <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Password:</label>
                <input type="password" name="password" id="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                @error('password')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="flex items-center justify-between">
                <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Login
                </button>
            </div>
        </form>
        <div class="login-footer mt-4">
            <a href="#" class="open-reset-modal">Lupa kata sandi?</a>
        </div>
    </div>
</div> --}}

{{-- <!-- Modal Reset Password -->
<div id="resetModal" class="modal">
    <div class="modal-content">
        <div class="login-header">
            Reset Kata Sandi
            <span class="close">&times;</span>
        </div>
        <div class="container mx-auto mt-16">
        <div class="w-full max-w-md mx-auto bg-white p-8 border border-gray-300 rounded-lg">
            @if (session('status'))
                <div class="bg-green-100 text-green-700 p-4 rounded mb-4">
                    {{ session('status') }}
                </div>
            @endif
            <form method="POST" action="{{ route('password.email') }}">
                @csrf
                <div class="mb-4">
                    <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email Address:</label>
                    <input type="email" name="email" id="email" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required autofocus>
                    @error('email')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div class="flex items-center justify-between">
                    <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        Send Password Reset Link
                    </button>
                </div>
            </form>
        </div>
    </div>
    </div>
</div> --}}

<div class="modal-backdrop"></div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const modal = document.getElementById("loginModal");
        const resetModal = document.getElementById("resetModal");
        const openModalButtons = document.querySelectorAll(".open-modal");
        const closeModalButtons = document.querySelectorAll(".close");
        const openResetModalButton = document.querySelector(".open-reset-modal");
        const modalBackdrop = document.querySelector(".modal-backdrop");

        openModalButtons.forEach(button => {
            button.addEventListener("click", function () {
                modal.style.display = "flex";
                modalBackdrop.style.display = "block";
            });
        });

        openResetModalButton.addEventListener("click", function () {
            modal.style.display = "none";
            resetModal.style.display = "flex";
        });

        closeModalButtons.forEach(button => {
            button.addEventListener("click", function () {
                modal.style.display = "none";
                resetModal.style.display = "none";
                modalBackdrop.style.display = "none";
            });
        });

        window.addEventListener("click", function (event) {
            if (event.target == modal || event.target == resetModal) {
                modal.style.display = "none";
                resetModal.style.display = "none";
                modalBackdrop.style.display = "none";
            }
        });
    });

    document.addEventListener('DOMContentLoaded', (event) => {
            // Initialize the map
            var map = L.map('map').setView([-5.1616650,119.4503395], 18); // Use the coordinates of the Bank Sampah Pusat Kota Makassar

            // Set up the OpenStreetMap layer
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            // Add a marker for Bank Sampah Pusat Kota Makassar
            L.marker([-5.1616650,119.4503395]).addTo(map)
                .bindPopup('<b>Bank Sampah Pusat Kota Makassar</b><br>Jalan Contoh No. 123, Kota Makassar, Sulawesi Selatan')
                .openPopup();
        });

        document.getElementById('openLoginModal').addEventListener('click', function() {
            document.getElementById('loginModal').classList.add('modal-active');
        });

        document.getElementById('closeLoginModal').addEventListener('click', function() {
            document.getElementById('loginModal').classList.remove('modal-active');
            document.getElementById('loginError').classList.add('hidden');
        });

        // Display error message if there is any
        @if(session('login_error'))
            document.getElementById('loginModal').classList.add('modal-active');
            document.getElementById('loginError').classList.remove('hidden');
        @endif
</script>
</body>
</html>
