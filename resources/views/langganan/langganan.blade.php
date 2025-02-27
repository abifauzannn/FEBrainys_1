@extends('layouts.template')

@section('title', 'Langganan - Brainys')

@section('meta')
    <meta name="robots" content="noindex, nofollow">
@endsection

@section('content')
    <x-nav></x-nav>
    <div class="container relative px-4 py-6 mx-auto sm:px-10 sm:py-9">
        <x-back-button url="{{ route('dashboard') }}" />
        <x-banner-page-generate title="Langganan" description="Halaman riwayat tagihan, pilihan paket dan pembelian credit" />

        @if (session('user')['school_level'] == '')
            <x-alert-jenjang />
        @endif

        @if (session('user')['is_active'] == 0)
            <script>
                window.location.href = "{{ route('dashboard') }}";
            </script>
        @endif

        @if (session('error'))
            <div class="flex items-center w-auto p-4 mb-4 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50"
                role="alert">
                <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                </svg>
                <span class="sr-only">Error!</span>
                <div>
                    <span class="font-medium">{{ session('error') }}</span> <!-- ✅ Perbaikan di sini -->
                </div>
            </div>
        @endif


        <div
            class="text-sm font-medium text-center text-gray-500 border-b border-gray-200 dark:text-gray-400 dark:border-gray-700">
            <ul class="flex flex-wrap -mb-px">
                <li class="me-2">
                    <a href="{{ route('langganan.tagihan') }}"
                        class="inline-block p-4 border-b-2 rounded-t-lg {{ request()->routeIs('langganan.tagihan') ? 'text-blue-600 border-blue-600' : 'text-gray-500 border-transparent' }} hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300">
                        Tagihan
                    </a>
                </li>
                <li class="me-2">
                    <a href="{{ route('langganan.pilih-paket') }}"
                        class="inline-block p-4 border-b-2 rounded-t-lg {{ request()->routeIs('langganan.pilih-paket') ? 'text-blue-600 border-blue-600' : 'text-gray-500 border-transparent' }} hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300">
                        Pilih Paket
                    </a>
                </li>
                <li class="me-2">
                    <a href="{{ route('langganan.beli-credit') }}"
                        class="inline-block p-4 border-b-2 rounded-t-lg {{ request()->routeIs('langganan.beli-credit') ? 'text-blue-600 border-blue-600' : 'text-gray-500 border-transparent' }} hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300">
                        Beli Credit
                    </a>
                </li>
            </ul>
        </div>

        <div id="tab-content" class="py-10">
            @yield('langganan-content')
        </div>
    </div>
@endsection
