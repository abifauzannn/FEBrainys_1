@extends('layouts.template')

@section('title', 'Verify OTP')

@section('content')

    <div class="container mx-auto flex items-center justify-center flex-col mt-10">
        <img src="{{ URL('images/Steps.png') }}" alt="" class="w-[206px] h-[84px]">
        <div class="w-[380px] sm:w-[412px] h-[358px] flex items-center justify-center flex-col mt-20 sm:mt-[88px]">
            <img src="{{ URL('images/envelope.svg') }}" alt="">
            <div class="text-gray-900 text-4xl font-['Inter'] font-bold mt-4 mb-4">OTP Email</div>
            <div class="text-center text-gray-900 text-base font-medium font-['Inter'] leading-normal mb-12">Silakan
                cek kode OTP pada inbox email anda untuk </div>

            <form action="{{ route('verify.otp.post') }}" method="post">
                @csrf
                <input type="hidden" name="email" value="{{ $email }}">
                <input type="hidden" name="otp" value="{{ $otp }}">
                <div class="flex gap-4 justify-between">
                    <input type="text"
                        class="w-11 h-12 rounded-md text-center bg-gray-50 text-sky-600 text-xl font-medium font-['Inter'] leading-normal focus:outline-none focus:border-none p-2"
                        maxlength="1" id="digit1" oninput="handleInput(this)" placeholder="0"
                        value="{{ $otp[0] }}">
                    <input type="text"
                        class="w-11 h-12 rounded-md text-center bg-gray-50 text-sky-600 text-xl font-medium font-['Inter'] leading-normal focus:outline-none focus:border-none p-2"
                        maxlength="1" id="digit2" oninput="handleInput(this)" placeholder="0"
                        value="{{ $otp[1] }}">
                    <input type="text"
                        class="w-11 h-12 rounded-md text-center bg-gray-50 text-sky-600 text-xl font-medium font-['Inter'] leading-normal focus:outline-none focus:border-none p-2"
                        maxlength="1" id="digit3" oninput="handleInput(this)" placeholder="0"
                        value="{{ $otp[2] }}">
                    <input type="text"
                        class="w-11 h-12 rounded-md text-center bg-gray-50 text-sky-600 text-xl font-medium font-['Inter'] leading-normal focus:outline-none focus:border-none p-2"
                        maxlength="1" id="digit4" oninput="handleInput(this)" placeholder="0"
                        value="{{ $otp[3] }}">
                    <input type="text"
                        class="w-11 h-12 rounded-md text-center bg-gray-50 text-sky-600 text-xl font-medium font-['Inter'] leading-normal focus:outline-none focus:border-none p-2"
                        maxlength="1" id="digit5" oninput="handleInput(this)" placeholder="0"
                        value="{{ $otp[4] }}">
                    <input type="text"
                        class="w-11 h-12 rounded-md text-center bg-gray-50 text-sky-600 text-xl font-medium font-['Inter'] leading-normal focus:outline-none focus:border-none p-2"
                        maxlength="1" id="digit6" oninput="handleInput(this)" placeholder="0"
                        value="{{ $otp[5] }}">
                </div>

                <button type="submit"
                    class="w-full h-12 px-6 py-3 rounded-[50px] justify-center items-center gap-2 inline-flex mt-8 bg-blue-400 text-white">
                    <div class="text-center text-base font-medium font-['Inter'] leading-normal">Konfirmasi</div>
                </button>
            </form>
            <div class="flex justify-center mt-8">
                <form action="{{ route('resend-otp') }}" method="POST">
                    @csrf
                    <input type="hidden" name="email" value="{{ $email }}">
                    <p class="text-black text-base font-normal font-['Inter'] leading-[30px] mr-2">Kirim
                        ulang kode OTP
                    </p>
                    <div id="countdown" class="text-blue-600 text-base font-normal font-['Inter'] leading-[30px]">2:00</div>
                    <button type="submit" id="resendBtn" class="hidden text-blue-700">
                        Kirim Kode
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let totalSeconds = 0 * 60; // 2 menit
            let minutes, seconds;

            function updateCountdown() {
                minutes = Math.floor(totalSeconds / 60);
                seconds = totalSeconds % 60;

                document.getElementById('countdown').innerText = `${minutes}:${seconds < 10 ? '0' : ''}${seconds}`;

                if (totalSeconds <= 0) {
                    // Countdown selesai, tampilkan tombol "Kirim Ulang"
                    document.getElementById('countdown').classList.add('hidden');
                    document.getElementById('resendBtn').classList.remove('hidden');
                } else {
                    totalSeconds--;
                    setTimeout(updateCountdown, 1000); // Perbarui setiap 1 detik
                }
            }

            function restartCountdown() {
                // Reset nilai detik dan tampilkan countdown
                totalSeconds = 2 * 60;
                updateCountdown();
                document.getElementById('countdown').classList.remove('hidden');
                document.getElementById('resendBtn').classList.add('hidden');
            }

            // Tambahkan event listener untuk tombol "Kirim Ulang"
            document.getElementById('resendBtn').addEventListener('click', restartCountdown);

            // Mulai countdown pertama kali
            updateCountdown();
        });
    </script>

@endsection
