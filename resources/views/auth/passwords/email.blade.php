<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Lupa Password</title>
    @vite('resources/css/app.css')
</head>

<body class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="p-4 sm:p-8 w-full max-w-md bg-white shadow-lg rounded-xl overflow-hidden m-5 sm:m-0">
        <h2 class="text-2xl sm:text-3xl font-bold mt-4 sm:mt-8 mb-4 sm:mb-6 text-primary text-center">
            Lupa Password
        </h2>
        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif
        <form action="{{ route('password.email') }}" method="POST" class="flex flex-col">
            @csrf
            <div class="flex flex-col mb-4">
                <label for="forgot-password-email" class="mb-2 text-gray-900">Email</label>
                <input type="email" id="forgot-password-email" name="email" placeholder="Masukkan email anda"
                    class="px-4 py-2 border-2 border-slate-300 rounded-md w-full focus:border-hijau focus:outline-none"
                    required />
            </div>
            <button type="submit"
                class="my-4 sm:my-6 bg-primary hover:bg-hijau text-white font-medium text-lg px-4 py-2 rounded-md mx-auto">
                Reset Password
            </button>
        </form>
        <p class="text-gray-900 text-center">
            Ingat password Anda?
            <a href="{{ route('nasabah.login') }}" class="text-blue-500 font-bold underline">
                Kembali ke Login
            </a>
        </p>
    </div>
</body>

</html>
