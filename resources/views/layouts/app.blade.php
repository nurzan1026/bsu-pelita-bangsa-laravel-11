<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Bank Sampah Unit') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<style>
    body {
    background-image: url('{{ asset('images/bg.jpg') }}');
    font-family: 'Nunito', sans-serif;
    background-color: #f7fafc;
}

.container {
    max-width: 400px;
    margin: 0 auto;
    padding: 20px;
}

h2 {
    color: #2d3748;
}

button {
    background-color: #38a169;
    color: #fff;
}

button:hover {
    background-color: #2f855a;
}

</style>
<body class="bg-gray-100">
    <div class="min-h-screen flex items-center justify-center">
        @yield('content')
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
