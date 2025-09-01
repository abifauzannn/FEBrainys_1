@extends('layouts.template')

@section('title', 'Dashboard - Brainys')

@section('meta')
    <meta name="robots" content="noindex, nofollow">
@endsection

@section('content')
    <x-nav></x-nav>

    <div class="container mx-auto px-[20px] pt-5 pb-10 font-['Inter'] w-full">
        <div id="loadingSpinner" class="fixed inset-0 flex items-center justify-center hidden bg-black bg-opacity-50">
            <div class="text-lg text-white">Loading...</div>
        </div>
        <div id="welcomePopup"
            class="fixed top-0 left-0 z-10 flex items-center justify-center hidden w-full h-full bg-black bg-opacity-50">
            <div
                class="bg-white w-[300px] sm:w-[500px] p-5 sm:p-8 rounded-lg shadow-md text-center flex flex-col items-center">
                <img src="{{ URL('images/invitation.png') }}" alt="Invitation" class="w-[70%] h-full object-cover mb-4"
                    loading="lazy">
                <p class="mb-2 text-xs leading-normal text-gray-600 sm:text-base">
                    Sebelum anda mulai, masukkan kode undangan dulu yuk!
                </p>
                @if (session('error'))
                    <p class="mb-4 text-xs leading-normal text-red-600 sm:text-base">
                        {{ session('error') }}
                    </p>
                @endif
                <form id="invitationForm" class="w-full" action="{{ route('reedemCode') }}" method="post">
                    @csrf
                    <input type="text" id="invite_code" name="invite_code"
                        class="w-full py-3 text-center border border-gray-300 rounded-md placeholder:text-xs focus:border-blue-600 focus:border-2 focus:outline-none"
                        placeholder="masukkan 8 karakter kode undangan di sini" maxlength="8" required>



                    <p class="mt-2 text-xs leading-normal text-gray-600">
                        Silakan periksa kode undangan di inbox (Kotak Masuk) email Anda! Jika tidak ada, silahkan cek
                        dibagian spam
                    </p>
                    <div class="flex justify-center w-full gap-3 mt-4">
                        <a href="{{ route('logout') }}"
                            class="px-4 py-2 mt-4 font-semibold text-blue-600 bg-white rounded shadow-md focus:outline-none">
                            Keluar
                        </a>
                        <button type="submit"
                            class="px-4 py-2 mt-4 font-semibold text-white bg-blue-600 rounded hover:bg-blue-700 focus:outline-none focus:bg-blue-700">
                            Submit
                        </button>
                    </div>
                    <div class="flex items-center justify-center pt-10">
                        <img src="{{ URL('images/whatsapp.png') }}" alt="WhatsApp Logo" class="object-cover w-5 h-5 mr-2">
                        <a href="https://wa.link/z2edgq" target="_blank"
                            class="flex flex-col text-base font-medium leading-normal text-center hover:font-bold">
                            Butuh Bantuan?
                        </a>
                    </div>
                </form>
            </div>
        </div>

        @if (session('success') || session('user')['is_active'] == 0)
            <script>
                window.addEventListener('DOMContentLoaded', () => {
                    const welcomePopup = document.getElementById('welcomePopup');
                    const codeField = document.getElementById('invite_code');
                    const otpModal = document.getElementById('otpModal');

                    welcomePopup.classList.remove('hidden');
                    document.body.classList.add('overflow-hidden');
                    codeField.focus();

                    document.getElementById('closeWelcomePopup').addEventListener('click', () => {
                        welcomePopup.classList.add('hidden');
                    });

                    document.body.classList.add('overflow-hidden');

                    document.getElementById("closeOtpModal").addEventListener('click', () => {
                        otpModal.classList.add("hidden");
                    });
                });
            </script>
        @endif

        <div class="w-full h-auto mb-3 sm:mb-0 md:mb-3">
            <img src="{{ URL('images/newbanner.png') }}" alt="Banner"
                class="w-full h-[134px] object-cover hidden lg:block p-2" loading="lazy">
            <div class="bg-gray-900 py-4 px-4 md:py-7 md:px-[51px] gap-3 rounded-2xl lg:hidden">
                <div class="text-white text-2xl md:text-[32px] font-bold leading-[49.99px]">
                    Selamat datang
                </div>
                <div class="text-sm font-normal leading-tight text-white sm:text-xs">
                    Brainys merupakan aplikasi AI Text Generation untuk kebutuhan administrasi dan akademik
                </div>
            </div>
        </div>

        @php
            $cards = config('datadashboard');
        @endphp

        <div class="grid grid-cols-1 gap-2 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 lg:gap-4 lg:p-2">
            @foreach ($cards as $card)
                <x-card onclick="window.location.href='{{ $card['url'] }}';" icon="{{ $card['icon'] }}"
                    title="{{ $card['title'] }}" description="{{ $card['description'] }}" status="{{ $card['status'] }}" />
            @endforeach
        </div>

        <div class="flex items-center justify-center pt-8">
            <button
                class="group w-full max-w-56 h-12 px-6 rounded-md flex justify-center items-center gap-2.5 border border-blue-600 text-blue-600 hover:bg-blue-600 hover:text-white"
                type="button">
                <img src="{{ URL('images/whatsapp.png') }}" alt="WhatsApp Logo" class="object-cover w-5 h-5 mr-2"
                    loading="lazy">
                <a href="https://wa.link/z2edgq" target="_blank"
                    class="flex flex-col text-base font-medium leading-normal text-center transition duration-300 ease-in-out group-hover:font-bold">
                    Butuh Bantuan?
                </a>

            </button>
        </div>

    </div>
    <script>
        function handleCardClick(url) {
            // Tampilkan spinner loading
            document.getElementById('loadingSpinner').classList.remove('hidden');

            // Redirect ke URL yang dituju
            window.location.href = url;
        }
    </script>
@endsection
