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

    @if ($data['transaction']['status'] == 'completed')
    <div class="flex flex-col items-center justify-center  font-['Inter']"
        style="min-height: calc(100vh - 66px);">
        <div class="bg-white flex flex-col justify-center items-center rounded-md w-full md:w-3/6 shadow-lg">
            <div class="w-full bg-[#F9F9F9] px-4 rounded-t-md py-3">
                <p class="text-black font-bold font-['Inter'] text-[16px]">Pembayaran Berhasil</p>
            </div>
            <div class="w-full rounded-md flex flex-col items-center justify-center py-10 ">
                <img src="{{ URL('images/payment-sukses.png') }}" alt="" class="w-[150px] h-[100px]">
                <p class="text-black font-bold font-['Inter'] text-center mb-3 text-[20px]">Terima kasih telah
                    melakukan
                    pembayaran</p>
                <p class="text-black font-bold font-['Inter'] text-[14px] text-center mb-2">Pembayaran dengan
                    No. Transaksi
                    {{ $data['transaction']['transaction_code'] }}
                    <br class="mt-1">
                    telah kami terima dan paket anda telah aktif!
                </p>
                <a href="{{ route('dashboard') }}"
                    class="w-[70%] md:w-[50%] px-2 h-[34px] flex justify-center items-center mt-10 bg-white rounded-lg shadow border border-blue-500 mb-14 text-blue-500 hover:bg-gray-100 duration-300 ease-in-out transition group">
                    <p class="text-blue-500 text-[14px] text-center font-medium font-['Inter']">
                        Kembali ke halaman awal
                    </p>
                </a>

                <p class="text-black font-bold font-['Inter'] text-[14px] mb-1 text-center">Jika anda mengalami
                    kendala
                    silakan klik
                    bantuan di bawah ini</p>
                <button class="group w-[30%] h-[34px] px-2  flex justify-center items-center text-blue-500 "
                    type="button">
                    <img src="{{ URL('images/whatsapp.png') }}" alt="WhatsApp Logo"
                        class="w-5 h-5 object-cover mr-2">
                    <a href="https://wa.link/z2edgq" target="_blank"
                        class="text-center text-base font-medium leading-normal flex flex-col group-hover:font-bold transition duration-300 ease-in-out">
                        Bantuan
                    </a>
                </button>
            </div>
        </div>

    </div>
    @elseif ($data['transaction']['status'] == 'canceled')
    <div class="flex flex-col items-center justify-center  font-['Inter']"
        style="min-height: calc(100vh - 66px);">
        <div class="bg-white flex flex-col justify-center items-center rounded-md w-full md:w-3/6 shadow-lg">
            <div class="w-full bg-[#F9F9F9] px-4 rounded-t-md py-3">
                <p class="text-black font-bold font-['Inter'] text-[16px]">Pembayaran Dibatalkan!</p>
            </div>
            <div class="w-full rounded-md flex flex-col items-center justify-center py-10 ">
                <img src="{{ URL('images/payment-failed.png') }}" alt="" class="w-[150px] h-[100px]">
                <p class="text-black font-bold font-['Inter'] text-center mb-3 text-[20px]">Pembayaran anda
                    dibatalkan oleh sistem</p>
                <p class="text-black font-bold font-['Inter'] text-[14px] text-center mb-2">Pembayaran dengan
                    No. Transaksi
                    {{ $data['transaction']['transaction_code'] }}
                    <br class="mt-1">
                    dibatalkan
                </p>
                <a href="{{ route('dashboard') }}"
                    class="w-[70%] md:w-[50%] px-2 h-[34px] flex justify-center items-center mt-10 bg-white rounded-lg shadow border border-blue-500 mb-14 text-blue-500 hover:bg-gray-100 duration-300 ease-in-out transition group">
                    <p class="text-blue-500 text-[14px] text-center font-medium font-['Inter']">
                        Kembali ke halaman awal
                    </p>
                </a>
                <p class="text-black font-bold font-['Inter'] text-[14px] mb-1 text-center">Jika anda mengalami
                    kendala
                    silakan klik
                    bantuan di bawah ini</p>
                <button class="group w-[30%] h-[34px] px-2  flex justify-center items-center text-blue-500 "
                    type="button">
                    <img src="{{ URL('images/whatsapp.png') }}" alt="WhatsApp Logo"
                        class="w-5 h-5 object-cover mr-2">
                    <a href="https://wa.link/z2edgq" target="_blank"
                        class="text-center text-base font-medium leading-normal flex flex-col group-hover:font-bold transition duration-300 ease-in-out">
                        Bantuan
                    </a>
                </button>
            </div>
        </div>

    </div>
    @else
    <div class="flex flex-col items-center justify-center">
        <img src="{{ URL('images/Steps3.png') }}" alt="Steps Image" class="w-[200px] sm:w-[309px] h-auto">

        <div
            class="bg-[#F9F9F9] w-full sm:w-5/6 mt-6 px-3 sm:px-5 py-6 sm:py-10 flex flex-col justify-center items-center rounded-md">
            <div class="w-full sm:w-[90%] px-2 sm:px-4 py-4">
                <p class="mb-5 text-black font-bold text-[14px] sm:text-[16px] text-center">Terima kasih telah
                    memilih paket dan metode pembayaran. Nomor Transaksi ini berlaku selama 24 jam. Harap segera
                    lakukan pembayaran agar paket yang Anda pilih dapat segera diproses.</p>

                <div class="flex flex-col justify-start bg-white shadow-lg rounded-md">
                    <!-- Header Section -->
                    <div
                        class="flex flex-row justify-between items-center py-3 px-3 bg-[#F9F9F9] border border-gray-200 rounded-t-md">
                        <p class="text-black font-bold text-[14px] sm:text-[16px]">Rincian Pembayaran</p>
                        <p
                            class="bg-[#EDEDED] px-3 sm:px-4 py-1 sm:py-2 rounded-full text-gray-500 font-bold text-[12px] sm:text-[14px] text-center">
                            Menunggu Pembayaran</p>
                    </div>

                    <div class="flex flex-col sm:flex-row justify-between px-4 sm:px-14 py-5">
                        <!-- Left Section -->
                        <div class="flex flex-col w-full sm:w-[37%]">

                            
                            <!-- Button Tata Cara Pembayaran -->
                           

                            <!-- Jumlah Pembayaran -->
                            <div class="mb-3">
                                
                                


                                <div class="bg-gray-100 p-3 rounded-md">
                                    <div class="w-full h-[34px] inline-flex items-center justify-between">
                                        <p id="basic-package" class="text-black font-bold text-[14px]">
                                            {{ $data['transaction']['transaction_name'] }}
                                        </p>
                                        <div class="text-gray-400 text-sm">
                                            <p>Rp
                                                {{ number_format($data['transaction']['amount_sub'], 0, ',', '.') }}
                                            </p>
                                        </div>
                                    </div>

                                    <div class="w-full h-[34px] inline-flex items-center justify-between">
                                        <p id="transaction-fee" class="text-black font-bold text-[14px]">Biaya
                                            Transaksi</p>
                                        <div class="text-gray-400 text-sm">
                                            <p>Rp
                                                {{ number_format($data['transaction']['amount_fee'], 0, ',', '.') }}
                                            </p>
                                        </div>
                                    </div>

                                    <div class="w-full h-[34px] inline-flex items-center justify-between">
                                        <p id="total-amount" class="text-black font-bold text-[14px]">Jumlah
                                            Pembayaran</p>
                                        <div class="text-gray-400 text-sm">
                                            <p>Rp
                                                {{ number_format($data['transaction']['amount_total'], 0, ',', '.') }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Right Section (if needed) -->
                        <div class="flex flex-col w-full sm:w-[37%] mt-4 sm:mt-0">

                            <div class="mb-3">
                                <p class="text-black font-bold text-[14px]">No Transaksi</p>
                                <p class="text-gray-400 text-[14px]">
                                    {{ $data['transaction']['transaction_code'] }}
                                </p>
                            </div>

                            <div class="mb-3">
                                <p class="text-black font-bold text-[14px]">Waktu Transaksi</p>
                                <p class="text-gray-400 text-[14px]">
                                    {{ date('d F Y | H:i', strtotime($data['transaction']['transaction_date'])) }}
                                </p>
                            </div>

                            <div class="mb-3">
                                <p class="text-black font-bold text-[14px]">Rincian Pembelian</p>
                                <p class="text-gray-400 text-[14px]">
                                    {{ $data['transaction']['transaction_name'] }}
                                </p>
                            </div>

                            <div id="order-details">
                                <p class="hidden">Transaction Code:
                                    {{ $data['transaction']['transaction_code'] }}
                                </p>
                                <p class="hidden">Status: <span
                                        id="order-status">{{ $data['transaction']['status'] }}</span>
                                </p>
                            </div>

                            <div class="my-5">
                                <a href="{{ $linkPayment }}" target="_blank" rel="noopener noreferrer" class="mt-32 rounded-md w-auto bg-blue-500 px-3 py-3 text-[16px] text-white font-semibold">Lanjutkan ke Pembayaran</a>
                            </div>

                        </div>
                        <!-- You can add more details here if necessary -->

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        // Buat koneksi SSE ke endpoint
        const eventSource = new EventSource(`/events?transaction_code={{ $data['transaction']['transaction_code'] }}`);

        eventSource.onmessage = function(event) {
            const data = JSON.parse(event.data);
            const statusElement = document.getElementById('order-status');
            statusElement.textContent = data.status;

            // Jika status tidak pending, tutup koneksi
            if (data.status !== 'pending') {
                eventSource.close();
            }
        };

        function copyToClipboard(elementId, copyTextId) {
            // Ambil teks dari elemen yang ingin disalin
            const copyText = document.getElementById(elementId).textContent;

            // Ekstrak hanya angka dari teks menggunakan regex
            const onlyNumbers = copyText.match(/\d+/g)?.join('') || '';

            // Buat elemen input sementara untuk menyalin teks
            const tempInput = document.createElement('input');
            tempInput.value = onlyNumbers; // Setel input dengan angka saja
            document.body.appendChild(tempInput);

            // Salin teks ke clipboard
            tempInput.select();
            document.execCommand('copy');
            document.body.removeChild(tempInput);

            // Ubah teks tombol sementara untuk memberikan feedback
            const copyButton = document.getElementById(copyTextId);
            copyButton.textContent = 'Tersalin';
            setTimeout(() => {
                copyButton.textContent = 'Salin';
            }, 2000);
        }
    </script>
    @endif
</div>
@endif

@endsection