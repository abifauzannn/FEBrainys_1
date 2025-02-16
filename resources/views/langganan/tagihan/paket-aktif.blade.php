<section
    id="package-container"
    class="w-full md:w-1/3 h-[547px] rounded-md bg-white shadow-lg flex flex-col justify-between border">
    <header>
        <div class="rounded-md bg-[#F9F9F9] py-4 px-7">
            <h3 class="text-[16px] font-['Inter']">Paket Aktif</h3>
            <!-- Di dalam Blade view -->
            <p id="packageDisplay" class="hidden text-lg font-semibold text-blue-600"></p>

        </div>
    </header>

    <main id="packages" class="flex-grow overflow-y-auto">
        <p id="loading" class="text-center text-gray-600 mt-10">Memuat data...</p>
    </main>

    <footer class="mb-5 px-7 pt-3" id="footer">
        <div class="rounded-full bg-blue-600 py-3 px-7">
            <h3 class="text-[13px] font-['Inter'] text-white">Upgrade Paket</h3>
        </div>
    </footer>

    <!-- Modal -->
    <div id="modal" class="fixed inset-0 bg-gray-900 bg-opacity-50 backdrop-blur-sm flex items-center justify-center hidden z-10">
        <div class="bg-white rounded-lg p-6 w-96 shadow-lg">
            <div class="flex justify-between items-start">
                <img src="{{ URL('images/sad.png') }}" alt="" class="w-12 h-12" loading="lazy">
                <button onclick="closeModal()" class="text-gray-500 hover:text-gray-700 text-3xl">&times;</button>
            </div>
            <h2 class="text-[18px] font-semibold font-['Inter']">Apakah anda yakin membatalkan langganan ini?</h2>
            <p class="text-[14px] text-gray-600 mt-2 font-['Inter']">
                Jika Anda melanjutkan pembatalan, paket Anda akan otomatis berubah ke versi gratis setelah masa aktif saat ini berakhir.
            </p>
            <div class="flex justify-center mt-4 space-x-2 w-full">
                <form action="{{ route('cancel.packages') }}" method="GET">
                    <button class="bg-white-200 border border-gray-200 px-4 py-2 rounded-md font-['Inter'] w-full">Ya, Batalkan</button>
                </form>

                <button onclick="closeModal()" class="bg-purple-600 text-white px-4 py-2 rounded-md font-['Inter'] w-full">Tidak</button>
            </div>
        </div>
    </div>

    <script defer>
        // Fungsi untuk membuka modal
        function openModal() {
            const modal = document.getElementById('modal');
            const body = document.body;

            // Tampilkan modal
            modal.classList.remove('hidden');

            // Mengunci scroll pada background (body)
            body.style.overflow = 'hidden';
        }

        // Fungsi untuk menutup modal
        function closeModal() {
            const modal = document.getElementById('modal');
            const body = document.body;

            // Sembunyikan modal
            modal.classList.add('hidden');

            // Kembalikan scroll pada background (body)
            body.style.overflow = 'auto';
        }
    </script>

</section>

