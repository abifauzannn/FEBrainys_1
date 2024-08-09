@extends('layouts.template')

@section('title', 'Templat Bahan Ajar - Brainys')

@section('meta')
    <meta name="robots" content="noindex, nofollow">
@endsection

@section('content')
    @php
        $options = [];

        $schoolLevel = session('user')['school_level'] ?? '';

        if ($schoolLevel == 'sd' || $schoolLevel == 'paketa') {
            for ($i = 1; $i <= 6; $i++) {
                $options[] = ['value' => $i, 'label' => "$i SD"];
            }
        } elseif ($schoolLevel == 'smp' || $schoolLevel == 'paketb') {
            for ($i = 7; $i <= 9; $i++) {
                $options[] = ['value' => $i, 'label' => "$i SMP"];
            }
        } elseif ($schoolLevel == 'sma' || $schoolLevel == 'paketc') {
            for ($i = 10; $i <= 12; $i++) {
                $options[] = ['value' => $i, 'label' => "$i SMA"];
            }
        } else {
            for ($i = 1; $i <= 12; $i++) {
                if ($i <= 6) {
                    $options[] = ['value' => $i, 'label' => "$i SD"];
                } elseif ($i <= 9) {
                    $options[] = ['value' => $i, 'label' => "$i SMP"];
                } else {
                    $options[] = ['value' => $i, 'label' => "$i SMA"];
                }
            }
        }
    @endphp

    <x-nav></x-nav>

    @if (session('user')['is_active'] == 0)
        <script>
            window.location.href = "{{ route('dashboard') }}";
        </script>
    @endif

    <div class="container mx-auto px-4 py-6 sm:px-10 sm:py-9 relative">
        <x-back-button url="{{ route('dashboard') }}" />
        <x-banner-page-generate title="Templat Bahan Ajar" description="Gunakan template bahan materi pembelajaran" />
        @if (session('user')['school_level'] == '')
            <x-alert-jenjang />
        @endif

    </div>

    <div class="flex container mx-auto px-3 sm:px-10 flex-col lg:flex-row">
        <div class="w-full lg:w-[500px] flex-col justify-start items-start sm:gap-6 inline-flex h-auto">
            <form action="{{ route('generateBahanAjar') }}" method="post" class="w-full" id="bahanAjarForm">
                <!-- Input untuk Nama Silabus -->
                @csrf

                <x-generate-field type="text" id="name" name="name" label="Nama Bahan Ajar"
                    placeholder="masukan nama bahan ajar" tooltipId="nameTooltip"
                    tooltipText="Contoh : SOLUSI MENGATASI PEMANASAN GLOBAL" />

                @if (session('user')['school_level'] == '')
                    <x-disable-select id="grade" label="Kelas" :options="$options" defaultOption="Pilih Kelas" />
                @elseif (session('user')['school_level'] != '')
                    <x-select-field id="grade" label="Kelas" name="grade" :options="$options"
                        defaultOption="Pilih Kelas" />
                @endif

                <x-generate-field type="text" id="subject" name="subject" label="Mata Pelajaran"
                    placeholder="masukan nama mata pelajaran" tooltipId="subjectTooltip" tooltipText="Contoh : Geografi" />

                <x-textarea-field id="notes" name="notes" label="Deskripsi Bahan Ajar" :placeholder="masukan deskripsi bahan ajar"
                    tooltipId="descriptionTooltip" placeholder="masukan deskripsi bahan ajar"
                    tooltipText="Contoh : Untuk memperkenalkan ke siswa tentang bagaimana solusi mengatasi pemanasan global, penyebab
               pemanasan global dan langkah-langkah mengatasinya" />


                <div class="flex justify-end -mt-2">
                    <div class="self-stretch justify-start items-end gap-5 inline-flex">
                        <div id="characterCount"
                            class="text-left text-gray-500 text-sm font-normal font-inter leading-snug">0/250</div>
                    </div>
                </div>


                <div class="flex justify-between py-6 border-b">
                    <button type="button" onclick="clearInputs()"
                        class="h-12 px-6 bg-white rounded-lg justify-center items-center gap-2.5 inline-flex border border-gray-900">
                        <img src="{{ URL('images/x-circle.svg') }}" alt="" class="w-[20px] h-[20px]">
                        <div class="text-center text-base font-medium font-['Inter'] leading-normal">Hapus</div>
                    </button>
                    @if (session('user')['school_level'] == '')
                        <button id="submitButton" type="submit" disabled
                            class="h-12 px-3 bg-blue-600 rounded-lg justify-center items-center gap-2.5 inline-flex">
                            <img src="{{ URL('images/glass.svg') }}" alt="" class="w-[20px] h-[20px]">
                            <div class="text-center text-white text-base font-medium font-['Inter'] leading-normal">Buat
                                Bahan
                                Ajar</div>
                        </button>
                    @elseif (session('user')['school_level'] != '')
                        <button id="submitButton" type="submit"
                            class="h-12 px-3 bg-blue-600 rounded-lg justify-center items-center gap-2.5 inline-flex">
                            <img src="{{ URL('images/glass.svg') }}" alt="" class="w-[20px] h-[20px]">
                            <div class="text-center text-white text-base font-medium font-['Inter'] leading-normal">Buat
                                Bahan
                                Ajar</div>
                        </button>
                    @endif


                    <button id="loadingButton" disabled type="button"
                        class="h-12 px-6 bg-blue-600 rounded-lg justify-center items-center gap-2.5 inline-flex"
                        style="display: none;">
                        <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor"
                                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 4.418 3.582 8 8 8v-4zm10-1.874A6 6 0 1012 2.83v4.587a.944.944 0 00-.944.943h4.587A7.966 7.966 0 0114 12h4c0-3.313-2.54-6.036-5.786-6.371L14 5.415v-2.11l6.1 1.706">
                            </path>
                        </svg>
                        <span class="text-white">Sedang Proses</span>
                    </button>
                </div>
            </form>
        </div>


        <div class="flex-col justify-start items-start lg:ml-[72px] inline-flex mt-3 lg:mt-0">
            <div class="text-gray-900 text-2xl font-semibold font-['Inter'] leading-[30px]">Hasil</div>
            <div class="w-full lg:w-[788px] text-gray-500 text-sm font-normal font-['Inter'] leading-snug mt-3">
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

                <x-generate-image />
                <div id="outputContent">
                    @yield('output')
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Memfokuskan ke input email
            document.getElementById("name").focus();

        });

        function clearInputs() {
            document.getElementById('name').value = ''; // Menghapus nilai input nama
            document.getElementById('subject').value = ''; // Menghapus nilai input subject
            document.getElementById('grade').value = ''; // Menghapus nilai input grade
            document.getElementById('notes').value = ''; // Menghapus nilai input notes
        }

        function updateCharacterCount(textarea) {
            var characterCountElement = document.getElementById('characterCount');
            var currentCount = textarea.value.length;
            characterCountElement.textContent = currentCount + '/250';
        }
        document.getElementById('bahanAjarForm').addEventListener('submit', function(event) {
            event.preventDefault();

            const submitButton = document.getElementById('submitButton');
            const loadingButton = document.getElementById('loadingButton');
            const imageGenerate = document.getElementById('output')
            const imageGenerate2 = document.getElementById('output2')
            const loadingSpinner = document.getElementById('loadingSpinner');
            const outputContent = document.getElementById('outputContent');

            submitButton.style.display = 'none';
            loadingButton.style.display = 'inline-flex';
            imageGenerate.style.display = 'none';
            imageGenerate2.style.display = 'inline-flex';
            loadingSpinner.style.display = 'inline-flex';
            outputContent.style.display = 'none';

            this.submit();
        });
    </script>

@endsection
