@extends('components.nasabah.layout-nasabah')

@section('content')
    <div class="mb-2 ml-5">
        <h1 class="font-bold text-3xl text-gray-900">
            Pengaturan Profil
        </h1>
    </div>
    <div class="flex flex-wrap justify-center p-2 bg-gray-100">
        <!-- Kartu 1: Edit Foto Profil dan Nama -->
        <div class="w-full md:w-1/2 p-4">
            <div class="p-6 bg-white shadow-md rounded-lg mb-6">
                <h2 class="text-lg font-bold mb-4">Edit Profil</h2>
                <div class="flex items-center justify-center mb-4">
                    <div class="relative w-24 h-32 border-2 border-gray-300 rounded-md flex items-center justify-center">
                        <img id="profileImage" src="path/to/default-icon.png" alt="Ikon Profil"
                            class="object-cover w-full h-full hidden">
                        <span id="profileIcon" class="material-icons text-gray-500 text-6xl">person</span>
                    </div>
                </div>
                <div class="mb-4">
                    <label for="profilePic" class="block text-sm font-bold mb-2">Ubah Foto Profil</label>
                    <input type="file" id="profilePic"
                        class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-gray-200 hover:file:bg-gray-300" />
                </div>
                <div class="mt-6 flex justify-end">
                    <button id="saveChanges"
                        class="bg-hijau text-white font-bold py-2 px-6 rounded-md hover:bg-green-600">Simpan
                        Perubahan</button>
                </div>
                <!-- Alert Message -->
                <div id="alertMessage"
                    class="hidden bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4"
                    role="alert">
                    <strong class="font-bold">Berhasil!</strong>
                    <span class="block sm:inline">Foto profil telah diubah.</span>
                </div>
            </div>
        </div>

        <!-- Kartu 2: Ubah Kata Sandi -->
        <div class="w-full md:w-1/2 p-4">
            <div class="p-6 bg-white shadow-md rounded-lg">
                <h2 class="text-lg font-bold mb-4">Ubah Kata Sandi</h2>

                @if (session('status'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative"
                        role="alert">
                        <strong class="font-bold">Berhasil!</strong>
                        <span class="block sm:inline">{{ session('status') }}</span>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                        <strong class="font-bold">Ada kesalahan!</strong>
                        <ul class="list-disc pl-5 mt-2">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('password.change') }}" method="post" class="space-y-6">
                    @csrf
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Email:</label>
                        <input type="email" name="email" id="email" value="{{ old('email') }}" required
                            placeholder="Masukkan email Anda"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-hijau focus:border-hijau">
                    </div>
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700">Kata Sandi Baru:</label>
                        <input type="password" name="password" id="password" required placeholder="Buat kata sandi baru"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-hijau focus:border-hijau">
                    </div>
                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Konfirmasi
                            Kata Sandi:</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" required
                            placeholder="Konfirmasi kata sandi baru"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-hijau focus:border-hijau">
                    </div>
                    <button type="submit"
                        class="w-full px-4 py-2 font-semibold text-white bg-primary rounded-md hover:bg-hijau focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-hijau">Ubah
                        Kata Sandi</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('profilePic').addEventListener('change', function(event) {
            const profileImage = document.getElementById('profileImage');
            const profileIcon = document.getElementById('profileIcon');

            const reader = new FileReader();
            reader.onload = function(e) {
                profileImage.src = e.target.result;
                profileImage.classList.remove('hidden');
                profileIcon.classList.add('hidden');
            };
            reader.readAsDataURL(event.target.files[0]);
        });

        document.getElementById('saveChanges').addEventListener('click', function() {
            const profileImage = document.getElementById('profileImage').src;
            const navbarProfileImage = document.querySelector('nav img');
            const alertMessage = document.getElementById('alertMessage');

            // Update the navbar profile image
            if (navbarProfileImage) {
                navbarProfileImage.src = profileImage;
            }

            // Show the alert message
            alertMessage.classList.remove('hidden');

            // Hide the alert message after a few seconds (optional)
            setTimeout(function() {
                alertMessage.classList.add('hidden');
            }, 5000); // Hide after 5 seconds
        });
    </script>
@endsection
