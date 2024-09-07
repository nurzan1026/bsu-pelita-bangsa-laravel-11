<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - Bank Sampah Pusat</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="container mx-auto mt-12">
        <div class="w-full max-w-md mx-auto bg-white p-8 border border-gray-300 rounded-lg">
            <h2 class="text-2xl font-bold mb-6 text-center">Reset Password</h2>
            @if (session('status'))
                <div class="bg-green-100 text-green-700 p-4 rounded mb-4">
                    {{ session('status') }}
                </div>
            @endif
            <form method="POST" action="{{ route('pusat.password.email') }}">
                @csrf
                <div class="mb-4">
                    <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email:</label>
                    <input type="email" name="email" id="email" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('email') }}" required>
                </div>
                <div class="flex items-center justify-between">
                    <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        Send Password Reset Link
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
