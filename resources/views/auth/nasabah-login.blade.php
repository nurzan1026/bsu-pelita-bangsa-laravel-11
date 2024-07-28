<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>LOGIN BSU</title>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500;600;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn-uicons.flaticon.com/uicons-regular-rounded/css/uicons-regular-rounded.css" />
    @vite('resources/css/app.css')
</head>

<body class="font-Quicksand">
    <main class="bg-slate-100 min-h-screen flex items-center justify-center p-6 md:p-0">
        <div class="relative bg-white shadow-lg flex flex-col lg:flex-row rounded-xl overflow-hidden lg:w-2/3 2xl:w-1/2 transition-transform"
            id="auth-container">
            <!-- Login Form -->
            <div class="p-8 lg:w-1/2" id="login-form">
                <h1 class="font-bold text-gray-700 text-2xl md:text-3xl">
                    Form login Nasabah bank sampah pelita bangsa
                </h1>
                <h2 class="text-3xl font-bold mt-8 mb-6 text-primary">Login</h2>
                <form action="{{ route('nasabah.login') }}" method="POST" class="flex flex-col">
                    @csrf
                    <div class="flex flex-col mb-4 relative">
                        <i class="fi fi-rr-envelope absolute top-11 right-5 text-zinc-400"></i>
                        <label for="login-email" class="mb-2 text-gray-900">Email</label>
                        <input type="email" id="login-email" name="email" placeholder="Masukkan email anda"
                            class="px-4 py-2 border-2 border-slate-300 rounded-md max-w-full focus:border-hijau focus:outline-none" />
                    </div>
                    <div class="flex flex-col relative">
                        <i class="fi fi-rr-lock absolute top-11 right-5 text-gray-400"></i>
                        <label for="login-password" class="mb-2 text-gray-900">Password</label>
                        <input type="password" id="login-password" name="password" placeholder="Masukkan password anda"
                            class="px-4 py-2 border-2 border-slate-300 rounded-md max-w-full focus:outline-none focus:border-hijau" />
                    </div>
                    <button type="submit"
                        class="my-6 bg-primary hover:bg-hijau text-white font-medium text-lg px-4 py-2 rounded-md">
                        Login
                    </button>
                </form>
                <p class="text-gray-900">
                    Belum memiliki akun?
                    <a href="{{ route('nasabah.register') }}" class="text-blue-500 font-bold underline">Register</a>
                </p>
                <p class="text-gray-900">
                    Lupa password?
                    <a href="{{ route('password.request') }}" class="text-blue-500 font-bold underline">Reset
                        password</a>
                </p>
            </div>
            <!-- Image -->
            <div class="hidden lg:block lg:w-1/2 transition-transform transform" id="login-image">
                <img src="{{ asset('img/logo-bsu.jpg') }}" alt="Placeholder Image" class="h-full w-full object-cover" />
            </div>
        </div>
    </main>
</body>

</html>
