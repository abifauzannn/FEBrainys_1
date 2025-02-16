@extends('langganan.langganan')

@section('langganan - Tagihan')

@section('langganan-content')

<!-- Spinner -->
<div id="loading-indicator" class="flex justify-center items-center">
    <svg class="animate-spin h-10 w-10 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
        <path class="opacity-75" fill="currentColor"
            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
        </path>
    </svg>
</div>

<!-- Konten -->
<div class="flex flex-col md:flex-row justify-between hidden gap-3" id="main-content">
    @include('langganan.tagihan.paket-aktif')
    @include('langganan.tagihan.daftar-transaksi')
</div>

<script defer>
    document.addEventListener('DOMContentLoaded', async () => {
        const loadingIndicator = document.getElementById('loading-indicator');
        const mainContent = document.getElementById('main-content');
        const apiEndpoint = 'https://testing.brainys.oasys.id/api/user-profile';
        const transactionEndpoint = '/history/fetch'; // Sesuaikan endpoint
        const token = '{{ session()->get("access_token") }}';

        // Fungsi untuk menampilkan & menyembunyikan loading
        const toggleLoading = (isLoading) => {
            loadingIndicator.style.display = isLoading ? 'flex' : 'none';
            mainContent.style.display = isLoading ? 'none' : 'flex';
        };

        // Fungsi untuk memuat paket aktif
        const fetchPaketAktif = async () => {
            try {
                const response = await fetch(apiEndpoint, {
                    method: 'GET',
                    headers: { Authorization: `Bearer ${token}` },
                });
                if (!response.ok) throw new Error('Gagal memuat paket aktif');

                const data = await response.json();
                const packages = data.data.package;

                if (packages.length > 0) {
                    sessionStorage.setItem("package_name", packages[0].package_name);
                } else {
                    sessionStorage.removeItem("package_name");
                }
                updatePackageDisplay();
            } catch (error) {
                console.error('Error paket aktif:', error);
            }
        };

        // Fungsi untuk memperbarui tampilan berdasarkan sessionStorage
        const updatePackageDisplay = () => {
            const packageName = sessionStorage.getItem("package_name") || "Tidak ada paket aktif.";
            document.getElementById("packageDisplay").textContent = `Paket Aktif: ${packageName}`;
        };

        // Fungsi untuk memuat daftar transaksi
        const fetchDaftarTransaksi = async () => {
            try {
                const response = await fetch(transactionEndpoint);
                if (!response.ok) throw new Error('Gagal memuat daftar transaksi');
                console.log("Daftar transaksi dimuat!");
            } catch (error) {
                console.error('Error daftar transaksi:', error);
            }
        };

        // Tampilkan loading indicator
        toggleLoading(true);

        try {
            // Jalankan kedua request secara bersamaan
            await Promise.all([fetchPaketAktif(), fetchDaftarTransaksi()]);
            
            // Setelah request sukses, tambahkan delay 3 detik sebelum menampilkan halaman
            setTimeout(() => {
                toggleLoading(false);
            }, 3000);
            
        } catch (error) {
            console.error("Terjadi kesalahan dalam pemuatan data:", error);
            toggleLoading(false); // Sembunyikan loading meskipun ada error
        }
    });
</script>


@endsection