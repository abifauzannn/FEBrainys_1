@extends('layouts.template')

@section('title', 'Verify OTP - Brainys')

@section('meta')
    <meta name="robots" content="noindex, nofollow">
@endsection

@section('content')

    <div class="container mx-auto flex items-center justify-center flex-col mt-10">
        <img src="{{ URL('images/Steps.png') }}" alt="" class="w-[206px] h-[84px]">
        <div class="w-[380px] sm:w-[412px] h-[358px] flex items-center justify-center flex-col mt-20 sm:mt-[88px]">
            <img src="{{ URL('images/envelope.svg') }}" alt="">
            <div class="text-gray-900 text-4xl font-['Inter'] font-bold mt-4 mb-4">OTP Email</div>
            <div class="text-center text-gray-900 text-base font-medium font-['Inter'] leading-normal mb-12">Silakan
                cek kode OTP pada inbox email anda untuk </div>

            <form action="{{ route('verify.otp.post') }}" method="post">
                @if (session('error'))
                    <div class="flex items-center p-4 mb-4 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50"
                        role="alert">
                        <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                        </svg>
                        <span class="sr-only">Error!</span>
                        <div>
                            <span class="font-medium">{{ session('error') }}</span>
                        </div>
                    </div>
                @endif
                @csrf
                <input type="hidden" name="email" value="{{ $email }}">

                <input type="hidden" id="otpDisplay" name="otp"
                    class="w-full h-12 rounded-md text-center bg-gray-50 text-sky-600 text-xl font-medium font-['Inter'] leading-normal focus:outline-none focus:border-none p-2"
                    placeholder="OTP">

                <div class="flex gap-4 justify-between">
                    <input type="text"
                        class="font-bold  w-11 h-12 rounded-md text-center bg-gray-50 text-sky-600 text-xl placeholder:font-medium font-['Inter'] leading-normal focus:outline-none focus:border-none p-2"
                        maxlength="1" id="digit1" oninput="handleInput(this)" placeholder="0">
                    <input type="text"
                        class="font-bold w-11 h-12 rounded-md text-center bg-gray-50 text-sky-600 text-xl placeholder:font-medium font-['Inter'] leading-normal focus:outline-none focus:border-none p-2"
                        maxlength="1" id="digit2" oninput="handleInput(this)" placeholder="0">
                    <input type="text"
                        class="font-bold w-11 h-12 rounded-md text-center bg-gray-50 text-sky-600 text-xl placeholder:font-medium font-['Inter'] leading-normal focus:outline-none focus:border-none p-2"
                        maxlength="1" id="digit3" oninput="handleInput(this)" placeholder="0">
                    <input type="text"
                        class="font-bold w-11 h-12 rounded-md text-center bg-gray-50 text-sky-600 text-xl placeholder:font-medium font-['Inter'] leading-normal focus:outline-none focus:border-none p-2"
                        maxlength="1" id="digit4" oninput="handleInput(this)" placeholder="0">
                    <input type="text"
                        class="font-bold w-11 h-12 rounded-md text-center bg-gray-50 text-sky-600 text-xl placeholder:font-medium font-['Inter'] leading-normal focus:outline-none focus:border-none p-2"
                        maxlength="1" id="digit5" oninput="handleInput(this)" placeholder="0">
                    <input type="text"
                        class="font-bold w-11 h-12 rounded-md text-center bg-gray-50 text-sky-600 text-xl placeholder:font-medium font-['Inter'] leading-normal focus:outline-none focus:border-none p-2"
                        maxlength="1" id="digit6" oninput="handleInput(this)" placeholder="0">
                </div>

                <button type="submit"
                    class="w-full h-12 px-6 py-3 rounded-[50px] justify-center items-center gap-2 inline-flex mt-8 bg-blue-600 hover:bg-blue-700 focus:bg-blue-700  text-white">
                    <div class="text-center text-base font-medium font-['Inter'] leading-normal">Konfirmasi</div>
                </button>
            </form>
            <div class="flex justify-center mt-8">
                <form action="{{ route('resend-otp') }}" method="POST">
                    @csrf
                    <input type="hidden" name="email" value="{{ $email }}">
                    <div class="inline-flex">
                        <p class="text-black text-base font-normal font-['Inter'] leading-[30px] mr-2">Kirim
                            ulang kode OTP
                        </p>
                        <div id="countdown" class="text-blue-600 text-base font-normal font-['Inter'] leading-[30px]">2:00
                        </div>
                        <button type="submit" id="resendBtn" class="hidden text-blue-700">
                            Kirim Kode
                        </button>
                    </div>


                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let totalSeconds = 2 * 60; // 2 menit
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

        function handleInput(input) {
            // Tangkap nilai dari setiap field input
            const digit1Value = document.getElementById('digit1').value;
            const digit2Value = document.getElementById('digit2').value;
            const digit3Value = document.getElementById('digit3').value;
            const digit4Value = document.getElementById('digit4').value;
            const digit5Value = document.getElementById('digit5').value;
            const digit6Value = document.getElementById('digit6').value;

            // Gabungkan nilai dari setiap field menjadi satu string
            const otpValue = digit1Value + digit2Value + digit3Value + digit4Value + digit5Value + digit6Value;

            // Tampilkan nilai OTP dalam input field tambahan
            document.getElementById('otpDisplay').value = otpValue;

            // Periksa apakah nilai telah dimasukkan
            if (input.value) {
                // Pindahkan fokus ke field berikutnya jika nilai telah dimasukkan
                if (input.nextElementSibling) {
                    input.nextElementSibling.focus();
                }
            } else {
                // Jika nilai dihapus, pindahkan fokus ke field sebelumnya
                if (input.previousElementSibling) {
                    input.previousElementSibling.focus();
                }
            }
        }
    </script>

@endsection
