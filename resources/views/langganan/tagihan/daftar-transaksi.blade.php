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
                        {{-- <td class="px-6 py-4">
                            Langganan Paket A <br> BR-22724-001912101
                        </td>
                        <td class="px-6 py-4">
                            Rp 15.000
                        </td>
                        <td class="px-10 py-4">
                            <div
                                class="font-['Inter'] text-center py-1 px-2 font-bold bg-green-100 text-green-600 rounded-full">
                                Dibayar</div>
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
                        </td> --}}
                    </tr>
                @endforeach


            </tbody>
        </table>
    </div>
    <div class="flex justify-end pr-7 mt-10">
        <nav aria-label="Page navigation">
            <ul class="inline-flex items-center -space-x-px">
                <li>
                    <a href="#"
                        class="px-3 py-2 ml-0 leading-tight text-gray-500 bg-white border border-gray-300 rounded-l-lg hover:bg-gray-100 hover:text-gray-700 active active:bg-blue-300 active:text-blue-600">
                        < </a>
                </li>
                <li>
                    <a href="#"
                        class="px-3 py-2 ml-0 leading-tight text-gray-500 bg-white border border-gray-300 rounded-l-lg hover:bg-gray-100 hover:text-gray-700">1</a>
                </li>
                <li>
                    <a href="#"
                        class="px-3 py-2 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700">2</a>
                </li>
                <li>
                    <a href="#"
                        class="px-3 py-2 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700">3</a>
                </li>
                <li>
                    <a href="#"
                        class="px-3 py-2 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700">4</a>
                </li>
                <li>
                    <a href="#"
                        class="px-3 py-2 leading-tight text-gray-500 bg-white border border-gray-300 rounded-r-lg hover:bg-gray-100 hover:text-gray-700">5</a>
                </li>
                <li>
                    <a href="#"
                        class="px-3 py-2 leading-tight text-gray-500 bg-white border border-gray-300 rounded-r-lg hover:bg-gray-100 hover:text-gray-700">>
                    </a>
                </li>
            </ul>
        </nav>
    </div>



</div>
