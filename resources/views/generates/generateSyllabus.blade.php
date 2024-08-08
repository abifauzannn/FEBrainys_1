@extends('layouts.template')

@section('title', 'Templat Syllabus - Brainys')

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

    <div class="container mx-auto px-4 py-6 sm:px-10 sm:py-9">
        <x-back-button url="{{ route('dashboard') }}" />
        <x-banner-page-generate title="Templat Silabus" description="Gunakan template Silabus kurikulum merdeka" />
        @if (session('user')['school_level'] == '')
            <x-alert-jenjang />
        @endif
    </div>



    <div class="flex container mx-auto px-3 sm:px-10 flex-col lg:flex-row">
        <div class="w-full lg:w-[500px] flex-col justify-start items-start sm:gap-6 inline-flex">
            <form action="{{ route('generateSyllabus') }}" method="post" class="w-full" id="silabusForm">
                <!-- Input untuk Nama Silabus -->
                @csrf

                <x-generate-field type="text" id="subject" name="subject" label="Subject"
                    placeholder="masukan nama mata pelajaran" tooltipId="subjectTooltip" tooltipText="Contoh : Geografi"
                    required />

                @if (session('user')['school_level'] == '')
                    <x-disable-select id="grade" label="Kelas" :options="$options" defaultOption="Pilih Kelas" />
                @elseif (session('user')['school_level'] != '')
                    <x-select-field id="grade" label="Kelas" name="grade" :options="$options"
                        defaultOption="Pilih Kelas" />
                @endif

                <!-- Input untuk Mata Pelajaran -->

                <div class="mb-4">
                    <label for="nip"
                        class="text-gray-900 text-base font-semibold font-['Inter'] leading-normal">NIP</label>
                    <button data-tooltip-target="nipTooltip" data-tooltip-placement="right" data-tooltip-trigger="click"
                        type="button"
                        class="text-gray-600 transition-colors duration-200 focus:outline-none dark:text-gray-200 dark:hover:text-blue-400 hover:text-blue-500">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9 5.25h.008v.008H12v-.008z" />
                        </svg>
                    </button>

                    <div id="nipTooltip" role="tooltip"
                        class="w-38 absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                        Contoh : 199703242016022001
                        <div class="tooltip-arrow" data-popper-arrow></div>
                    </div>

                    <input type="text" id="nip" name="nip"
                        class="w-full p-2 border-gray-300 rounded-md mt-[10px] placeholder:text-gray-400 text-base font-normal font-['Inter'] leading-normal"
                        placeholder="masukan nip" minlength="21" maxlength="25" required>
                </div>

                <x-textarea-field id="notes" name="notes" label="Deskripsi Silabus"
                    placeholder="masukan deskripsi silabus" tooltipId="descriptionTooltip"
                    tooltipText=" Contoh : Buatkan silabus untuk mata pelajaran Geografi kelas 11" required />

                <div class="flex justify-end -mt-2">
                    <div class="self-stretch justify-start items-end gap-5 inline-flex">
                        <div id="characterCount"
                            class="text-left text-gray-500 text-sm font-normal font-inter leading-snug">0/250</div>
                    </div>
                </div>
                <div class="flex justify-between py-6 border-b">
                    <x-delete-button />
                    @if (session('user')['school_level'] == '')
                        <button id="submitButton" type="submit" disabled
                            class="h-12 px-3 bg-blue-600 rounded-lg justify-center items-center gap-2.5 inline-flex">
                            <img src="{{ URL('images/glass.svg') }}" alt="" class="w-[20px] h-[20px]">
                            <div class="text-center text-white text-base font-medium font-['Inter'] leading-normal">Buat
                                Syllabus</div>
                        </button>
                    @elseif (session('user')['school_level'] != '')
                        <button id="submitButton" type="submit"
                            class="h-12 px-3 bg-blue-600 rounded-lg justify-center items-center gap-2.5 inline-flex">
                            <img src="{{ URL('images/glass.svg') }}" alt="" class="w-[20px] h-[20px]">
                            <div class="text-center text-white text-base font-medium font-['Inter'] leading-normal">
                                Buat Syllabus</div>
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
                        <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
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
            document.getElementById('subject').focus();
        });

        function clearInputs() {
            document.getElementById('subject').value = '';
            document.getElementById('nip').value = '';
            document.getElementById('grade').value = '';
            document.getElementById('notes').value = '';
        }

        document.getElementById('notes').addEventListener('input', function() {
            var characterCountElement = document.getElementById('characterCount');
            var currentCount = this.value.length;
            characterCountElement.textContent = currentCount + '/250';
        });

        document.getElementById('silabusForm').addEventListener('submit', function(event) {
            event.preventDefault();

            const submitButton = document.getElementById('submitButton');
            const loadingButton = document.getElementById('loadingButton');
            const imageGenerate = document.getElementById('output')
            const imageGenerate2 = document.getElementById('output2')
            const outputContent = document.getElementById('outputContent');
            const loadingSpinner = document.getElementById('loadingSpinner');

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
