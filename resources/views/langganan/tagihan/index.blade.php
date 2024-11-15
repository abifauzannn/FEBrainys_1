@extends('langganan.langganan')

@section('langganan - Tagihan')


@section('langganan-content')



    <div class="flex flex-col md:flex-row justify-between gap-5">
        <section class="w-full md:w-1/2 h-[547px] rounded-md bg-white shadow-lg flex flex-col justify-between border">
            <header>
                <div class="rounded-md bg-[#F9F9F9] py-4 px-7">
                    <h3 class="text-[16px] font-['Inter']">Paket Aktif</h3>
                </div>
            </header>

            <main class="flex-grow overflow-y-auto">
                @if (session()->has('package'))
                    @foreach (session('package') as $pkg)
                        @php
                            // Ambil tanggal kadaluarsa dalam bentuk Carbon
                            $expired_at = \Carbon\Carbon::parse($pkg['expired_at_formatted']);
                            // Cek jika tanggal kadaluarsa dalam 7 hari ke depan atau sama dengan hari ini
                            $isExpiredSoon =
                                $expired_at->diffInDays(now()) <= 7 && $expired_at->greaterThanOrEqualTo(now());
                        @endphp
                        <article class="w-full border-b border-gray-200 px-7 py-7">
                            <div class="flex flex-row gap-4 items-center">
                                <img src="{{ URL('images/paket.png') }}" alt="Paket Image" class="w-12 h-12" loading="lazy">

                                <div class="flex flex-col flex-grow">
                                    <div class="flex flex-row justify-between items-center">
                                        <h3 class="text-[13px] font-['Inter'] font-semibold">{{ $pkg['package_name'] }}</h3>
                                        <p class="text-[13px] font-['Inter'] text-gray-600">Rp
                                            {{ number_format($pkg['price'], 0, ',', '.') }}</p>
                                    </div>

                                    <p class="text-[13px] font-['Inter'] text-gray-600">
                                        {{ $pkg['package_description_mod'] }}
                                    </p>
                                </div>
                            </div>

                            @if ($pkg['package_name'] !== 'Paket Free' && $isExpiredSoon)
                                <div class="flex flex-col flex-grow pt-7">
                                    <div class="flex flex-row justify-between items-center">

                                        <p class="text-[13px] font-['Inter'] text-gray-500">Lakukan Pembayaran <br> sebelum
                                            Tgl. {{ $pkg['expired_at_formatted'] }}</p>

                                        <form action="{{ route('metode.pembayaran') }}" method="POST" id="reSubscribeForm">
                                            @csrf
                                            <input type="text" name="item_id" value="{{ $pkg['package_id'] }}" hidden>
                                            <input type="text" name="item_type" value="PACKAGE" hidden>
                                            <button type="submit" id="submitButton"
                                                class="rounded-full bg-blue-600 py-3 px-5 flex justify-center items-center flex-col w-36">
                                                <div id="loadingSpinner" class="hidden">
                                                    <svg class="animate-spin h-5 w-5 text-white"
                                                        xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24">
                                                        <circle class="opacity-25" cx="12" cy="12" r="10"
                                                            stroke="currentColor" stroke-width="4"></circle>
                                                        <path class="opacity-75" fill="currentColor"
                                                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                                        </path>
                                                    </svg>
                                                </div>
                                                <h3 class="text-[13px] font-['Inter'] text-white" id="buttonText">Bayar
                                                    Tagihan</h3>
                                            </button>
                                        </form>

                                    </div>
                                </div>
                            @elseif ($pkg['package_name'] !== 'Paket Free' && !$isExpiredSoon)
                                <div class="flex flex-col flex-grow pt-7">
                                    <div class="flex flex-row justify-between items-center">

                                        <p class="text-[13px] font-['Inter'] text-gray-500">Lakukan Pembayaran <br> sebelum
                                            Tgl. {{ $pkg['expired_at_formatted'] }}</p>

                                        <button type="submit" class="rounded-full bg-blue-600 py-3 px-5 opacity-50"
                                            disabled>
                                            <h3 class="text-[13px] font-['Inter'] text-white">Bayar Tagihan</h3>
                                        </button>
                                    </div>
                                </div>
                            @elseif ($pkg['package_name'] === 'Paket Free')
                                <div></div>
                            @endif
                        </article>
                    @endforeach
                @endif

            </main>



            @if ($pkg['package_name'] === 'Paket Free')
                <footer class="mb-5 flex justify-end px-7 pt-3">
                    <div class="rounded-full bg-blue-600 py-3 px-7">
                        <h3 class="text-[13px] font-['Inter'] text-white">Upgrade Paket</h3>
                    </div>
                </footer>
            @elseif ($isExpiredSoon)
                <footer class="mb-5  px-7 pt-3">
                    <div class="text-blue-500 flex flex-row justify-between items-center gap-4"> <!-- Ubah warna di sini -->
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-20 h-20">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
                        </svg>
                        <h3 class="text-[13px] font-['Inter'] text-gray-500">Paket Langganan Anda akan kembali ke versi FREE
                            jika pembayaran tidak diselesaikan sebelum batas waktu yang ditentukan.</h3>
                    </div>
                </footer>
            @else
                <footer class="mb-5 flex justify-start px-7 pt-3">
                    <div class="">
                        <h3 class="text-[13px] font-['Inter'] text-gray-500 underline">Batalkan langganan</h3>
                    </div>
                </footer>
            @endif



        </section>

        <!-- History -->
        <div class="w-full h-[756px]  overflow-auto rounded-md shadow-lg border">
            <div class="relative overflow-x-auto">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 font-['Inter']">
                    <thead class="border-b">
                        <tr class="bg-[#F9F9F9]">
                            <th class="font-['Inter'] font-normal text-[16px] text-left py-4 px-6 text-black">
                                Tanggal</th>
                            <th class="font-['Inter'] font-normal text-[16px] text-left py-4 px-6 text-black">
                                Transaksi</th>
                            <th class="font-['Inter'] font-normal text-[16px] text-left py-4 px-6 text-black">Jumlah
                            </th>
                            <th class="font-['Inter'] font-normal text-[16px] text-center py-4 px-6 text-black">
                                Status</th>
                            <th class="font-['Inter'] font-normal text-[16px] text-left py-4 px-6 text-black"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($historyData as $history)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 cursor-pointer hover:bg-gray-50"
                                onclick="window.location='{{ url('/order/detail/' . $history['transaction_code'] . '/') }}'">
                                <td class="px-6 py-4 text-[13px]">
                                    {{ $history['transaction_date'] }}
                                </td>
                                <td class="px-3 py-4 text-[13px]">
                                    {{ $history['transaction_name'] }} <br> {{ $history['transaction_code'] }}
                                </td>
                                <td class="px-6 py-4 text-[13px]">
                                    Rp {{ number_format($history['amount_total'], 0, ',', '.') }}
                                </td>
                                <td class="px-[10px] py-4 text-[13px] flex justify-center items-center mt-2">
                                    @if ($history['status'] == 'completed')
                                        <div
                                            class="font-['Inter'] text-center inline-block py-1 px-3 font-bold bg-green-100 text-green-800 rounded-full">
                                            Dibayar
                                        </div>
                                    @elseif ($history['status'] == 'canceled')
                                        <div
                                            class="font-['Inter'] text-center inline-block py-1 px-3 font-bold bg-red-100 text-red-800 rounded-full">
                                            Gagal dibayar
                                        </div>
                                    @elseif ($history['status'] == 'pending')
                                        <div
                                            class="font-['Inter'] text-center inline-block py-1 px-3 font-bold bg-yellow-100 text-yellow-800 rounded-full">
                                            Menunggu Pembayaran
                                        </div>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-[13px]">
                                    <form method="POST" action="{{ route('export.invoice') }}" target="_blank"
                                        onclick="event.stopPropagation();">
                                        @csrf
                                        <input type="hidden" name="generateId" value="{{ $history['id'] }}">
                                        <button type="submit"
                                            class="font-['Inter'] text-center py-2 px-4 font-bold bg-white border rounded-full flex items-center justify-center gap-2">
                                            <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                fill="currentColor" viewBox="0 0 20 20">
                                                <path
                                                    d="M14.707 7.793a1 1 0 0 0-1.414 0L11 10.086V1.5a1 1 0 0 0-2 0v8.586L6.707 7.793a1 1 0 1 0-1.414 1.414l4 4a1 1 0 0 0 1.416 0l4-4a1 1 0 0 0-.002-1.414Z" />
                                                <path
                                                    d="M18 12h-2.55l-2.975 2.975a3.5 3.5 0 0 1-4.95 0L4.55 12H2a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-4a2 2 0 0 0-2-2Zm-3 5a1 1 0 1 1 0-2 1 1 0 0 1 0 2Z" />
                                            </svg>
                                            Invoice
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach


                    </tbody>
                </table>
            </div>
            <div class="flex justify-end pr-7 md:py-10 py-10 gap-2">
                @if ($currentGroupStart > 1)
                    <a href="{{ route('langganan.tagihan', ['page' => $currentGroupStart - 1]) }}"
                        class="px-3 py-1 bg-blue-500 text-white rounded">Sebelumnya</a>
                @endif

                @for ($i = $currentGroupStart; $i <= $currentGroupEnd; $i++)
                    <a href="{{ route('langganan.tagihan', ['page' => $i]) }}"
                        class="px-3 py-1 {{ $i == $page ? 'bg-blue-500 text-white' : 'bg-white border' }} rounded">{{ $i }}</a>
                @endfor

                @if ($currentGroupEnd < $totalPages)
                    <a href="{{ route('langganan.tagihan', ['page' => $currentGroupEnd + 1]) }}"
                        class="px-3 py-1 bg-blue-500 text-white rounded">Berikutnya</a>
                @endif
            </div>



        </div>

    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Ensure spinner is hidden initially
            document.getElementById("loadingSpinner").classList.add('hidden');
        });

        document.getElementById('reSubscribeForm').addEventListener('submit', function() {
            // Hide button text and show spinner when submitting
            document.getElementById('buttonText').classList.add('hidden');
            document.getElementById('loadingSpinner').classList.remove('hidden');
        });
    </script>


@endsection
