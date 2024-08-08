<section class="w-1/2 h-[547px] rounded-md bg-white shadow-lg flex flex-col justify-between border">
    <header>
        <div class="rounded-md bg-[#F9F9F9] py-4 px-7">
            <h3 class="text-[16px] font-['Inter']">Paket Aktif</h3>
        </div>
    </header>

    <main class="flex-grow overflow-y-auto">
        <article class="w-full border-b border-gray-200 px-7 py-7">
            <div class="flex flex-row gap-4 items-center">
                <img src="{{ URL('images/paket.png') }}" alt="Paket Image" class="w-12 h-12" loading="lazy">

                <div class="flex flex-col flex-grow">
                    <div class="flex flex-row justify-between items-center">
                        <h3 class="text-lg font-['Inter'] font-semibold">Paket 1</h3>
                        <p class="text-sm font-['Inter'] text-gray-600">Rp. 100.000</p>
                    </div>

                    <p class="text-sm font-['Inter'] text-gray-600">Mendapatkan 5 credit setiap bulannya</p>
                </div>
            </div>
        </article>
    </main>

    <footer class="mb-5 flex justify-end px-7 pt-3">
        <div class="rounded-full bg-blue-600 py-3 px-7">
            <h3 class="text-[16px] font-['Inter'] text-white">Upgrade Paket</h3>
        </div>
    </footer>
</section>
