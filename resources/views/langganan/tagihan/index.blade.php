@extends('langganan.langganan')

@section('langganan - Tagihan')


@section('langganan-content')


    <div class="flex flex-col md:flex-row justify-between gap-5">
        <section class="w-1/2 h-[547px] rounded-md bg-white shadow-lg flex flex-col justify-between border">
            <header>
                <div class="rounded-md bg-[#F9F9F9] py-4 px-7">
                    <h3 class="text-[16px] font-['Inter']">Paket Aktif</h3>
                </div>
            </header>

            <main class="flex-grow overflow-y-auto">
                @forelse($packages as $package)
                    <article class="w-full border-b border-gray-200 px-7 py-7">
                        <div class="flex flex-row gap-4 items-center">
                            <img src="{{ URL('images/paket.png') }}" alt="Paket Image" class="w-12 h-12" loading="lazy">

                            <div class="flex flex-col flex-grow">
                                <div class="flex flex-row justify-between items-center">
                                    <h3 class="text-lg font-['Inter'] font-semibold">{{ $package['package_name'] }}</h3>
                                    <p class="text-sm font-['Inter'] text-gray-600">Rp
                                        {{ number_format($package['price'], 0, ',', '.') }}</p>
                                </div>

                                <p class="text-sm font-['Inter'] text-gray-600">{{ $package['package_description_mod'] }}
                                </p>
                            </div>
                        </div>
                    </article>
                @empty
                    <p class="text-center">Tidak ada paket bulanan yang tersedia.</p>
                @endforelse
            </main>

            <footer class="mb-5 flex justify-end px-7 pt-3">
                <div class="rounded-full bg-blue-600 py-3 px-7">
                    <h3 class="text-[16px] font-['Inter'] text-white">Upgrade Paket</h3>
                </div>
            </footer>
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
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">

                                <td class="px-6 py-4">
                                    {{ $history['transaction_date'] }}
                                </td>
                                <td class="px-3 py-4">
                                    {{ $history['transaction_name'] }} <br> {{ $history['transaction_code'] }}
                                </td>
                                <td class="px-6 py-4">
                                    Rp {{ number_format($history['amount_total'], 0, ',', '.') }}
                                </td>
                                <td class="px-[10px] py-4">
                                    @if ($history['status'] == 'pending')
                                        <div
                                            class="font-['Inter'] text-sm text-center py-1 px-1 font-bold bg-red-100 text-red-600 rounded-full">
                                            Menunggu Pembayaran</div>
                                    @else
                                        <div
                                            class="font-['Inter'] text-center py-1 px-1 font-bold bg-green-100 text-green-600 rounded-full">
                                            {{ $history['status'] }}</div>
                                    @endif

                                </td>
                                <td class="px-6 py-4">
                                    <div
                                        class="font-['Inter'] text-center py-2 px-4 font-bold bg-white border rounded-full flex items-center justify-center gap-2">
                                        <svg class="w-4 h-4 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                            fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M14.707 7.793a1 1 0 0 0-1.414 0L11 10.086V1.5a1 1 0 0 0-2 0v8.586L6.707 7.793a1 1 0 1 0-1.414 1.414l4 4a1 1 0 0 0 1.416 0l4-4a1 1 0 0 0-.002-1.414Z" />
                                            <path
                                                d="M18 12h-2.55l-2.975 2.975a3.5 3.5 0 0 1-4.95 0L4.55 12H2a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-4a2 2 0 0 0-2-2Zm-3 5a1 1 0 1 1 0-2 1 1 0 0 1 0 2Z" />
                                        </svg>
                                        Invoice
                                    </div>
                                </td>
                            </tr>
                        @endforeach


                    </tbody>
                </table>
            </div>
            <div class="flex justify-end pr-7 mt-10 gap-2">
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


@endsection
