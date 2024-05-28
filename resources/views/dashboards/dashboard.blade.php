@extends('layouts.template')

@section('title', 'Dashboard - Brainys')

@section('content')
    <x-nav></x-nav>



    <div class="container mx-auto px-[20px] sm:px-10 py-5 font-['Inter'] w-full a=re">



        <div id="welcomePopup"
            class="fixed top-0 left-0 w-full h-full bg-black bg-opacity-50 flex justify-center items-center hidden">
            <div class="bg-white w-64 p-6 rounded-lg shadow-md text-center">
                <div class="text-blue-600 font-bold text-lg mb-2">Hello {{ session('user')['name'] }}!, Welcome to Brainys👋
                </div>
                <div class="text-gray-800 font-normal mb-4">{{ session('success') }}</div>
                <button id="closeWelcomePopup"
                    class="bg-blue-600 text-white font-semibold py-2 px-4 rounded hover:bg-blue-700 focus:outline-none focus:bg-blue-700">Close</button>
            </div>
        </div>

        <div id="otpModal"
            class="fixed inset-0 z-50 overflow-auto bg-black bg-opacity-50 flex justify-center items-center hidden">
            <div class="bg-white rounded-lg p-8 max-w-md relative">
                <span id="closeOtpModal" class="absolute top-0 right-0 p-4 cursor-pointer">&times;</span>
                <p class="text-gray-900 text-base font-['Inter'] leading-normal font-semibold mt-[30px]">Masukkan
                    Invitation
                    Code Anda</p>
                <div class="flex justify-center mt-4 space-x-2">
                    <input type="text" id="otp1"
                        class="w-10 p-2 font-bold rounded-md text-center text-sky-600 text-xl placeholder:font-medium font-['Inter'] leading-normal focus:outline-none focus:border-none"
                        maxlength="1" autofocus>
                    <input type="text" id="otp2"
                        class="w-10 p-2 font-bold rounded-md text-center text-sky-600 text-xl placeholder:font-medium font-['Inter'] leading-normal focus:outline-none focus:border-none"
                        maxlength="1">
                    <input type="text" id="otp3"
                        class="w-10 p-2 font-bold rounded-md text-center text-sky-600 text-xl placeholder:font-medium font-['Inter'] leading-normal focus:outline-none focus:border-none"
                        maxlength="1">
                    <input type="text" id="otp4"
                        class="w-10 p-2 font-bold rounded-md text-center text-sky-600 text-xl placeholder:font-medium font-['Inter'] leading-normal focus:outline-none focus:border-none"
                        maxlength="1">
                    <input type="text" id="otp5"
                        class="w-10 p-2 font-bold rounded-md text-center text-sky-600 text-xl placeholder:font-medium font-['Inter'] leading-normal focus:outline-none focus:border-none"
                        maxlength="1">
                </div>
                <button id="submitOtpButton"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-4 font-['Inter']">Submit</button>
            </div>
        </div>

        @if (session('success'))
            <script>
                const otpModal = document.getElementById('otpModal');
                // Tampilkan popup ketika halaman dimuat
                window.addEventListener('DOMContentLoaded', (event) => {
                    // Tampilkan popup welcoming
                    document.getElementById('welcomePopup').classList.remove('hidden');

                    // Sembunyikan popup setelah tombol ditutup
                    document.getElementById('closeWelcomePopup').addEventListener('click', function() {
                        document.getElementById('welcomePopup').classList.add('hidden');
                        otpModal.classList.remove('hidden');
                    });

                    document.getElementById("closeOtpModal").addEventListener('click', function() {
                        otpModal.classList.add("hidden");
                    });

                    // Event listener untuk tombol submit modal
                    document.getElementById("submitOtpButton").addEventListener('click', function() {
                        otpModal.classList.add("hidden");
                        // Tambahkan logika submit OTP di sini, jika diperlukan
                    });

                    const otpInputs = document.querySelectorAll('#otpModal input[type="text"]');
                    otpInputs.forEach((input, index) => {
                        input.addEventListener('input', () => {
                            if (input.value.length === 1 && index < otpInputs.length - 1) {
                                otpInputs[index + 1].focus();
                            }
                        });

                        input.addEventListener('keydown', (e) => {
                            if (e.key === 'Backspace' && input.value === '' && index > 0) {
                                otpInputs[index - 1].focus();
                            }
                        });
                    });

                    // Sembunyikan popup setelah 3 detik
                    setTimeout(function() {
                        document.getElementById('welcomePopup').classList.add('hidden');
                        otpModal.classList.remove('hidden');
                    }, 3000);
                });
            </script>
        @endif


        <div class="w-full h-[134px] mb-[25px] sm:mb-3">
            <div class="bg-gray-900 py-4 px-4 md:py-7 md:px-[51px] gap-3 rounded-2xl">
                <div class=" text-white text-3xl md:text-[32px] font-bold font-['Inter'] leading-[49.99px]">
                    Selamat
                    datang</div>
                <div class=" text-white text-md sm:text-xs font-normal font-['Inter'] leading-tight">Brainys
                    merupakan aplikasi AI Text Generation untuk kebutuhan administrasi dan akademik</div>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 gap-2">
            <button onclick="window.location.href='/generate-modul-ajar'"
                class="p-4 rounded-lg shadow border border-gray-300 hover:bg-slate-50 transition duration-300 ease-in-out flex flex-col">
                <img src="{{ URL('images/book-open.svg') }}" alt="" class="w-6 h-6">
                <div class="text-gray-900 text-lg font-bold font-inter leading-normal py-2">Templat Modul Ajar</div>
                <div class="text-black text-xs font-normal font-inter leading-normal">Gunakan templat modul ajar kurikulum
                    merdeka</div>
            </button>

            <button onclick="window.location.href='/generate-syllabus'"
                class="p-4 rounded-lg shadow border border-gray-300 hover:bg-slate-50 transition duration-300 ease-in-out flex flex-col">
                <img src="{{ URL('images/book-open.png') }}" alt="" class="w-6 h-6">
                <div class="text-gray-900 text-lg font-bold font-inter leading-normal py-2">Templat Silabus</div>
                <div class="text-black text-xs font-normal font-inter leading-normal">Gunakan templat silabus merdeka
                    belajar</div>
            </button>

            <button onclick="window.location.href='/generate-essay'"
                class="p-4 rounded-lg shadow border border-gray-300 hover:bg-slate-50 transition duration-300 ease-in-out flex flex-col">
                <img src="{{ URL('images/document-text.png') }}" alt="" class="w-6 h-6">
                <div class="text-gray-900 text-lg font-bold font-inter leading-normal py-2">Templat Soal</div>
                <div class="text-black text-xs font-normal font-inter leading-normal">Gunakan templat soal untuk sekolah
                </div>
            </button>
        </div>








    </div>


@endsection
