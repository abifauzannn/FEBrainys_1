<div class="relative w-full h-[547px] rounded-md bg-white shadow-lg flex flex-col justify-between border px-10 py-9">
    <img src="{{ asset('images/package.png') }}" alt="" class="absolute w-[100px] h-[180px] top-0 right-0 mt-3"
        loading="lazy">

    <header class="mt-4">
        <div class="text-[18px] font-['Inter'] text-blue-700 bold">{{ $package['package'] }}</div>
    </header>

    <main class="flex-grow overflow-y-auto scrollbar-hide mt-2">
        <article>
            <div class="flex flex-col border-b border-gray-300">
                <div class="text-[42px] font-['Inter'] font-bold">Rp {{ $package['price'] }}<small
                        class="text-sm font-['Inter'] text-gray-600">/ bulan</small></div>
                @if ($package['marketing'] != '')
                    <small class="text-sm font-['Inter'] text-gray-600 mb-1">Setara <span
                            class="font-bold text-black">{{ $package['marketing'] }}</span></small>
                @endif
                <small class="text-sm font-['Inter'] text-gray-600 mb-5">{{ $package['description'] }}</small>
            </div>
            <div class="flex flex-col mt-5 gap-3">
                @foreach ($features as $feature)
                    <p class="font-['Inter'] text-gray-500 text-sm">{{ $feature }}</p>
                @endforeach
            </div>
        </article>
    </main>

    <footer>
        <div class="rounded-md bg-blue-600 py-3 px-7 w-full">
            <h3 class="text-[16px] text-center font-['Inter'] text-white">Pilih Paket</h3>
        </div>
    </footer>
</div>
