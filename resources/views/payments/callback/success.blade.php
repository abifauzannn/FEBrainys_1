@extends('layouts.template')

@section('title', 'Callback')

@section('meta')
    <meta name="robots" content="noindex, nofollow">
@endsection

@section('content')
    <!-- Header -->
    <div class=" container w-full mx-auto px-4 py-3 justify-center bg-white border-b border-zinc-200 font-['Inter']">
        <div class="container mx-auto px-4 ">
            <a href="/dashboard">
                <img src="{{ URL('images/newlogo.png') }}" alt="" class="w-[120px] md:w-[140px] object-cover"
                    loading="lazy">
            </a>
        </div>
    </div>

    <!-- Centered Content -->
    <div class="flex flex-col items-center justify-center  font-['Inter']" style="min-height: calc(100vh - 66px);">
        <div class="bg-white flex flex-col justify-center items-center rounded-md w-3/6 shadow-lg">
            <div class="w-full bg-[#F9F9F9] px-4 rounded-t-md py-3">
                <p class="text-black font-bold font-['Inter'] text-[16px]">Pembayaran Berhasil</p>
            </div>
            <div class="w-full rounded-md flex flex-col items-center justify-center py-10 ">
                <img src="{{ URL('images/payment-sukses.png') }}" alt="" class="w-[150px] h-[100px]">
                <p class="text-black font-bold font-['Inter'] text-center mb-3 text-[20px]">Terima kasih telah
                    melakukan
                    pembayaran</p>
                <p class="text-black font-bold font-['Inter'] text-[14px] text-center mb-2">Pembayaran dengan No. Transaksi
                    BR-22724-001912101 <br class="mt-1">
                    telah kami terima dan paket anda telah aktif!</p>
                <button type="submit"
                    class="w-[30%] px-2 h-[34px] flex justify-center items-center py-5 bg-white rounded-lg shadow border border-blue-500 mb-14 text-blue-500 hover:bg-gray-100 duration-300 ease-in-out transition group">
                    <p class="text-blue-500 text-[14px] text-center font-medium font-['Inter']">
                        Kembali ke halaman awal
                    </p>

                </button>
                <p class="text-black font-bold font-['Inter'] text-[14px] mb-1">Jika anda mengalami kendala silakan klik
                    bantuan di bawah ini</p>
                <button class="group w-[30%] h-[34px] px-2  flex justify-center items-center text-blue-500 " type="button">
                    <img src="{{ URL('images/whatsapp.png') }}" alt="WhatsApp Logo" class="w-5 h-5 object-cover mr-2">
                    <a href="https://wa.link/z2edgq" target="_blank"
                        class="text-center text-base font-medium leading-normal flex flex-col group-hover:font-bold transition duration-300 ease-in-out">
                        Bantuan
                    </a>
                </button>
            </div>
        </div>

    </div>
@endsection
