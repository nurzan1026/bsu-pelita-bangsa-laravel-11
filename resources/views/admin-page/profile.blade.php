@extends('components.admin.layout-admin')

@section('content')
    <div class="mb-2 ml-5">
        <h1 class="font-bold text-3xl text-gray-900">
            Setting Profile
        </h1>
    </div>
    <div class="flex flex-wrap justify-center p-2 bg-gray-100">
        <!-- Card 1: Edit Profile Picture, Name, and Bio -->
        <div class="w-full md:w-1/2 p-4">
            <div class="p-6 bg-white shadow-md rounded-lg mb-6">
                <h2 class="text-lg font-bold mb-4">Edit Profile</h2>
                <div class="flex items-center justify-center mb-4">
                    <div class="relative w-24 h-32 border-2 border-gray-300 rounded-md flex items-center justify-center">
                        <img id="profileImage" src="path/to/default-icon.png" alt="Profile Icon"
                            class="object-cover w-full h-full hidden">
                        <span id="profileIcon" class="material-icons text-gray-500 text-6xl">person</span>
                    </div>
                </div>
                <div class="mb-4">
                    <label for="profilePic" class="block text-sm font-bold mb-2">Ubah profile</label>
                    <input type="file" id="profilePic"
                        class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-gray-200 hover:file:bg-gray-300" />
                </div>
                <div class="mb-4">
                    <label for="profileName" class="block text-sm font-bold mb-2">Profile Name</label>
                    <input type="text" id="profileName" class="w-full px-4 py-2 border border-gray-300 rounded-md"
                        value="Nama profile">
                </div>
                <div class="mb-4">
                    <label for="profileBio" class="block text-sm font-bold mb-2">Bio</label>
                    <textarea id="profileBio" class="w-full px-4 py-2 border border-gray-300 rounded-md" rows="5">masukkannn bio anda .....</textarea>
                </div>
                <div class="mt-6 flex justify-end">
                    <button class="bg-hijau text-white font-bold py-2 px-6 rounded-md hover:bg-green-600">Save
                        Changes</button>
                </div>
            </div>
        </div>

        <!-- Card 2: Change Password -->
        <div class="w-full md:w-1/2 p-4">
            <div class="p-6 bg-white shadow-md rounded-lg">
                <h2 class="text-lg font-bold mb-4">Change Password</h2>
                <div class="mb-4">
                    <label for="currentPassword" class="block text-sm font-bold mb-2">Current Password</label>
                    <input type="password" id="currentPassword" class="w-full px-4 py-2 border border-gray-300 rounded-md"
                        placeholder="Current Password">
                </div>
                <div class="mb-4">
                    <label for="newPassword" class="block text-sm font-bold mb-2">New Password</label>
                    <input type="password" id="newPassword" class="w-full px-4 py-2 border border-gray-300 rounded-md"
                        placeholder="New Password">
                </div>
                <div class="mb-4">
                    <label for="confirmPassword" class="block text-sm font-bold mb-2">Confirm New Password</label>
                    <input type="password" id="confirmPassword" class="w-full px-4 py-2 border border-gray-300 rounded-md"
                        placeholder="Confirm New Password">
                </div>
                <div class="mt-6 flex justify-end">
                    <button class="bg-hijau text-white font-bold py-2 px-6 rounded-md hover:bg-green-600">Change
                        Password</button>
                </div>
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
    </script>
@endsection
