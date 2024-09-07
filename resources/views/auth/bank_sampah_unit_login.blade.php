@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <div class="max-w-md mx-auto bg-white p-5 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold mb-4">Login Bank Sampah Unit</h2>
        @if (session('success'))
            <div class="bg-green-500 text-white p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif
        <form action="{{ route('unit.login') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="email" class="block text-sm font-bold mb-2">Email:</label>
                <input type="email" id="email" name="email" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            </div>
            <div class="mb-4">
                <label for="password" class="block text-sm font-bold mb-2">Password:</label>
                <input type="password" id="password" name="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            </div>
            <div class="flex items-center justify-between">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Login
                </button>
            </div>
        </form>
        <div class="mt-4 text-center">
            <a href="{{ route('unit.register') }}" class="text-blue-500 hover:text-blue-700">Belum punya akun? Daftar di sini</a>
        </div>
        <div class="mt-2 text-center">
            <a href="{{ route('unit.passwords.request') }}" class="text-blue-500 hover:text-blue-700">Lupa sandi?</a>
        </div>
        
        
        
        
    </div>
</div>
@endsection
