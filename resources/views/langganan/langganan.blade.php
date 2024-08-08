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

        <div
            class="text-sm font-medium text-center text-gray-500 border-b border-gray-200 dark:text-gray-400 dark:border-gray-700">
            <ul class="flex flex-wrap -mb-px">
                <li class="me-2">
                    <a href="#"
                        class="active tab-link inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                        data-tab="profile">Tagihan</a>
                </li>
                <li class="me-2">
                    <a href="#"
                        class="tab-link inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                        data-tab="dashboard">Pilih Paket</a>
                </li>
                <li class="me-2">
                    <a href="#"
                        class="tab-link inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                        data-tab="settings">Beli Credit</a>
                </li>

            </ul>
        </div>

        <div id="tab-content" class="py-10">
            <div id="profile-content" class="tab-content flex flex-col md:flex-row justify-between gap-5">
                @include('langganan.tagihan.paket-aktif')
                @include('langganan.tagihan.daftar-transaksi')
            </div>


            <div id="dashboard-content" class="tab-content hidde">
                <P>DASHBOARD</P>
            </div>
            <div id="settings-content" class="tab-content hidden">
                <P>SETTING</P>
            </div>
            <div id="contacts-content" class="tab-content hidden">
                <P>CONTACT</P>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const tabs = document.querySelectorAll('.tab-link');
            const contents = document.querySelectorAll('.tab-content');

            function activateTab(tab) {
                tabs.forEach(link => {
                    link.classList.remove('text-blue-600', 'border-blue-600', 'active');
                    link.classList.add('text-gray-500', 'border-transparent');
                });
                contents.forEach(content => content.classList.add('hidden'));

                tab.classList.add('text-blue-600', 'border-blue-600', 'active');
                tab.classList.remove('text-gray-500', 'border-transparent');
                document.getElementById(tab.getAttribute('data-tab') + '-content').classList.remove('hidden');
            }

            tabs.forEach(tab => {
                tab.addEventListener('click', function(e) {
                    e.preventDefault();
                    activateTab(this);
                });
            });

            // Activate the default tab (optional)
            activateTab(document.querySelector('.tab-link.active'));
        });
    </script>





@endsection
