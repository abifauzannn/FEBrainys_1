@extends('layouts.template')

@section('title', 'Dashboard - Brainys')

@section('meta')
    <meta name="robots" content="noindex, nofollow">
@endsection

@section('content')
    <x-nav></x-nav>

    <div class="container mx-auto px-[20px] py-5 font-['Inter'] w-full">

        <div id="welcomePopup"
            class="fixed top-0 left-0 w-full h-full bg-black bg-opacity-50 flex justify-center items-center hidden">
            <div
                class="bg-white w-[300px] sm:w-[500px] p-5 sm:p-8 rounded-lg shadow-md text-center flex flex-col items-center">
                <img src="{{ URL('images/invitation.png') }}" alt="" class="w-[70%] h-full object-cover mb-4">
                <p class="text-gray-600 text-xs sm:text-base font-['Inter'] leading-normal mb-4">
                    Sebelum anda mulai, masukkan kode undangan dulu yuk!
                </p>
                @if (session('error'))
                    <p class="text-red-600 text-xs sm:text-base font-['Inter'] leading-normal mb-4">
                        {{ session('error') }}
                    </p>
                @endif
                <form id="invitationForm" class="w-full" action="{{ route('reedemCode') }}" method="post">
                    @csrf
                    <input type="text" id="invite_code" name="invite_code"
                        class="w-full  border border-gray-300 rounded-md text-center placeholder:text-xs"
                        placeholder="masukan 8 karakter kode undangan disini" maxlength="8" required>
                    <div class="flex justify-center w-full mt-4 gap-3">
                        <a href="{{ route('logout') }}"
                            class="btnbg-white text-blue-600 font-semibold py-2 px-4 rounded  focus:outline-none mt-4 shadow-md ">
                            Keluar</a>

                        <button type="submit"
                            class="bg-blue-600 text-white font-semibold py-2 px-4 rounded hover:bg-blue-700 focus:outline-none focus:bg-blue-700 mt-4">Submit</button>
                    </div>
                </form>
            </div>
        </div>


        @if (session('success'))
            <script>
                const otpModal = document.getElementById('otpModal');
                const codeField = document.getElementById('invite_code');
                // Tampilkan popup ketika halaman dimuat
                window.addEventListener('DOMContentLoaded', (event) => {
                    // Tampilkan popup welcoming
                    document.getElementById('welcomePopup').classList.remove('hidden');
                    codeField.focus();

                    // Sembunyikan popup setelah tombol ditutup
                    document.getElementById('closeWelcomePopup').addEventListener('click', function() {
                        document.getElementById('welcomePopup').classList.add('hidden');

                    });

                    document.getElementById("closeOtpModal").addEventListener('click', function() {
                        otpModal.classList.add("hidden");
                    });

                    // Sembunyikan popup setelah 3 detik

                });
            </script>
        @endif

        @if (session('user')['is_active'] == 0)
            <script>
                const otpModal = document.getElementById('otpModal');
                const codeField = document.getElementById('invite_code');
                // Tampilkan popup ketika halaman dimuat
                window.addEventListener('DOMContentLoaded', (event) => {
                    // Tampilkan popup welcoming
                    document.getElementById('welcomePopup').classList.remove('hidden');
                    codeField.focus();

                    // Sembunyikan popup setelah tombol ditutup
                    document.getElementById('closeWelcomePopup').addEventListener('click', function() {
                        document.getElementById('welcomePopup').classList.add('hidden');

                    });

                    document.getElementById("closeOtpModal").addEventListener('click', function() {
                        otpModal.classList.add("hidden");
                    });

                    // Sembunyikan popup setelah 3 detik

                });
            </script>
        @endif



        <div class="w-full h-[120px] mb-[40px] sm:mb-3">
            <img src="{{ URL('images/newbanner.png') }}" alt=""
                class="w-full h-[134px] object-cover hidden lg:block p-2">
            <div class="bg-gray-900 py-4 px-4 md:py-7 md:px-[51px] gap-3 rounded-2xl lg:hidden">
                <div class="text-white text-3xl md:text-[32px] font-bold font-['Inter'] leading-[49.99px]">
                    Selamat datang</div>
                <div class="text-white text-md sm:text-xs font-normal font-['Inter'] leading-tight">Brainys
                    merupakan aplikasi AI Text Generation untuk kebutuhan administrasi dan akademik</div>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 gap-2 lg:p-2">

            <x-card onclick="window.location.href='/generate-modul-ajar'" icon="images/modulajar.png" title="Modul Ajar"
                description="Gunakan templat modul ajar kurikulum merdeka" />

            <x-card onclick="window.location.href='/generate-syllabus'" icon="images/syllabus.png" title="Templat Silabus"
                description="Gunakan templat silabus merdeka belajar" />

            <x-card onclick="window.location.href='/generate-essay'" icon="images/soal.png" title="Templat Soal"
                description="Gunakan templat soal untuk sekolah" />
        </div>

    </div>
@endsection
