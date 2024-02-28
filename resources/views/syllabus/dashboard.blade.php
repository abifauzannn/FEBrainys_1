@extends('layouts.template')

@section('title', 'Dashboard - Brainys')

@section('content')
    <x-nav></x-nav>

    <div class="container mx-auto px-[20px] sm:px-10 py-9">

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


        <div class="w-full h-[134px] mb-[32px]">
            <div class="bg-gray-900 py-4 px-4 md:py-7 md:px-[51px] gap-3 rounded-2xl">
                <div class=" text-white text-2xl md:text-[32px] font-bold font-['Inter'] leading-[49.99px]">Selamat
                    datang</div>
                <div class=" text-white text-xs font-normal font-['Inter'] leading-tight">Brainys
                    merupakan aplikasi AI Text Generation untuk kebutuhan administrasi dan akademik</div>
            </div>
        </div>


        <div class="flex flex-wrap flex-col md:flex-row sm:justify-between">
            <a href="/generate">
                <div
                    class="w-full md:w-[330px] xl:w-[375px] p-4 rounded-lg shadow border border-gray-300 flex-col justify-start items-start gap-2 inline-flex lg:mr-6 mb-2">
                    <img src="{{ URL('images/book-open.svg') }}" alt="" class="w-6 h-6">
                    <div class=" text-gray-900 text-lg font-bold font-['Inter'] leading-normal">Templat Modul Ajar</div>
                    <div class=" text-black text-xs font-normal font-['Inter'] leading-normal">Gunakan templat modul ajar
                        kurikulum merdeka
                    </div>
                </div>
            </a>

            <div
                class="w-full md:w-[330px] xl:w-[375px] p-4 rounded-lg shadow border border-gray-300 flex-col justify-start items-start gap-2 inline-flex lg:mr-6 mb-2">
                <img src="{{ URL('images/book-open.png') }}" alt="" class="w-6 h-6">
                <div class=" text-gray-900 text-lg font-bold font-['Inter'] leading-normal">Templat Silabus (Soon)</div>
                <div class=" text-black text-xs font-normal font-['Inter'] leading-normal">Gunakan templat silabus
                    merdeka belajar
                </div>
            </div>

            <div
                class="w-full md:w-[330px]  xl:w-[375px]  p-4 rounded-lg shadow border border-gray-300 flex-col justify-start items-start gap-2 inline-flex mb-2 md:mt-4 lg:mt-0">
                <img src="{{ URL('images/document-text.png') }}" alt="" class="w-6 h-6">
                <div class=" text-gray-900 text-lg font-bold font-['Inter'] leading-normal">Templat Soal (soon)</div>
                <div class=" text-black text-xs font-normal font-['Inter'] leading-normal">Gunakan templat soal untuk
                    sekolah</div>
            </div>


        </div>
    </div>



@endsection
