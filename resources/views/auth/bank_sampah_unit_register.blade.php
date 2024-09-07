@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <div class="max-w-md mx-auto bg-white p-5 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold mb-4">Register Bank Sampah Unit</h2>
        <form method="POST" action="{{ route('unit.register') }}">
            @csrf

            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Nama</label>
                <input id="name" type="text" class="form-input mt-1 block w-full @error('name') border-red-500 @enderror" name="name" value="{{ old('name') }}" required autofocus>
                @error('name')
                    <span class="text-red-500 text-sm mt-2">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input id="email" type="email" class="form-input mt-1 block w-full @error('email') border-red-500 @enderror" name="email" value="{{ old('email') }}" required>
                @error('email')
                    <span class="text-red-500 text-sm mt-2">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input id="password" type="password" class="form-input mt-1 block w-full @error('password') border-red-500 @enderror" name="password" required>
                @error('password')
                    <span class="text-red-500 text-sm mt-2">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="password-confirm" class="block text-sm font-medium text-gray-700">Konfirmasi Password</label>
                <input id="password-confirm" type="password" class="form-input mt-1 block w-full" name="password_confirmation" required>
            </div>

            <div class="mb-4">
                <label for="address" class="block text-sm font-medium text-gray-700">Alamat</label>
                <input id="address" type="text" class="form-input mt-1 block w-full @error('address') border-red-500 @enderror" name="address" value="{{ old('address') }}" required>
                @error('address')
                    <span class="text-red-500 text-sm mt-2">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="phone" class="block text-sm font-medium text-gray-700">Nomor Telepon</label>
                <input id="phone" type="text" class="form-input mt-1 block w-full @error('phone') border-red-500 @enderror" name="phone" value="{{ old('phone') }}" required>
                @error('phone')
                    <span class="text-red-500 text-sm mt-2">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <button type="submit" class="w-full bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                    Register
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
