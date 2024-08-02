<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Sibasu')</title>
</head>

<body class="bg-gray-100">
    @include('layouts.partials._header')
    @include('layouts.partials._sidebar')

    <div class="ml-[15rem] mt-20">
        @yield('content')
    </div>

    @yield('modals')

    @yield('scripts')
</body>

</html>