<script defer>
    document.addEventListener('DOMContentLoaded', function() {
        const apiEndpoint = `https://testing.brainys.oasys.id/api/user-profile?t=${new Date().getTime()}`;
        const token = '{{ session()->get("access_token") }}';

        const packageContainer = document.getElementById('packages');
        const footer = document.getElementById('footer');
        const loadingElement = document.getElementById('loading');

        // Ambil package_name dari sessionStorage
        const packageName = sessionStorage.getItem("package_name");

        // Cek apakah ada data di sessionStorage
        if (packageName) {
            document.getElementById("packageDisplay").textContent = `Paket Aktif: ${packageName}`;
        } else {
            document.getElementById("packageDisplay").textContent = "Tidak ada paket aktif.";
        }


        async function fetchPackages() {
            try {
                const response = await fetch(apiEndpoint, {
                    method: 'GET',
                    headers: {
                        Authorization: `Bearer ${token}`,
                    },
                });

                if (!response.ok) {
                    throw new Error('Gagal mengambil data paket.');
                }

                const data = await response.json();
                console.log("Data API:", data);
                const packages = data.data.package;

                if (packages.length > 0) {
                    // Ambil package_name dari paket pertama (atau sesuaikan sesuai kebutuhan)
                    console.log("Paket pertama:", packages[0]); // Cek apakah paket ada
                    const packageName = packages[0].package_name;
                    const packageId = packages[0].id || packages[0].package_id; // Cek variasi nama

                    console.log("Package Name:", packageName);
                    console.log("Package ID:", packageId);

                    sessionStorage.setItem("package_name", packageName);
                    sessionStorage.setItem("package_id", packageId);

                    // Render paket
                    renderPackages(packages);
                } else {
                    packageContainer.innerHTML = '<p class="text-center text-gray-600 mt-10">Tidak ada paket aktif.</p>';
                    footer.innerHTML = '<div class="rounded-full bg-blue-600 py-3 px-7"><h3 class="text-[13px] font-[\'Inter\'] text-white">Upgrade Paket</h3></div>';
                }
            } catch (error) {
                packageContainer.innerHTML = `<p class="text-center text-red-600 mt-10">Error: ${error.message}</p>`;
            } finally {
                loadingElement.style.display = 'none';
            }
        }


        function renderPackages(packages) {
            packageContainer.innerHTML = '';
            let hasPaidPackage = false;
            let isH3BeforeExpiration = false;
            let isFreePackage = false;
            let isRenewable = true;

            packages.forEach((pkg) => {
                if (pkg.package_name === 'Paket Free') {
                    isFreePackage = true;
                }

                if (pkg.is_renewable === 0) {
                    isRenewable = false;
                }

                const expirationDate = new Date(pkg.expired_at);
                const today = new Date();

                expirationDate.setHours(0, 0, 0, 0);
                today.setHours(0, 0, 0, 0);

                const timeDiff = Math.floor((expirationDate - today) / (1000 * 60 * 60 * 24));
                isH3BeforeExpiration = timeDiff <= 3;

                if (pkg.package_name !== 'Paket Free') {
                    hasPaidPackage = true;
                }

                packageContainer.innerHTML += `
                <article class="w-full border-b border-gray-200 px-7 py-7">
                    <div class="flex flex-row gap-4 items-center">
                        <img src="/images/paket.png" alt="Paket Image" class="w-12 h-12" loading="lazy">
                        <div class="flex flex-col flex-grow">
                            <div class="flex flex-row justify-between items-center">
                                <h3 class="text-[13px] font-[\'Inter\'] font-semibold">${pkg.package_name}</h3>
                                <p class="text-[13px] font-[\'Inter\'] text-gray-600">Rp ${new Intl.NumberFormat('id-ID').format(pkg.price)}</p>
                            </div>
                            <p class="text-[13px] font-[\'Inter\'] text-gray-600">${pkg.package_description_mod}</p>
                        </div>
                    </div>
                    ${pkg.package_name !== 'Paket Free' ? `
                    <div class="flex flex-col flex-grow pt-7">
                        <div class="flex flex-row justify-between items-center">
                            <p class="text-[13px] font-[\'Inter\'] text-gray-500">
                                Lakukan Pembayaran <br> sebelum Tgl. ${pkg.expired_at_formatted}
                            </p>
                            <form action="{{ route('metode.pembayaran') }}" method="POST">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="item_id" value="${pkg.package_id}">
                                <input type="hidden" name="item_type" value="PACKAGE">
                                <button type="submit" ${isH3BeforeExpiration ? '' : 'disabled'} class="rounded-full ${
                                    isH3BeforeExpiration ? 'bg-blue-600' : 'bg-blue-200'
                                } py-3 px-5 flex justify-center items-center flex-col w-36">
                                    <h3 class="text-[13px] font-[\'Inter\'] text-white">Bayar Tagihan</h3>
                                </button>
                            </form>
                        </div>
                    </div>
                    ` : ''}
                </article>
                `;
            });

            if (isFreePackage) {
                footer.innerHTML = `
        <div class="flex justify-end">
            <a href="{{ route('langganan.pilih-paket') }}" class="rounded-full bg-blue-600 py-3 px-7 w-auto text-[13px] font-['Inter'] text-white">
                Upgrade Paket
            </a>
        </div>
    `;
            } else if (!isRenewable) {
                footer.innerHTML = `
        <div class="text-blue-500 flex flex-row justify-between items-center gap-3">
            <img src="{{ URL('images/Vector.svg') }}" alt="" class="w-8 h-8" loading="lazy">
            <h3 class="text-[13px] font-['Inter'] text-gray-500">
                Anda telah membatalkan paket. Paket ini masih bisa digunakan hingga masa aktifnya berakhir.
            </h3>
        </div>
    `;
            } else if (!hasPaidPackage) {
                footer.innerHTML = `
        <div class="flex justify-end">
            <a href="{{ route('langganan.pilih-paket') }}" class="rounded-full bg-blue-600 py-3 px-7 w-auto text-[13px] font-['Inter'] text-white">
                Upgrade Paket
            </a>
        </div>
    `;
            } else if (isH3BeforeExpiration) {
                footer.innerHTML = `
        <div class="text-blue-500 flex flex-row justify-between items-center gap-4">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-20 h-20">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
            </svg>
            <h3 class="text-[13px] font-['Inter'] text-gray-500">
                Paket Langganan Anda akan kembali ke versi FREE jika pembayaran tidak diselesaikan sebelum batas waktu yang ditentukan.
            </h3>
        </div>
    `;
            } else {
                footer.innerHTML = `
        <a href="javascript:void(0);" class="rounded-full text-[#637381] underline text-[13px] font-['Inter']" onclick="openModal()">
            Batalkan Pesanan
        </a>
    `;
            }

        }

        fetchPackages();
    });
</script>