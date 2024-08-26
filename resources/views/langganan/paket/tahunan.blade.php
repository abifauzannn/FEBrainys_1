<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 gap-2 lg:gap-4 lg:p-2">
    @forelse($annuallyPackages as $package)
        <div
            class="relative w-full h-[547px] rounded-md bg-white shadow-lg flex flex-col justify-between border px-10 py-9">
            <img src="{{ asset('images/package.png') }}" alt="Package Image"
                class="absolute w-[100px] h-[180px] top-0 right-0 mt-3" loading="lazy">

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

                        @if ($package['type'] === 'annually')
                            <div class="text-sm font-['Inter'] text-gray-600">
                                Setara Rp <span
                                    class="text-black font-bold">{{ number_format($package['price'] / 12, 0, ',', '.') }}
                                    / bulan
                                </span> </div>
                        @endif

                        <small class="text-sm font-['Inter'] text-gray-600 mb-5">
                            {{ $package['description'] }}
                        </small>
                    </div>
                    <div class="flex flex-col mt-5 gap-3">
                        @foreach ($package['details'] as $feature)
                            <p class="font-['Inter'] text-gray-500 text-sm">{{ $feature }}</p>
                        @endforeach
                    </div>
                </article>
            </main>

            <footer>
                <form action="{{ route('metode.pembayaran') }}" method="POST" id="bulananForm-{{ $package['id'] }}">
                    @csrf
                    <input type="text" name="item_id" id="item_id-{{ $package['id'] }}" value="{{ $package['id'] }}"
                        hidden>
                    <input type="text" name="item_type" id="item_type-{{ $package['id'] }}" value="PACKAGE" hidden>
                    <button class="rounded-md bg-blue-600 py-3 px-7 w-full" type="submit"
                        id="submitButton-{{ $package['id'] }}">
                        <h3 class="text-[16px] text-center font-['Inter'] text-white">Pilih Paket</h3>
                    </button>
                    <button class="rounded-md bg-gray-200 py-3 px-7 w-full hidden"
                        id="submitButton2-{{ $package['id'] }}">
                        <h3 class="text-[16px] text-center font-['Inter'] text-gray-600">Terpilih</h3>
                    </button>
                </form>
            </footer>
        </div>
    @empty
        <p class="text-center">Tidak ada paket bulanan yang tersedia.</p>
    @endforelse
</div>


<script>
    document.querySelectorAll('form[id^="bulananForm-"]').forEach(function(form) {
        form.addEventListener('submit', function(event) {
            event.preventDefault();

            const formId = form.getAttribute('id').split('-')[1];
            const submitButton1 = document.getElementById('submitButton-' + formId);
            const submitButton2 = document.getElementById('submitButton2-' + formId);

            // Hide all other buttons
            document.querySelectorAll('button[id^="submitButton2-"]').forEach(function(button) {
                button.classList.add('hidden');
            });

            document.querySelectorAll('button[id^="submitButton-"]').forEach(function(button) {
                button.classList.remove('hidden');
            });

            // Show the selected button
            submitButton1.classList.add('hidden');
            submitButton2.classList.remove('hidden');

            form.submit();
        });
    });
</script>
