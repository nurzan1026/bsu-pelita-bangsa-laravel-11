<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>REGISTER NASABAH</title>
    <script src="https://cdn.tailwindcss.com"></script>
    @vite('resources/css/app.css')
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500;600;700&display=swap" rel="stylesheet" />
</head>

<body class="font-Quicksand">
    <main class="bg-slate-100 min-h-screen flex items-center justify-center p-4">
        <div class="relative bg-white shadow-xl flex flex-col lg:flex-row rounded-xl overflow-hidden lg:w-3/5 2xl:w-1/3 transition-transform"
            id="auth-container">
            <!-- Image -->
            <div class="hidden lg:block lg:w-1/2 transition-transform transform" id="register-image">
                <img src="{{ asset('img/3R-Logo.jpeg') }}" alt="Placeholder Image" class="h-full w-full object-cover" />
            </div>
            <!-- Register Form -->
            <div class="p-6 lg:w-1/2" id="register-form">
                <h1 class="font-bold text-gray-800 text-xl md:text-2xl">
                    Form Registrasi Nasabah
                </h1>
                <h2 class="text-2xl font-bold mt-4 mb-4 text-primary">Registrasi</h2>
                <form action="{{ route('nasabah.register') }}" method="POST" class="flex flex-col">
                    @csrf
                    <div class="flex flex-col mb-3">
                        <label for="register-nama" class="mb-1 text-gray-900 text-sm font-semibold">Nama</label>
                        <input type="text" id="register-nama" name="nama" placeholder="Masukkan nama Anda"
                            class="px-3 py-2 border border-slate-500 rounded-md max-w-full focus:border-hijau focus:outline-none text-sm" />
                        @if ($errors->has('nama'))
                            <span class="text-red-500 text-sm mt-1">{{ $errors->first('nama') }}</span>
                        @endif
                    </div>
                    <div class="flex flex-col mb-3">
                        <label for="register-nomor_induk" class="mb-1 text-gray-900 text-sm font-semibold">Nomor
                            Induk</label>
                        <input type="text" id="register-nomor_induk" name="nomor_induk"
                            placeholder="Masukkan nomor induk Anda"
                            class="px-3 py-2 border border-slate-500 rounded-md max-w-full focus:border-hijau focus:outline-none text-sm" />
                        @if ($errors->has('nomor_induk'))
                            <span class="text-red-500 text-sm mt-1">{{ $errors->first('nomor_induk') }}</span>
                        @endif
                    </div>
                    <div class="flex flex-col mb-3">
                        <label for="register-username" class="mb-1 text-gray-900 text-sm font-semibold">Username</label>
                        <input type="text" id="register-username" name="username"
                            placeholder="Masukkan username Anda"
                            class="px-3 py-2 border border-slate-500 rounded-md max-w-full focus:border-hijau focus:outline-none text-sm" />
                        @if ($errors->has('username'))
                            <span class="text-red-500 text-sm mt-1">{{ $errors->first('username') }}</span>
                        @endif
                    </div>
                    <div class="flex flex-col mb-3">
                        <label for="register-email" class="mb-1 text-gray-900 text-sm font-semibold">Email</label>
                        <input type="email" id="register-email" name="email" placeholder="Masukkan email Anda"
                            class="px-3 py-2 border border-slate-500 rounded-md max-w-full focus:border-hijau focus:outline-none text-sm" />
                        @if ($errors->has('email'))
                            <span class="text-red-500 text-sm mt-1">{{ $errors->first('email') }}</span>
                        @endif
                    </div>
                    <div class="flex flex-col mb-3">
                        <label for="register-password" class="mb-1 text-gray-900 text-sm font-semibold">Password</label>
                        <input type="password" id="register-password" name="password" placeholder="Buat password Anda"
                            class="px-3 py-2 border border-slate-500 rounded-md max-w-full focus:outline-none focus:border-hijau text-sm" />
                        @if ($errors->has('password'))
                            <span class="text-red-500 text-sm mt-1">{{ $errors->first('password') }}</span>
                        @endif
                    </div>
                    <div class="flex flex-col mb-3">
                        <label for="register-confirm-password"
                            class="mb-1 text-gray-900 text-sm font-semibold">Konfirmasi Password</label>
                        <input type="password" id="register-confirm-password" name="password_confirmation"
                            placeholder="Masukkan ulang password Anda"
                            class="px-3 py-2 border border-slate-500 rounded-md max-w-full focus:outline-none focus:border-hijau text-sm" />
                        @if ($errors->has('password_confirmation'))
                            <span class="text-red-500 text-sm mt-1">{{ $errors->first('password_confirmation') }}</span>
                        @endif
                    </div>
                    <div class="flex flex-col mb-3">
                        <label for="register-alamat" class="mb-1 text-gray-900 text-sm font-semibold">Alamat</label>
                        <input type="text" id="register-alamat" name="alamat" placeholder="Masukkan alamat Anda"
                            class="px-3 py-2 border border-slate-500 rounded-md max-w-full focus:border-hijau focus:outline-none text-sm" />
                        @if ($errors->has('alamat'))
                            <span class="text-red-500 text-sm mt-1">{{ $errors->first('alamat') }}</span>
                        @endif
                    </div>
                    <button type="submit"
                        class="my-3 bg-primary hover:bg-hijau text-white font-medium text-base px-3 py-2 rounded-md">
                        Registrasi
                    </button>
                </form>

                <p class="text-gray-900 text-base font-bold">
                    Sudah memiliki akun?
                    <a href="{{ route('nasabah.login') }}" class="text-blue-500 font-bold underline">Login</a>
                </p>
            </div>
        </div>
    </main>
</body>

</html>
