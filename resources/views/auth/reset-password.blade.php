<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>PASSWORD BARU</title>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500;600;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn-uicons.flaticon.com/uicons-regular-rounded/css/uicons-regular-rounded.css" />
    @vite('resources/css/app.css')
</head>

<body class="flex items-center justify-center min-h-screen bg-gray-100 font-Quicksand">
    <div class="p-4 sm:p-8 w-full max-w-md bg-white shadow-lg rounded-xl overflow-hidden m-5 sm:m-0">
        <h2 class="text-2xl sm:text-3xl font-bold mt-4 sm:mt-8 mb-4 sm:mb-6 text-primary text-center">
            Buat Password Baru
        </h2>
        <form action="{{ route('password.update') }}" method="POST" class="flex flex-col">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
            <div class="flex flex-col mb-4 relative">
                <i class="fi fi-rr-lock absolute top-4 right-4 text-zinc-400"></i>
                <label for="new-password" class="mb-2 text-gray-900">Buat Password</label>
                <input type="password" id="new-password" name="password" placeholder="Masukkan password baru anda"
                    class="px-4 py-2 border-2 border-slate-300 rounded-md w-full focus:border-hijau focus:outline-none"
                    required />
            </div>
            <div class="flex flex-col mb-4 relative">
                <i class="fi fi-rr-lock absolute top-4 right-4 text-zinc-400"></i>
                <label for="confirm-password" class="mb-2 text-gray-900">Konfimasi Password</label>
                <input type="password" id="confirm-password" name="password_confirmation"
                    placeholder="Masukkan ulang password anda"
                    class="px-4 py-2 border-2 border-slate-300 rounded-md w-full focus:border-hijau focus:outline-none"
                    required />
            </div>
            <button type="submit"
                class="my-4 sm:my-6 bg-primary hover:bg-hijau text-white font-medium text-lg px-4 py-2 rounded-md mx-auto">
                Save New Password
            </button>
        </form>
        <p class="text-gray-900 text-center">
            Back to
            <a href="{{ route('login') }}" class="text-blue-500 font-bold underline">Login</a>
        </p>
    </div>
</body>

</html>
