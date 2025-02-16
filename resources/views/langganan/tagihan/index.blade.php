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
<div class="flex flex-row justify-between hidden" id="main-content">
    @include('langganan.tagihan.paket-aktif')
    @include('langganan.tagihan.daftar-transaksi')
</div>

<script defer>
    document.addEventListener('DOMContentLoaded', () => {
        const loadingIndicator = document.getElementById('loading-indicator');
        const mainContent = document.getElementById('main-content');
        const apiEndpoint =
            'https://testing.brainys.oasys.id/api/user-profile';
        const token = '{{ session()->get("access_token") }}';
        let paketAktifLoaded = false;
        let daftarTransaksiLoaded = false;

        // Tampilkan loading indicator dan sembunyikan konten
        const showLoading = () => {
            loadingIndicator.style.display = 'flex';
            mainContent.style.display = 'none';
        };

        // Sembunyikan loading indicator dan tampilkan konten
        const hideLoading = () => {
            loadingIndicator.style.display = 'none';
            mainContent.style.display = 'flex';
        };

        // Fungsi untuk memuat data paket aktif
        const loadPaketAktif = async () => {
            try {
                const response = await fetch(apiEndpoint, {
                    method: 'GET',
                    headers: {
                        Authorization: `Bearer ${token}`,
                    },
                });

                if (!response.ok) throw new Error('Gagal memuat paket aktif');

                const data = await response.json();
                console.log("Data Paket Aktif:", data);

                // Ambil package_name dari API
                const packages = data.data.package;

                if (packages.length > 0) {
                    const packageName = packages[0].package_name;

                    // Simpan package_name di sessionStorage
                    sessionStorage.setItem("package_name", packageName);
                } else {
                    sessionStorage.removeItem("package_name"); // Hapus jika tidak ada paket aktif
                }

                // Panggil fungsi untuk memperbarui tampilan setelah data diubah
                updatePackageDisplay();

                paketAktifLoaded = true;
                checkIfAllLoaded();
            } catch (error) {
                console.error('Gagal memuat paket aktif:', error);
            }
        };

        // Fungsi untuk memperbarui tampilan berdasarkan sessionStorage
        const updatePackageDisplay = () => {
            const packageName = sessionStorage.getItem("package_name");
            document.getElementById("packageDisplay").textContent = packageName ?
                `Paket Aktif: ${packageName}` :
                "Tidak ada paket aktif.";
        };

        // Jalankan fungsi saat loadPaketAktif selesai
        loadPaketAktif();



        // Fungsi untuk memuat data daftar transaksi
        const loadDaftarTransaksi = async () => {
            try {
                const response = await fetch('/history/fetch'); // Sesuaikan endpoint
                if (!response.ok) throw new Error('Gagal memuat daftar transaksi');
                daftarTransaksiLoaded = true;
                checkIfAllLoaded();
            } catch (error) {
                console.error('Gagal memuat daftar transaksi:', error);
            }
        };

        // Periksa apakah semua data sudah dimuat
        const checkIfAllLoaded = () => {
            if (paketAktifLoaded && daftarTransaksiLoaded) {
                // Tambahkan delay 3 detik sebelum menyembunyikan loading indicator
                setTimeout(() => {
                    hideLoading();
                }, 3000);
            }
        };

        // Panggil fungsi untuk memuat data
        showLoading(); // Tampilkan spinner
        loadPaketAktif();
        loadDaftarTransaksi();
    });
</script>

@endsection