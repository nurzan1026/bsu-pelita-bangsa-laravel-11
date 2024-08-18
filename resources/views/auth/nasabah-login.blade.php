<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>LOGIN BSU</title>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500;600;700&display=swap" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    @vite('resources/css/app.css')
</head>

<body class="font-Quicksand">
    <main class="bg-slate-100 min-h-screen flex items-center justify-center p-6 md:p-0">
        <div class="relative bg-white shadow-lg flex flex-col lg:flex-row rounded-xl overflow-hidden lg:w-2/3 2xl:w-1/2 transition-transform"
            id="auth-container">
            <!-- Login Form -->
            <div class="p-8 lg:w-1/2" id="login-form">
                <div class="relative inline-block mb-4">
                    <button type="button"
                        class="inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-hijau text-white text-sm font-bold hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                        Pilih Opsi Login
                        <svg class="-mr-1 ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                            fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd"
                                d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 011.06 1.06l-4 4a.75.75 0 01-1.06 0l-4-4a.75.75 0 01.02-1.06z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>
                    <div class="origin-top-right absolute left-5 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none hidden group-hover:block"
                        id="dropdown-menu">
                        <div class="py-1">
                            <a href="#"
                                class="block px-4 py-2 text-sm text-gray-900 hover:bg-primary hover:text-white font-semibold">Login
                                Admin</a>
                            <a href="#"
                                class="block px-4 py-2 text-sm text-gray-900 hover:bg-primary hover:text-white font-semibold">Login
                                Pengelola BSU</a>
                        </div>
                    </div>
                </div>
                <h2 class="text-3xl font-bold mt-5 mb-6 text-primary">Login</h2>

                <!-- Pesan Kesalahan -->
                @if ($errors->any())
                    <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative"
                        role="alert">
                        <strong class="font-bold">Ada kesalahan!</strong>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('nasabah.login') }}" method="POST" class="flex flex-col">
                    @csrf
                    <div class="flex flex-col mb-4">
                        <label for="login-email" class="mb-2 text-gray-900 font-semibold">Email</label>
                        <input type="email" id="login-email" name="email" placeholder="Masukkan email anda"
                            class="px-4 py-2 border-2 border-gray-200 rounded-md max-w-full focus:border-hijau focus:outline-none" />
                    </div>
                    <div class="flex flex-col mb-4">
                        <label for="login-password" class="mb-2 text-gray-900 font-semibold">Password</label>
                        <input type="password" id="login-password" name="password" placeholder="Masukkan password anda"
                            class="px-4 py-2 border-2 border-gray-200 rounded-md max-w-full focus:outline-none focus:border-hijau" />
                    </div>
                    <button type="submit"
                        class="my-6 bg-primary hover:bg-hijau text-white font-medium text-lg px-4 py-2 rounded-md">
                        Login
                    </button>
                </form>
                <p class="text-gray-700 font-bold">
                    Belum memiliki akun?
                    <a href="{{ route('nasabah.register') }}" class="text-blue-500 font-bold underline">Registrasi</a>
                </p>
                <p class="text-gray-700 font-bold">
                    Lupa password?
                    <a href="{{ route('password.change') }}" class="text-blue-500 font-bold underline">Reset
                        password</a>
                </p>
            </div>
            <!-- Image -->
            <div class="hidden lg:block lg:w-1/2 transition-transform transform" id="login-image">
                <img src="{{ asset('img/3R-Logo.jpeg') }}" alt="Placeholder Image" class="h-full w-full object-cover" />
            </div>
        </div>
    </main>
    <script>
        // Script untuk toggle dropdown
        document.querySelector('.inline-flex').addEventListener('click', function() {
            document.getElementById('dropdown-menu').classList.toggle('hidden');
        });
    </script>
</body>

</html>
