@extends('layouts.template')

@section('title', 'Templat Soal - Brainys')

@section('meta')
    <meta name="robots" content="noindex, nofollow">
@endsection

@section('content')
    <x-nav></x-nav>

    @if (session('user')['is_active'] == 0)
        <script>
            window.location.href = "{{ route('dashboard') }}";
        </script>
    @endif

    @php
        $skema = [['value' => 'essay', 'label' => 'Essay'], ['value' => 'multiple_choice', 'label' => 'Pilihan Ganda']];
    @endphp

    <x-page-title url="{{ route('dashboard') }}" title="Templat Latihan Soal"
        description="Gunakan templat soal kurikulum merdeka" />

    <div class="container flex flex-col px-3 mx-auto sm:px-10 lg:flex-row">
        <div class="w-full lg:w-[500px] flex-col justify-start items-start sm:gap-6 inline-flex h-auto">
            <form action="{{ route('generateEssay') }}" method="post" class="w-full" id="modulAjarForm">
                @csrf

                <x-generate-field type="text" id="name" name="name" label="Nama Latihan Soal"
                    placeholder="Masukkan nama latihan soal" tooltipId="nameTooltip" tooltipText="Contoh : Latihan UAS" />

                <x-select-field id="exerciseType" label="Jenis Soal" name="exerciseType" :options="$skema"
                    defaultOption="Pilih Jenis Soal" />

                <x-chain-select />

                <div class="mb-4 form-group">
                    <label for="numberOfQuestion" class="mb-2 text-base font-semibold leading-normal text-gray-900">Jumlah
                        Soal</label>
                    <input type="number" id="numberOfQuestion" name="numberOfQuestion" min="1" max="15"
                        required placeholder="Masukkan jumlah soal"
                        class="bg-white mt-2 font-['Inter'] shadow appearance-none border border-gray-300 text-gray-900 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <small id="numberError" class="text-gray-500 mt-2 font-['Inter']">Maksimal 15 Soal</small>
                </div>


                <x-textarea-field id="notes" name="notes" label="Kisi-kisi/Deskripsi" tooltipId="descriptionTooltip"
                    placeholder="Masukkan kisi-kisi atau deskripsi pada soal"
                    tooltipText="Contoh: Buatkan sesuai materi elemen" />

                <div class="flex items-center justify-between -mt-2">
                    <div class="inline-flex items-end self-stretch justify-start gap-5">
                        <div id="characterCount"
                            class="text-sm font-normal leading-snug text-left text-gray-500 font-inter">0/250</div>
                    </div>
                </div>

                <div class="flex justify-between py-6 border-b">
                    <button type="button" onclick="clearInputs()"
                        class="group h-12 px-6 bg-white rounded-lg justify-center items-center gap-2.5 inline-flex border border-gray-900 hover:bg-gray-900 hover:border-white hover:text-white transition duration-300 ease-in-out">
                        <svg width="20" height="20" viewBox="0 0 20 20"
                            class="transition duration-300 ease-in-out group-hover:fill-white"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM8.28033 7.21967C7.98744 6.92678 7.51256 6.92678 7.21967 7.21967C6.92678 7.51256 6.92678 7.98744 7.21967 8.28033L8.93934 10L7.21967 11.7197C6.92678 12.0126 6.92678 12.4874 7.21967 12.7803C7.51256 13.0732 7.98744 13.0732 8.28033 12.7803L10 11.0607L11.7197 12.7803C12.0126 13.0732 12.4874 13.0732 12.7803 12.7803C13.0732 12.4874 13.0732 12.0126 12.7803 11.7197L11.0607 10L12.7803 8.28033C13.0732 7.98744 13.0732 7.51256 12.7803 7.21967C12.4874 6.92678 12.0126 6.92678 11.7197 7.21967L10 8.93934L8.28033 7.21967Z" />
                        </svg>
                        <div class="text-center text-base font-medium font-['Inter'] leading-normal">Hapus</div>
                    </button>

                    @if (session('user')['school_level'] == '')
                        <button id="submitButton" type="submit" disabled
                            class="h-12 px-3 bg-blue-600 rounded-lg justify-center items-center gap-2.5 inline-flex">
                            <img src="{{ URL('images/glass.svg') }}" alt="" class="w-[20px] h-[20px]"
                                loading="lazy">
                            <div class="text-center text-white text-base font-medium font-['Inter'] leading-normal">Buat
                                Soal</div>
                        </button>
                    @else
                        <button id="submitButton" type="submit"
                            class="h-12 px-3 bg-blue-600 rounded-lg justify-center items-center gap-2.5 inline-flex">
                            <img src="{{ URL('images/glass.svg') }}" alt="" class="w-[20px] h-[20px]"
                                loading="lazy">
                            <div class="text-center text-white text-base font-medium font-['Inter'] leading-normal">Buat
                                Soal</div>
                        </button>
                    @endif

                    <button id="loadingButton" disabled type="button"
                        class="h-12 px-6 bg-blue-600 rounded-lg justify-center items-center gap-2.5 inline-flex"
                        style="display: none;">
                        <svg class="w-5 h-5 mr-3 -ml-1 text-white animate-spin" xmlns="http://www.w3.org/2000/svg"
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

                <div class="flex flex-row items-center px-2 my-5 bg-gray-300 rounded-md">
                    <svg xmlns="http://www.w3.org/2000/svg" width="15px" height="15px" viewBox="0 0 24 24">
                        <g fill="none">
                            <path
                                d="m12.594 23.258l-.012.002l-.071.035l-.02.004l-.014-.004l-.071-.036q-.016-.004-.024.006l-.004.01l-.017.428l.005.02l.01.013l.104.074l.015.004l.012-.004l.104-.074l.012-.016l.004-.017l-.017-.427q-.004-.016-.016-.018m.264-.113l-.014.002l-.184.093l-.01.01l-.003.011l.018.43l.005.012l.008.008l.201.092q.019.005.029-.008l.004-.014l-.034-.614q-.005-.019-.02-.022m-.715.002a.02.02 0 0 0-.027.006l-.006.014l-.034.614q.001.018.017.024l.015-.002l.201-.093l.01-.008l.003-.011l.018-.43l-.003-.012l-.01-.01z" />
                            <path fill="currentColor"
                                d="M9.107 5.448c.598-1.75 3.016-1.803 3.725-.159l.06.16l.807 2.36a4 4 0 0 0 2.276 2.411l.217.081l2.36.806c1.75.598 1.803 3.016.16 3.725l-.16.06l-2.36.807a4 4 0 0 0-2.412 2.276l-.081.216l-.806 2.361c-.598 1.75-3.016 1.803-3.724.16l-.062-.16l-.806-2.36a4 4 0 0 0-2.276-2.412l-.216-.081l-2.36-.806c-1.751-.598-1.804-3.016-.16-3.724l.16-.062l2.36-.806A4 4 0 0 0 8.22 8.025l.081-.216zM19 2a1 1 0 0 1 .898.56l.048.117l.35 1.026l1.027.35a1 1 0 0 1 .118 1.845l-.118.048l-1.026.35l-.35 1.027a1 1 0 0 1-1.845.117l-.048-.117l-.35-1.026l-1.027-.35a1 1 0 0 1-.118-1.845l.118-.048l1.026-.35l.35-1.027A1 1 0 0 1 19 2" />
                        </g>
                    </svg>
                    <p class="font-['Inter'] font-normal text-[13px] py-2 pl-1">Credit yang dibutuhkan untuk modul ini
                        <b><span id="creditValue">Loading...</span> Credit</b>
                    </p>
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
        $(document).ready(function() {
            var API_URL = 'https://testing.brainys.oasys.id/api';

            $.ajax({
                url: "{{ route('get.credit.charges.soal') }}", // Gantilah dengan route yang benar
                type: "GET",
                success: function(response) {
                    if (response.success) {
                        // Menampilkan data di dalam elemen dengan id #creditValue
                        $('#creditValue').text(response.credit_charged_generate);
                    } else {
                        $('#creditValue').text('Gagal mengambil data');
                    }
                },
                error: function() {
                    $('#creditValue').text('Terjadi kesalahan saat mengambil data.');
                }
            });

            $('#modulAjarForm').on('submit', function(event) {
                event.preventDefault();

                const submitButton = $('#submitButton');
                const loadingButton = $('#loadingButton');
                const imageGenerate = $('#output');
                const imageGenerate2 = $('#output2');
                const loadingSpinner = $('#loadingSpinner');
                const outputContent = $('#outputContent');

                outputContent.hide();
                submitButton.hide();
                loadingButton.show();
                imageGenerate.hide();
                imageGenerate2.css('display', 'inline-flex');
                loadingSpinner.css('display', 'inline-flex');

                this.submit();
            });

        });

        document.addEventListener('DOMContentLoaded', function() {
            const numberInput = document.getElementById('numberOfQuestion');
            const numberError = document.getElementById('numberError');
            const submitButton = document.getElementById('submitButton');

            function validateNumber() {
                const value = numberInput.value;
                const number = parseInt(value, 10);

                // Check if the value is valid and within range
                if (isNaN(number) || number < 1 || number > 15 || value.length > 2) {

                    submitButton.disabled = true;
                } else {

                    submitButton.disabled = false;
                }
            }

            function enforceDigitLimit() {
                let value = numberInput.value;

                // If the input is empty, do nothing
                if (value === '') return;

                // Ensure the value has at most 2 digits
                if (value.length > 2) {
                    value = value.slice(0, 2);
                    numberInput.value = value;
                }

                // Apply digit-based restrictions
                const firstDigit = parseInt(value.charAt(0), 10);
                const secondDigit = parseInt(value.charAt(1), 10);

                // Check if the first digit is zero
                if (firstDigit === 0) {
                    value = '';
                    numberInput.value = value;
                    submitButton.disabled = true;
                    return;
                }

                // If the first digit is 1, the second digit must not be greater than 5
                if (firstDigit === 1 && secondDigit > 5) {
                    value = value.charAt(0) + '5';
                    numberInput.value = value;
                }

                // If the first digit is greater than 1, ensure only one digit is allowed
                else if (firstDigit > 1 && value.length > 1) {
                    value = value.charAt(0);
                    numberInput.value = value;
                }

                validateNumber();
            }

            numberInput.addEventListener('input', enforceDigitLimit);

            // Initial validation
            validateNumber();
        });





        document.addEventListener("DOMContentLoaded", function() {
            // Memfokuskan ke input nama
            document.getElementById("name").focus();


        });

        function clearInputs() {
            document.getElementById('name').value = ''; // Menghapus nilai input nama
            document.getElementById('fase').value = ''; // Menghapus nilai input fase
            document.getElementById('mata-pelajaran').value = ''; // Menghapus nilai input mata pelajaran
            document.getElementById('element').value = ''; // Menghapus nilai input element
            document.getElementById('notes').value = ''; // Menghapus nilai input notes
            document.getElementById('number').value = ''; // Menghapus nilai input number
            $('#numberError').text(''); // Menghapus pesan error
            $('#submitButton').prop('disabled', true); // Menonaktifkan tombol submit
        }

        function updateCharacterCount(textarea) {
            var characterCountElement = document.getElementById('characterCount');
            var currentCount = textarea.value.length;
            characterCountElement.textContent = currentCount + '/250';
        }
    </script>
@endsection
