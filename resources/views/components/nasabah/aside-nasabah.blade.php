<aside id="sidebar" class="sidebar flex flex-col border-r bg-white">
    <div class="bg-primary h-20 flex justify-center items-center">
        <h1 class="font-bold text-2xl text-white">Bank Sampah</h1>
    </div>
    <nav class="flex-1 overflow-y-auto mt-5">
        <ul class="p-4 space-y-4">
            <li>
                <a href="{{ route('nasabah.dashboard') }}"
                    class="flex items-center text-base font-bold p-2 rounded {{ request()->routeIs('nasabah.dashboard') ? 'bg-hijau text-white' : 'hover:bg-hijau hover:text-white' }}">
                    <span class="material-icons">home</span>
                    <span class="ml-2">Dashboard</span>
                </a>
            </li>

            <li>
                <a href="{{ route('nasabah.riwayat-setoran-sampah') }}"
                    class="flex items-center text-base font-bold p-2 rounded {{ request()->routeIs('nasabah.riwayat-setoran-sampah') ? 'bg-hijau text-white' : 'hover:bg-hijau hover:text-white' }}">
                    <span class="material-icons">bookmark</span>
                    <span class="ml-2">Riwayat Setoran</span>
                </a>
            </li>

            <li>
                <button onclick="toggleDropdown('penarikanDropdown')"
                    class="flex items-center text-base font-bold p-2 rounded w-full text-left">
                    <span class="material-icons">request_quote</span>
                    <span class="ml-2">Permintaan Penarikan</span>
                    <span class="material-icons ml-auto">expand_more</span>
                </button>
                <ul id="penarikanDropdown" class="ml-8 mt-2 space-y-2">
                    <li>
                        <a href="{{ route('nasabah.penarikan-saldo') }}"
                            class="flex items-center text-base p-2 rounded {{ request()->routeIs('nasabah.penarikan-saldo') ? 'bg-hijau text-white' : 'hover:bg-hijau hover:text-white' }}">
                            <span class="material-icons">account_balance_wallet</span>
                            <span class="ml-2 font-bold">Saldo</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('nasabah.penarikan-poin') }}"
                            class="flex items-center text-base p-2 rounded {{ request()->routeIs('nasabah.penarikan-poin') ? 'bg-hijau text-white' : 'hover:bg-hijau hover:text-white' }}">
                            <span class="material-icons">star</span>
                            <span class="ml-2 font-bold">Poin</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li>
                <button onclick="toggleDropdown('riwayatDropdown')"
                    class="flex items-center text-base font-bold p-2 rounded w-full text-left">
                    <span class="material-icons">history</span>
                    <span class="ml-2">Riwayat Penarikan</span>
                    <span class="material-icons ml-auto">expand_more</span>
                </button>
                <ul id="riwayatDropdown" class="ml-8 mt-2 space-y-2">
                    <li>
                        <a href="{{ route('nasabah.riwayat-penarikan-saldo') }}"
                            class="flex items-center text-base p-2 rounded {{ request()->routeIs('nasabah.riwayat-penarikan-saldo') ? 'bg-hijau text-white' : 'hover:bg-hijau hover:text-white' }}">
                            <span class="material-icons">account_balance_wallet</span>
                            <span class="ml-2 font-bold">Saldo</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('nasabah.riwayat-penarikan-poin') }}"
                            class="flex items-center text-base p-2 rounded {{ request()->routeIs('nasabah.riwayat-penarikan-poin') ? 'bg-hijau text-white' : 'hover:bg-hijau hover:text-white' }}">
                            <span class="material-icons">star</span>
                            <span class="ml-2 font-bold">Poin</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="{{ route('nasabah.profile') }}"
                    class="flex items-center text-base font-bold p-2 rounded {{ request()->routeIs('nasabah.profile') ? 'bg-hijau text-white' : 'hover:bg-hijau hover:text-white' }}">
                    <span class="material-icons">person</span>
                    <span class="ml-2">Profile</span>
                </a>
            </li>
        </ul>
    </nav>
    <div class="p-4">
        <form action="{{ route('logout') }}" method="POST" class="flex items-center">
            @csrf
            @method('POST')
            <button type="submit"
                class="flex items-center text-base p-2 font-bold rounded hover:bg-hijau hover:text-white">
                <span class="material-icons">logout</span>
                <span class="ml-2">Logout</span>
            </button>
        </form>
    </div>

</aside>

<script>
    function toggleDropdown(id) {
        let dropdown = document.getElementById(id);
        if (dropdown.style.display === "none" || dropdown.style.display === "") {
            dropdown.style.display = "block";
        } else {
            dropdown.style.display = "none";
        }
    }
</script>
