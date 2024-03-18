@extends('layouts.template')

@section('title', 'Dashboard - Brainys')

@section('content')
    <x-nav></x-nav>

    <div class="container mx-auto px-[20px] sm:px-10 py-5 font-['Inter']">

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

        @if (session('success'))
            <script>
                // Tampilkan popup ketika halaman dimuat
                window.addEventListener('DOMContentLoaded', (event) => {
                    // Tampilkan popup welcoming
                    document.getElementById('welcomePopup').classList.remove('hidden');

                    // Sembunyikan popup setelah tombol ditutup
                    document.getElementById('closeWelcomePopup').addEventListener('click', function() {
                        document.getElementById('welcomePopup').classList.add('hidden');
                    });

                    // Sembunyikan popup setelah 3 detik
                    setTimeout(function() {
                        document.getElementById('welcomePopup').classList.add('hidden');
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



        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-2">
            <button onclick="window.location.href='/generate-modul-ajar'"
                class="p-4 rounded-lg shadow border border-gray-300  lg:mr-6 hover:bg-slate-50 transition duration-300 ease-in-out flex flex-col">
                <img src="{{ URL('images/book-open.svg') }}" alt="" class="w-6 h-6">
                <div class="text-gray-900 text-lg font-bold font-inter leading-normal py-2">Templat Modul Ajar</div>
                <div class="text-black text-xs font-normal font-inter leading-normal">Gunakan templat modul ajar kurikulum
                    merdeka</div>
            </button>

            <button onclick="window.location.href='/generate-syllabus'"
                class="p-4 rounded-lg shadow border border-gray-300  lg:mr-6 hover:bg-slate-50 transition duration-300 ease-in-out flex flex-col">
                <img src="{{ URL('images/book-open.png') }}" alt="" class="w-6 h-6">
                <div class="text-gray-900 text-lg font-bold font-inter leading-normal py-2">Templat Silabus</div>
                <div class="text-black text-xs font-normal font-inter leading-normal">Gunakan templat silabus merdeka
                    belajar</div>
            </button>

            <button onclick="window.location.href='/generate-essay'"
                class="p-4 rounded-lg shadow border border-gray-300  lg:mr-6 hover:bg-slate-50 transition duration-300 ease-in-out flex flex-col">
                <img src="{{ URL('images/document-text.png') }}" alt="" class="w-6 h-6">
                <div class="text-gray-900 text-lg font-bold font-inter leading-normal py-2">Templat Soal</div>
                <div class="text-black text-xs font-normal font-inter leading-normal">Gunakan templat soal untuk sekolah
                </div>
            </button>
        </div>








    </div>

@endsection
