@if ($credits)
    @foreach ($credits as $credit)
        <section class="w-[95%] h-full rounded-md bg-white shadow-md flex flex-col justify-between border mb-2">
            <main>
                <article class="w-full px-7 py-7">
                    <div class="flex flex-row gap-4 items-center">
                        <img src="{{ URL('images/credit.png') }}" alt="Paket Image" class="w-12 h-12" loading="lazy">

                        <div class="flex flex-col flex-grow">
                            <h3 class="text-lg font-['Inter'] font-semibold">{{ $credit['name'] }}</h3>
                            <p class="text-sm font-['Inter'] text-gray-600">
                                Rp {{ number_format($credit['price'], 0, ',', '.') }}
                            </p>
                        </div>

                        <form action="{{ route('metode.pembayaran') }}" method="POST">
                            @csrf
                            <input type="text" name="item_id" id="item_id" value="{{ $credit['id'] }}" hidden>
                            <input type="text" name="item_type" id="item_type" value="CREDIT" hidden>
                            <button type="submit"
                                class="font-['Inter'] text-center py-2 px-4 bg-white border rounded-full flex items-center justify-center gap-2">
                                Beli Sekarang
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
