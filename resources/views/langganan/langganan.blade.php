@extends('layouts.template')

@section('title', 'Langganan - Brainys')

@section('meta')
    <meta name="robots" content="noindex, nofollow">
@endsection

@section('content')
    <x-nav></x-nav>
    <div class="container mx-auto px-4 py-6 sm:px-10 sm:py-9 relative">
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
