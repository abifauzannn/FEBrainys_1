@extends('layouts.template')

@section('title', 'Langganan - Brainys')

@section('meta')
    <meta name="robots" content="noindex, nofollow">
@endsection

@section('content')
    @if (!isset($data))
        <script>
            window.location.href = "{{ route('dashboard') }}";
        </script>
    @else
        <x-nav></x-nav>
        <div class="container mx-auto px-4 py-6 sm:px-10 sm:py-9 relative">
            <x-back-button url="{{ route('langganan.tagihan') }}" />

            <div class="flex flex-col items-center justify-center">
                <img src="{{ URL('images/Steps3.png') }}" alt="" class="w-[309px] h-[84px]">

                <div class="bg-[#F9F9F9] w-5/6 mt-6 px-5 py-10 flex flex-col justify-center items-center rounded-md">
                    <div class="w-[90%] px-4 py-4">
                        <p class="mb-5 text-black font-bold font-['Inter'] text-[16px] text-center">Terima kasih telah
                            memilih
                            paket dan metode pembayaran. Nomor Transaksi ini berlaku selama 24 jam.
                            Harap segera lakukan pembayaran agar paket yang Anda pilih dapat segera diproses.</p>
                        <div class="flex flex-col justify-start bg-white shadow-lg rounded-md">
                            <!-- Header Section -->
                            <div
                                class="flex flex-row justify-between items-center py-3 px-3 bg-[#F9F9F9] border border-gray-200 rounded-t-md">
                                <p class="text-black font-bold font-['Inter'] text-[16px]">Rincian Pembayaran</p>
                                <p
                                    class="bg-[#EDEDED] px-4 py-2 rounded-full text-gray-500 font-bold font-['Inter'] text-[14px]">
                                    Menunggu Pembayaran</p>
                            </div>

                            <div class="flex flex-row justify-between px-14 py-5">

                                <!-- Left Section -->
                                <div class="flex flex-col  w-[37%]">

                                    <!-- Metode Pembayaran -->
                                    <div class="mb-3">
                                        <p class="text-black font-bold font-['Inter'] text-[14px]">Metode Pembayaran</p>
                                        <p class="text-gray-400 font-['Inter'] text-[14px]">
                                            {{ $data['transaction_payment']['service_name'] }}</p>
                                    </div>

                                    <!-- QR Code -->
                                    @if ($data['transaction_payment']['service_name'] === 'QRIS Custom')
                                        <div class="mb-3 items-center flex flex-col gap-3">
                                            <p>Silahkan scan QR CODE di bawah ini</p>
                                            <img src="{{ $data['transaction_payment']['qrcode_url'] }}" alt="QR Code"
                                                class="w-[200px]">
                                        </div>
                                    @else
                                        <div class=" flex flex-col">
                                            <p class="text-black font-bold font-['Inter'] text-[14px]">Silahkan lakukan
                                                pembayaran menggunakan nomor VA di bawah ini</p>
                                            <div class="w-full h-[34px] inline-flex items-center justify-between">
                                                <p id="va-number" class="text-black text-[14px] font-medium font-['Inter']">
                                                    {{ $data['transaction_payment']['virtual_account'] }}
                                                </p>
                                                <div class="text-blue-500 flex items-center px-1 rounded-full text-xs cursor-pointer"
                                                    onclick="copyToClipboard('va-number', 'copy-text-va')">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                        fill="currentColor" class="size-6">
                                                        <path
                                                            d="M16.5 6a3 3 0 0 0-3-3H6a3 3 0 0 0-3 3v7.5a3 3 0 0 0 3 3v-6A4.5 4.5 0 0 1 10.5 6h6Z" />
                                                        <path
                                                            d="M18 7.5a3 3 0 0 1 3 3V18a3 3 0 0 1-3 3h-7.5a3 3 0 0 1-3-3v-7.5a3 3 0 0 1 3-3H18Z" />
                                                    </svg>
                                                    <span id="copy-text-va">Salin</span>
                                                </div>
                                            </div>

                                        </div>
                                    @endif

                                    <!-- Button Tata Cara Pembayaran -->
                                    <button type="submit"
                                        class="w-full px-2 h-[34px] inline-flex items-center justify-between pt-3 pb-3 bg-white rounded-lg shadow border border-blue-500 mb-3 text-blue-500 hover:bg-gray-100 duration-300 ease-in-out transition group">
                                        <p class="text-blue-500 text-[14px] font-medium font-['Inter']">
                                            Tata Cara Pembayaran
                                        </p>
                                        <p class="text-white bg-blue-500 px-1 rounded-full text-xs">
                                            ?
                                        </p>
                                    </button>

                                    <!-- Nomor VA -->


                                    <div class="mb-3">
                                        <p class="text-black font-bold font-['Inter'] text-[14px]">Jumlah Pembayaran</p>
                                        <div class="w-full h-[34px] inline-flex items-center justify-between">
                                            <p id="amount-number" class="text-black font-bold text-[14px] font-['Inter']">
                                                Rp {{ number_format($data['transaction']['amount_total'], 0, ',', '.') }}
                                            </p>
                                            <div class="text-blue-500 flex items-center px-1 rounded-full text-xs cursor-pointer"
                                                onclick="copyToClipboard('amount-number', 'copy-text-amount')">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                    fill="currentColor" class="size-6">
                                                    <path
                                                        d="M16.5 6a3 3 0 0 0-3-3H6a3 3 0 0 0-3 3v7.5a3 3 0 0 0 3 3v-6A4.5 4.5 0 0 1 10.5 6h6Z" />
                                                    <path
                                                        d="M18 7.5a3 3 0 0 1 3 3V18a3 3 0 0 1-3 3h-7.5a3 3 0 0 1-3-3v-7.5a3 3 0 0 1 3-3H18Z" />
                                                </svg>
                                                <span id="copy-text-amount">Salin</span>
                                            </div>
                                        </div>

                                        <div class="bg-gray-100 p-3 rounded-md">
                                            <div class="w-full h-[34px] inline-flex items-center justify-between">
                                                <p id="basic-package"
                                                    class="text-black font-bold text-[14px] font-['Inter']">
                                                    {{ $data['transaction']['transaction_name'] }}
                                                </p>
                                                <div class="text-gray-400 font-['Inter'] text-sm ">
                                                    <p>Rp
                                                        {{ number_format($data['transaction']['amount_sub'], 0, ',', '.') }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="w-full h-[34px] inline-flex items-center justify-between">
                                                <p id="transaction-fee"
                                                    class="text-black font-bold text-[14px] font-['Inter']">
                                                    Biaya Transaksi
                                                </p>
                                                <div class="text-gray-400 font-['Inter'] text-sm ">
                                                    <p>Rp
                                                        {{ number_format($data['transaction']['amount_fee'], 0, ',', '.') }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Right Section -->
                                <div class="flex flex-col  w-[37%]">
                                    <div class="mb-3">
                                        <p class="text-black font-bold font-['Inter'] text-[14px]">No Transaksi</p>
                                        <p class="text-gray-400 font-['Inter'] text-[14px]">
                                            {{ $data['transaction']['transaction_code'] }}</p>
                                    </div>

                                    <div class="mb-3">
                                        <p class="text-black font-bold font-['Inter'] text-[14px]">Waktu Transaksi</p>
                                        <p class="text-gray-400 font-['Inter'] text-[14px]">
                                            {{ date('d F Y | H:i', strtotime($data['transaction']['transaction_date'])) }}
                                        </p>
                                    </div>

                                    <div class="mb-3">
                                        <p class="text-black font-bold font-['Inter'] text-[14px]">Rincian Pembelian</p>
                                        <p class="text-gray-400 font-['Inter'] text-[14px]">
                                            {{ $data['transaction']['transaction_name'] }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

        <script>
            function copyToClipboard(elementId, copyTextId) {
                var copyText = document.getElementById(copyTextId);
                var textToCopy = document.getElementById(elementId).innerText;
                navigator.clipboard.writeText(textToCopy).then(function() {
                    copyText.innerText = 'Tersalin';
                    setTimeout(function() {
                        copyText.innerText = 'Salin';
                    }, 2000);
                }, function(err) {
                    console.error('Gagal menyalin teks: ', err);
                });
            }
        </script>
    @endif
@endsection
