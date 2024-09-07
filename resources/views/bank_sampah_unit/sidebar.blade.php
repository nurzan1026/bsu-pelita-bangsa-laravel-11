<div class="w-64 bg-white h-full fixed z-10 hidden md:flex flex-col">
    <div class="bg-green-700 p-4 text-center">
        <div class="text-white text-2xl font-bold">SIBAS.ID</div>
    </div>
    <nav class="flex-1 px-4 space-y-4 mt-4 overflow-auto">
        <a href="/unit/dashboard"
            class="nav-link text-black flex items-center p-2 rounded-lg hover:bg-green-800 hover:text-white transition"
            onclick="highlightLink(this)">
            <i class="fas fa-home mr-3"></i>Dashboard
        </a>

        <a href="/unit/persetujuan-penarikan"
            class="nav-link text-black flex items-center p-2 rounded-lg hover:bg-green-800 hover:text-white transition"
            onclick="highlightLink(this)">
            <i class="fas fa-bookmark mr-3"></i>Transaksi
        </a>
        <a href="/setoran"
            class="nav-link text-black flex items-center p-2 rounded-lg hover:bg-green-800 hover:text-white transition"
            onclick="highlightLink(this)">
            <i class="fas fa-wallet mr-3"></i>Setoran Sampah
        </a>
        <a href="/unit/jadwal_pengangkutan"
            class="nav-link text-black flex items-center p-2 rounded-lg hover:bg-green-800 hover:text-white transition"
            onclick="highlightLink(this)">
            <i class="fas fa-calendar-alt mr-3"></i>Jadwal Pengangkutan
        </a>
        <div class="relative">
            <button onclick="toggleDropdown('permintaan-dropdown'); highlightLink(this);"
                class="nav-link w-full text-black flex items-center p-2 rounded-lg hover:bg-green-800 hover:text-white transition">
                <i class="fas fa-pen mr-3"></i>Permintaan
                <i class="fas fa-chevron-down ml-auto"></i>
            </button>
            <div id="permintaan-dropdown" class="hidden flex-col bg-gray-100 rounded-lg shadow-md mt-2">
                <a href="/unit/permintaan_pengangkutan"
                    class="nav-link text-black flex items-center p-2 hover:bg-green-800 hover:text-white transition"
                    onclick="highlightLink(this)">
                    <i class="fas fa-plus mr-3"></i>Buat Permintaan
                </a>
                <a href="/unit/permintaan_pengangkutan/riwayat"
                    class="nav-link text-black flex items-center p-2 hover:bg-green-800 hover:text-white transition"
                    onclick="highlightLink(this)">
                    <i class="fas fa-history mr-3"></i>Riwayat Permintaan
                </a>
                <a href="/unit/permintaan_pengangkutan/selesai"
                    class="nav-link text-black flex items-center p-2 hover:bg-green-800 hover:text-white transition rounded-b-lg"
                    onclick="highlightLink(this)">
                    <i class="fas fa-check mr-3"></i>Permintaan Selesai
                </a>
            </div>
        </div>
        <a href="/nasabah"
            class="nav-link text-black flex items-center p-2 rounded-lg hover:bg-green-800 hover:text-white transition"
            onclick="highlightLink(this)">
            <i class="fas fa-users mr-3"></i>Nasabah
        </a>
        <a href="/kategori"
            class="nav-link text-black flex items-center p-2 rounded-lg hover:bg-green-800 hover:text-white transition"
            onclick="highlightLink(this)">
            <i class="fas fa-bell mr-3"></i>Kategori
        </a>
        <div class="relative">
            <button onclick="toggleDropdown('laporan-dropdown'); highlightLink(this);"
                class="nav-link w-full text-black flex items-center p-2 rounded-lg hover:bg-green-800 hover:text-white transition">
                <i class="fas fa-file-alt mr-3"></i>Laporan
                <i class="fas fa-chevron-down ml-auto"></i>
            </button>
            <div id="laporan-dropdown" class="hidden flex-col bg-gray-100 rounded-lg shadow-md mt-2">
                <a href="/laporan/setoran"
                    class="nav-link text-black flex items-center p-2 hover:bg-green-800 hover:text-white transition"
                    onclick="highlightLink(this)">
                    <i class="fas fa-file mr-3"></i>Laporan Setoran
                </a>
                <a href="/laporan/tahunan"
                    class="nav-link text-black flex items-center p-2 hover:bg-green-800 hover:text-white transition"
                    onclick="highlightLink(this)">
                    <i class="fas fa-file mr-3"></i>Laporan Tahunan
                </a>
                <a href="/laporan/penjualan"
                    class="nav-link text-black flex items-center p-2 hover:bg-green-800 hover:text-white transition"
                    onclick="highlightLink(this)">
                    <i class="fas fa-file mr-3"></i>Laporan Penjualan
                </a>
                <a href="/laporan/daur-ulang"
                    class="nav-link text-black flex items-center p-2 hover:bg-green-800 hover:text-white transition"
                    onclick="highlightLink(this)">
                    <i class="fas fa-file mr-3"></i>Laporan Daur Ulang
                </a>
                <a href="/laporan/pengelolaan"
                    class="nav-link text-black flex items-center p-2 hover:bg-green-800 hover:text-white transition rounded-b-lg"
                    onclick="highlightLink(this)">
                    <i class="fas fa-file mr-3"></i>Laporan Pengelolaan
                </a>
            </div>
        </div>
    </nav>
</div>
<script>
    function toggleDropdown(dropdownId) {
        var dropdown = document.getElementById(dropdownId);
        dropdown.classList.toggle('hidden');
    }

    function highlightLink(element) {
        let linksAndButtons = document.querySelectorAll('.nav-link, .nav-link button');
        linksAndButtons.forEach(function(link) {
            link.classList.remove('bg-green-800', 'text-white');
        });

        element.classList.add('bg-green-800', 'text-white');
        if (element.tagName === 'A') {
            localStorage.setItem('activeLink', element.href);
        } else {
            localStorage.setItem('activeLink', element.textContent.trim());
        }
    }
    window.onload = function() {
        let activeLink = localStorage.getItem('activeLink');
        let linksAndButtons = document.querySelectorAll('.nav-link');

        linksAndButtons.forEach(function(link) {
            if (link.href === activeLink || link.textContent.trim() === activeLink) {
                link.classList.add('bg-green-800', 'text-white');
                let parentDropdown = link.closest('.relative');
                if (parentDropdown) {
                    let dropdownMenu = parentDropdown.querySelector('.flex-col');
                    dropdownMenu.classList.remove('hidden');
                }
            }
        });
    }
</script>
