<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Bank Sampah Pusat</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100" style="background-image: url('{{ asset('images/bsp3.jpg') }}');">
    <div class="min-h-screen flex items-center justify-center">
        <div class="w-full max-w-md mx-auto bg-white p-8 border border-gray-300 rounded-lg">
            <h2 class="text-2xl font-bold mb-6 text-center">Login Bank Sampah Pusat</h2>
            @if ($errors->any())
                <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('status'))
            <div class="bg-green-500 text-white p-4 rounded mb-4">
                {{ session('status') }}
            </div>
            @endif
            <form method="POST" action="{{ route('pusat.login.submit') }}">
                @csrf
                <div class="mb-4">
                    <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email:</label>
                    <input type="email" name="email" id="email" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('email') }}" required>
                </div>
                <div class="mb-4">
                    <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Password:</label>
                    <input type="password" name="password" id="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                </div>
                <div class="mb-4">
                    <input type="checkbox" name="remember" id="remember" class="mr-2 leading-tight">
                    <label for="remember" class="text-sm text-gray-700">Remember Me</label>
                </div>
                <div class="flex items-center justify-between">
                    <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        Login
                    </button>
                    <a href="{{ route('pusat.password.request') }}" class="text-sm text-green-600 hover:text-green-700">Forgot Your Password?</a>
                </div>
            </form>
            <div class="mt-4 text-center">
                <p class="text-sm text-gray-700">Don't have an account?</p>
                <a href="{{ route('pusat.register') }}" class="text-green-600 hover:text-green-700 font-bold">Register Here</a>
            </div>
        </div>
    </div>
</body>
</html>
