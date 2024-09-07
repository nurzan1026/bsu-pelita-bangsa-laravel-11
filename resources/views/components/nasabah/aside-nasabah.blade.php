<aside id="sidebar" class="sidebar flex flex-col border-r bg-white">
    <div class="bg-primary h-20 flex justify-center items-center">
        <h1 class="font-bold text-2xl text-white">Bank Sampah</h1>
    </div>
    <nav class="flex-1 overflow-y-auto mt-5">
        <ul class="p-4 space-y-4">
            <!-- Menu Dashboard -->
            <li>
                <a href="{{ route('nasabah.dashboard') }}"
                    class="flex items-center text-base font-bold p-2 rounded {{ request()->routeIs('nasabah.dashboard') ? 'bg-hijau text-white' : 'hover:bg-hijau hover:text-white' }}">
                    <span class="material-icons">home</span>
                    <span class="ml-2">Dashboard</span>
                </a>
            </li>

            <!-- Menu Riwayat Setoran -->
            <li>
                <a href="{{ route('nasabah.riwayat-setoran-sampah') }}"
                    class="flex items-center text-base font-bold p-2 rounded {{ request()->routeIs('nasabah.riwayat-setoran-sampah') ? 'bg-hijau text-white' : 'hover:bg-hijau hover:text-white' }}">
                    <span class="material-icons">bookmark</span>
                    <span class="ml-2">Riwayat Setoran</span>
                </a>
            </li>

            <!-- Menu Permintaan Penarikan -->
            <li>
                <button onclick="toggleDropdown('penarikanDropdown')"
                    class="flex  text-base font-bold p-2 rounded w-full text-left items-center">
                    <span class="material-icons">request_quote</span>
                    <span class="ml-2">Permintaan Penarikan</span>
                    <span class="material-icons ml-auto transition-transform duration-300"
                        id="penarikanDropdownIcon">expand_more</span>
                </button>
                <ul id="penarikanDropdown" class="ml-8 mt-2 space-y-2 hidden">
                    <li>
                        <a href="{{ route('nasabah.penarikan-saldo.create') }}"
                            class="flex items-center text-base p-2 rounded {{ request()->routeIs('nasabah.penarikan-saldo.create') ? 'bg-hijau text-white' : 'hover:bg-hijau hover:text-white' }}">
                            <span class="material-icons">account_balance_wallet</span>
                            <span class="ml-2 font-bold">Saldo</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('nasabah.penarikan-poin.create') }}"
                            class="flex items-center text-base p-2 rounded {{ request()->routeIs('nasabah.penarikan-poin.create') ? 'bg-hijau text-white' : 'hover:bg-hijau hover:text-white' }}">
                            <span class="material-icons">star</span>
                            <span class="ml-2 font-bold">Poin</span>
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Menu Riwayat Penarikan -->
            <li>
                <a href="{{ route('nasabah.riwayat-penarikan') }}"
                    class="flex items-center text-base font-bold p-2 rounded {{ request()->routeIs('nasabah.riwayat-penarikan') ? 'bg-hijau text-white' : 'hover:bg-hijau hover:text-white' }}">
                    <span class="material-icons">request_quote</span>
                    <span class="ml-2">Riwayat Penarikan</span>
                </a>
            </li>

            <!-- Menu Profile -->
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
        const dropdown = document.getElementById(id);
        const icon = document.getElementById(`${id}Icon`);
        if (dropdown.classList.contains('hidden')) {
            dropdown.classList.remove('hidden');
            icon.classList.replace('expand_more', 'expand_less');
        } else {
            dropdown.classList.add('hidden');
            icon.classList.replace('expand_less', 'expand_more');
        }
    }
</script>
