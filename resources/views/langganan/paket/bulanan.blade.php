<div id="monthly-packages-container" class="grid grid-cols-1 gap-6 p-6 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3">
    @if (isset($packages) && count($packages) > 0)
        @foreach ($packages as $package)
            <div
                class="relative w-full h-[547px] rounded-md bg-white shadow-lg flex flex-col justify-between border px-10 py-9">
                <img src="{{ asset('images/package.png') }}" alt="Package Image"
                    class="absolute w-[100px] h-[180px] top-0 right-0 mt-3" loading="lazy">

                <header class="mt-4">
                    <div class="text-[18px] font-['Inter'] text-blue-700 font-bold">{{ $package['name'] }}</div>
                </header>

                <main class="flex-grow mt-2 overflow-y-auto scrollbar-hide">
                    <article>
                        <div class="flex flex-col border-b border-gray-300">
                            <div class="text-[42px] font-['Inter'] font-bold">
                                Rp {{ number_format($package['price'], 0, ',', '.') }}
                                <small class="text-sm font-['Inter'] text-gray-600">/ bulan</small>
                            </div>

                            <small
                                class="text-sm font-['Inter'] text-gray-600 mb-5">{{ $package['description'] }}</small>
                        </div>
                        <div class="flex flex-col gap-3 mt-5">
                            @foreach ($package['details'] as $detail)
                                <p class="font-['Inter'] text-gray-500 text-sm">{{ $detail }}</p>
                            @endforeach
                        </div>
                    </article>
                </main>

                <footer>
                    <form id="packageForm-{{ $package['id'] }}" action="{{ route('metode.pembayaran') }}"
                        method="POST">
                        @csrf
                        <input type="hidden" name="item_id" value="{{ $package['id'] }}">
                        <input type="hidden" name="item_type" value="PACKAGE">

                        @if (isset($package['buttons']))
                            <button type="submit"
                                class="w-full py-3 px-7 rounded-md
                            {{ $package['buttons']['is_disabled'] ? 'bg-gray-300 cursor-not-allowed' : 'bg-blue-600' }}"
                                {{ $package['buttons']['is_disabled'] ? 'disabled' : '' }}>
                                <h3
                                    class="text-[16px] text-center font-['Inter'] {{ $package['buttons']['is_disabled'] ? 'text-gray-500' : 'text-white' }}">
                                    {{ $package['buttons']['label'] }}
                                </h3>
                            </button>
                        @endif

                        {{-- <button type="submit" class="w-full py-3 bg-blue-600 rounded-md px-7 select-btn"
                            data-id="{{ $package['id'] }}" onclick="selectPackage(event, {{ $package['id'] }})">
                            <h3 class="text-[16px] text-center font-['Inter'] text-white">Pilih Paket</h3>
                        </button>

                        <button type="button" class="hidden w-full py-3 bg-gray-200 rounded-md px-7 selected-btn"
                            id="selectedButton-{{ $package['id'] }}">
                            <h3 class="text-[16px] text-center font-['Inter'] text-gray-600">Terpilih</h3>
                        </button> --}}
                    </form>
                </footer>
            </div>
        @endforeach
    @else
        <p class="text-center">Tidak ada paket bulanan yang tersedia.</p>
    @endif
</div>

<script>
    // document.addEventListener("DOMContentLoaded", function() {
    //     // Ambil package_id dari sessionStorage (bisa lebih dari satu, jadi split jadi array)
    //     const storedPackageIds = sessionStorage.getItem("package_id");

    //     if (storedPackageIds) {
    //         const packageIdsArray = storedPackageIds.split(','); // Pisahkan jika ada lebih dari satu

    //         document.querySelectorAll('.select-btn').forEach(button => {
    //             const packageId = button.getAttribute("data-id");

    //             if (packageIdsArray.includes(packageId)) {
    //                 if (packageId !== "1") {
    //                     // Jika package_id bukan 1, sembunyikan "Pilih Paket" dan tampilkan "Terpilih"
    //                     button.classList.add('hidden');
    //                     document.getElementById(`selectedButton-${packageId}`).classList.remove('hidden');
    //                 }
    //             } else {
    //                 if (!packageIdsArray.includes("1")) {
    //                     // Jika package_id 1 tidak ada dalam session, disable tombol lainnya
    //                     button.setAttribute('disabled', true);
    //                     button.classList.add('opacity-50', 'cursor-not-allowed');
    //                 }
    //             }
    //         });
    //     }
    // });


    function selectPackage(event, packageId) {
        event.preventDefault(); // Mencegah submit form saat tombol diklik

        // Sembunyikan semua tombol "Pilih Paket" dan tampilkan kembali jika sebelumnya dipilih
        document.querySelectorAll('.select-btn').forEach(button => button.classList.remove('hidden'));
        document.querySelectorAll('.selected-btn').forEach(button => button.classList.add('hidden'));

        // Sembunyikan tombol yang diklik, tampilkan tombol "Terpilih"
        document.querySelector(`[data-id='${packageId}']`).classList.add('hidden');
        document.getElementById(`selectedButton-${packageId}`).classList.remove('hidden');

        // Submit form setelah user memilih paket
        document.getElementById(`packageForm-${packageId}`).submit();
    }
</script>
