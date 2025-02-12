<div id="monthly-packages-container" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 gap-6 p-6">
    @if(isset($packages) && count($packages) > 0)
    @foreach($packages as $package)
    <div class="relative w-full h-[547px] rounded-md bg-white shadow-lg flex flex-col justify-between border px-10 py-9">
        <img src="{{ asset('images/package.png') }}" alt="Package Image" class="absolute w-[100px] h-[180px] top-0 right-0 mt-3" loading="lazy">

        <header class="mt-4">
            <div class="text-[18px] font-['Inter'] text-blue-700 font-bold">{{ $package['name'] }}</div>
        </header>

        <main class="flex-grow overflow-y-auto scrollbar-hide mt-2">
            <article>
                <div class="flex flex-col border-b border-gray-300">
                    <div class="text-[42px] font-['Inter'] font-bold">
                        Rp {{ number_format($package['price'], 0, ',', '.') }}
                        <small class="text-sm font-['Inter'] text-gray-600">/ tahun</small>
                    </div>
                    <div class="text-sm font-['Inter'] text-gray-600">
                        Setara Rp <span class="text-black font-bold">{{ number_format($package['price'] / 12, 0, ',', '.') }}</span> / bulan
                    </div>
                    <small class="text-sm font-['Inter'] text-gray-600 mb-5">{{ $package['description'] }}</small>
                </div>
                <div class="flex flex-col mt-5 gap-3">
                    @foreach($package['details'] as $detail)
                    <p class="font-['Inter'] text-gray-500 text-sm">{{ $detail }}</p>
                    @endforeach
                </div>
            </article>
        </main>

        <footer>
            <form id="packageForm-{{ $package['id'] }}" action="{{ route('metode.pembayaran') }}" method="POST">
                @csrf
                <input type="hidden" name="item_id" value="{{ $package['id'] }}">
                <input type="hidden" name="item_type" value="PACKAGE">

                <button type="submit" class="rounded-md bg-blue-600 py-3 px-7 w-full select-btn"
                    data-id="{{ $package['id'] }}"
                    onclick="selectPackage(event, {{ $package['id'] }})">
                    <h3 class="text-[16px] text-center font-['Inter'] text-white">Pilih Paket</h3>
                </button>

                <button type="button" class="rounded-md bg-gray-200 py-3 px-7 w-full hidden selected-btn"
                    id="selectedButton-{{ $package['id'] }}">
                    <h3 class="text-[16px] text-center font-['Inter'] text-gray-600">Terpilih</h3>
                </button>
            </form>
        </footer>
    </div>
    @endforeach
    @else
    <p class="text-center">Tidak ada paket bulanan yang tersedia.</p>
    @endif
</div>

<script>
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