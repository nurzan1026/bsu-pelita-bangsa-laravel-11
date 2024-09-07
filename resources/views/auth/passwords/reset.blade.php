@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <div class="max-w-md mx-auto bg-white p-5 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold mb-4">Reset Password</h2>
        @if (session('status'))
            <div class="bg-green-500 text-white p-3 rounded mb-4">
                {{ session('status') }}
            </div>
        @endif
        <form action="{{ $guard == 'unit' ? route('unit.password.update') : route('pusat.password.update') }}" method="POST">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
            <div class="mb-4">
                <label for="email" class="block text-sm font-bold mb-2">Email:</label>
                <input type="email" id="email" name="email" value="{{ $email }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            </div>
            <div class="mb-4">
                <label for="password" class="block text-sm font-bold mb-2">Password:</label>
                <input type="password" id="password" name="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            </div>
            <div class="mb-4">
                <label for="password_confirmation" class="block text-sm font-bold mb-2">Confirm Password:</label>
                <input type="password" id="password_confirmation" name="password_confirmation" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            </div>
            <div class="flex items-center justify-between">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Reset Password
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
