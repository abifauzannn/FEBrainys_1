@extends('layouts.template')

@section('title', 'Dashboard')

@section('content')
    <x-nav></x-nav>



    @if (Session::has('error'))
        <div class="alert alert-danger">
            {{ Session::get('error') }}
        </div>
    @endif

    <div class="container mx-auto px-[20px] sm:px-10 py-9">
        @if (session('success'))
            <div class="flex items-center p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
                role="alert">
                <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                </svg>
                <span class="sr-only">Info</span>
                <div>
                    <span class="font-medium">{{ session('success') }}</span>
                </div>
            </div>
        @endif

        <div class="w-full h-[134px] mb-[32px]">
            <div class="bg-gray-900 py-4 px-4 md:py-7 md:px-[51px] gap-3 rounded-2xl">
                <div class=" text-white text-2xl md:text-[32px] font-bold font-['Inter'] leading-[49.99px]">Selamat
                    datang</div>
                <div class=" text-white text-xs font-normal font-['Inter'] leading-tight">Oasys syllabus
                    merupakan aplikasi AI Text Generation untuk kebutuhan administrasi dan akademik</div>
            </div>
        </div>

        <div class="flex flex-col sm:flex-row sm:justify-between">
            <a href="/generate">
                <div
                    class="w-full md:w-[370px]  p-4 rounded-lg shadow border border-gray-300 flex-col justify-start items-start gap-2 inline-flex mr-6 mb-2">
                    <img src="{{ URL('images/book-open.svg') }}" alt="" class="w-6 h-6 relative">
                    <div class=" text-gray-900 text-lg font-bold font-['Inter'] leading-normal">Templat Modul Ajar</div>
                    <div class=" text-black text-xs font-normal font-['Inter'] leading-normal">Gunakan templat modul ajar
                        kurikulum merdeka
                    </div>
                </div>
            </a>
            <a href="/generate">
                <div
                    class="w-full md:w-[370px]  p-4 rounded-lg shadow border border-gray-300 flex-col justify-start items-start gap-2 inline-flex mr-6 mb-2">
                    <img src="{{ URL('images/book-open.png') }}" alt="" class="w-6 h-6 relative">
                    <div class=" text-gray-900 text-lg font-bold font-['Inter'] leading-normal">Templat Silabus (Soon)</div>
                    <div class=" text-black text-xs font-normal font-['Inter'] leading-normal">Gunakan templat silabus
                        merdeka belajar
                    </div>
                </div>
            </a>
            <a href="/generate">
                <div
                    class="w-full md:w-[370px]  p-4 rounded-lg shadow border border-gray-300 flex-col justify-start items-start gap-2 inline-flex">
                    <img src="{{ URL('images/document-text.png') }}" alt="" class="w-6 h-6 relative">
                    <div class=" text-gray-900 text-lg font-bold font-['Inter'] leading-normal">Templat Soal (soon)</div>
                    <div class=" text-black text-xs font-normal font-['Inter'] leading-normal">Gunakan templat soal untuk
                        sekolah</div>
                </div>
            </a>
        </div>
    </div>



@endsection
