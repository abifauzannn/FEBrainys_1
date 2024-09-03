@if ($credits)
    @foreach ($credits as $credit)
        <section class="w-[95%] h-full rounded-md bg-white shadow-md flex flex-col justify-between border mb-2">
            <main>
                <article class="w-full px-7 py-7">
                    <div class="flex flex-col md:flex-row gap-4 items-center">
                        <img src="{{ URL('images/credit.png') }}" alt="Paket Image" class="w-12 h-12" loading="lazy">

                        <div class="flex flex-col flex-grow">
                            <h3 class="text-lg font-['Inter'] font-semibold">{{ $credit['name'] }}</h3>
                            <p class="text-sm font-['Inter'] text-gray-600">
                                Rp {{ number_format($credit['price'], 0, ',', '.') }}
                            </p>
                        </div>

                        <form action="{{ route('metode.pembayaran') }}" method="POST"
                            id="paymentForm-{{ $credit['id'] }}">
                            @csrf
                            <input type="text" name="item_id" id="item_id" value="{{ $credit['id'] }}" hidden>
                            <input type="text" name="item_type" id="item_type" value="CREDIT" hidden>
                            <button type="submit"
                                class="font-['Inter'] text-center py-2 px-4 bg-white border rounded-full flex items-center justify-center gap-2 w-40">
                                <span id="submitButtonText-{{ $credit['id'] }}">Beli Sekarang</span>
                                <div id="loadingSpinner-{{ $credit['id'] }}" class="ml-2 hidden">
                                    <svg class="animate-spin h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10"
                                            stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor"
                                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                        </path>
                                    </svg>
                                </div>
                            </button>
                        </form>
                    </div>
                </article>
            </main>
        </section>
    @endforeach
@else
    <p>No extra credits available.</p>
@endif

<script>
    document.querySelectorAll('[id^="paymentForm-"]').forEach(form => {
        form.addEventListener('submit', function(event) {
            const formId = event.target.id.split('-')[1];
            document.getElementById(`submitButtonText-${formId}`).classList.add('hidden');
            document.getElementById(`loadingSpinner-${formId}`).classList.remove('hidden');
        });
    });
</script>
