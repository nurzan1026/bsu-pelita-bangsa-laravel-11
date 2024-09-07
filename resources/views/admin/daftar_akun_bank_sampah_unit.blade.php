@extends('admin.layout')

@section('content')
<div class="container mx-auto py-8">
    <h1 class="text-3xl font-bold mb-6 text-center">Daftar Akun Bank Sampah Unit</h1>
    <div class="bg-white shadow-md rounded my-6">
        <table class="min-w-full table-auto">
            <thead class="bg-gray-200">
                <tr>
                    <th class="px-4 py-2 border">Nama</th>
                    <th class="px-4 py-2 border">Email</th>
                    <th class="px-4 py-2 border">Alamat</th>
                    <th class="px-4 py-2 border">Telepon</th>
                    <th class="px-4 py-2 border">Tanggal Dibuat</th>

                </tr>
            </thead>
            <tbody class="text-gray-700">
                @foreach($accounts as $account)
                <tr class="border-b">
                    <td class="px-4 py-2 border">{{ $account->name }}</td>
                    <td class="px-4 py-2 border">{{ $account->email }}</td>
                    <td class="px-4 py-2 border">{{ $account->address }}</td>
                    <td class="px-4 py-2 border">{{ $account->phone }}</td>
                    <td class="px-4 py-2 border">{{ $account->created_at->format('d M Y') }}</td>

                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
