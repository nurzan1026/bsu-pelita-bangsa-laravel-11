<nav class="flex items-center w-full h-20 bg-primary shadow-lg fixed top-0 left-0 z-50">
    <div class="flex items-center flex-grow">
        <!-- Hamburger Menu Button -->
        <button id="hamburgerButton" class="ml-5 mr-2">
            <span class="material-icons text-white text-2xl">menu</span>
        </button>
        <!-- Title -->
        <div class="ml-4">
            <h1 class="font-bold text-2xl text-white">Bank Sampah Unit</h1>
        </div>
    </div>

    <!-- Admin Profile Section -->
    <div class="ml-auto flex items-center mr-10 relative">
        <button id="adminButton" class="flex items-center">
            <img id="navbarProfileImage" src="{{ asset('img/logo-bsu.jpg') }}" alt="Profile"
                class="rounded-full w-12 h-12 border" />
            <span class="ml-2 text-white font-bold">{{ Auth::guard('nasabah')->user()->nama }}</span>
        </button>

        <!-- Dropdown Menu -->
        <div id="adminDropdown" class="absolute right-0 mt-44 w-48 bg-white rounded-md shadow-lg py-2 hidden">
            <a href="{{ route('nasabah.profile') }}"
                class="block px-4 py-2 text-gray-900 hover:text-white hover:bg-primary">Settings
                Profile</a>

            <!-- Logout Form -->
            <form action="{{ route('logout') }}" method="POST"
                class="block px-4 py-2 text-gray-900 hover:text-white hover:bg-primary">
                @csrf
                <button type="submit" class="w-full text-left">Logout</button>
            </form>
        </div>
    </div>
</nav>
