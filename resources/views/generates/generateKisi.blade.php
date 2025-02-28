@extends('layouts.template')

@section('title', 'Templat Kisi Kisi - Brainys')

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
        <x-banner-page-generate title="Templat Kisi Kisi Soal"
            description="Gunakan template kisi kisi soal dari capaian belajar" />
        @if (session('user')['school_level'] == '')
            <x-alert-jenjang />
        @endif
    </div>

    <div class="flex container mx-auto px-3 sm:px-10 flex-col lg:flex-row">
        <div class="w-full lg:w-[500px] flex-col justify-start items-start sm:gap-6 inline-flex h-auto">
            <form action="{{ route('generateKisi') }}" method="post" class="w-full" id="kisiKisiForm">
                <!-- Input untuk Nama Silabus -->
                @csrf

                <x-generate-field type="text" id="name" name="name" label="Nama Kisi Kisi"
                    placeholder="masukan nama Kisi Kisi" tooltipId="nameTooltip"
                    tooltipText="Contoh : Modul Ajar Logika Matematika" />

                <x-generate-field type="text" id="pokok_materi" name="pokok_materi" label="Pokok Materi"
                    placeholder="masukan pokok materi" tooltipId="pokokMateriTooltip"
                    tooltipText="Contoh : Logika Presisi" />

                <x-chain-select />

                <x-generate-field type="number" id="jumlah_soal" name="jumlah_soal" label="Jumlah Soal"
                    placeholder="masukan jumlah pertanyaan" tooltipId="questuinTooltip" tooltipText=" Contoh : 10" required
                    :min="1" />

                <x-textarea-field id="notes" name="notes" label="Deskripsi" tooltipId="descriptionTooltip"
                    placeholder="masukan deskripsi kisi - kisi"
                    tooltipText="Contoh :
                    Berikan kisi-kisi mengenai reaksi kimia" />


                <div class="flex justify-between items-center -mt-2">
                    <a href="https://guru.kemdikbud.go.id/kurikulum/referensi-penerapan/capaian-pembelajaran/"
                        target="_blank" class="text-blue-500 hover:text-blue-700 font-semibold text-sm">Lihat
                        panduan capaian belajar</a>
                    <div class="self-stretch justify-start items-end gap-5 inline-flex">
                        <div id="characterCount"
                            class="text-left text-gray-500 text-sm font-normal font-inter leading-snug">0/250</div>
                    </div>
                </div>


                <div class="flex justify-between py-6 border-b">
                    <button type="button" onclick="clearInputs()"
                        class="group h-12 px-6 bg-white rounded-lg justify-center items-center gap-2.5 inline-flex border border-gray-900 hover:bg-gray-900 hover:border-white hover:text-white transition duration-300 ease-in-out">
                        <svg width="20" height="20" viewBox="0 0 20 20"
                            class=" group-hover:fill-white transition duration-300 ease-in-out"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M10 18C14.4183 18 18 14.4183 18 10C18 5.58172 14.4183 2 10 2C5.58172 2 2 5.58172 2 10C2 14.4183 5.58172 18 10 18ZM8.28033 7.21967C7.98744 6.92678 7.51256 6.92678 7.21967 7.21967C6.92678 7.51256 6.92678 7.98744 7.21967 8.28033L8.93934 10L7.21967 11.7197C6.92678 12.0126 6.92678 12.4874 7.21967 12.7803C7.51256 13.0732 7.98744 13.0732 8.28033 12.7803L10 11.0607L11.7197 12.7803C12.0126 13.0732 12.4874 13.0732 12.7803 12.7803C13.0732 12.4874 13.0732 12.0126 12.7803 11.7197L11.0607 10L12.7803 8.28033C13.0732 7.98744 13.0732 7.51256 12.7803 7.21967C12.4874 6.92678 12.0126 6.92678 11.7197 7.21967L10 8.93934L8.28033 7.21967Z" />
                        </svg>
                        <div class="text-center text-base font-medium font-['Inter'] leading-normal">Hapus</div>
                    </button>


                    @if (session('user')['school_level'] == '')
                        <button id="submitButton" type="submit" disabled
                            class="h-12 px-3 bg-blue-600 rounded-lg justify-center items-center gap-2.5 inline-flex">
                            <img src="{{ URL('images/glass.svg') }}" alt="" class="w-[20px] h-[20px]">
                            <div class="text-center text-white text-base font-medium font-['Inter'] leading-normal">Buat
                                Kisi Kisi</div>
                        </button>
                    @elseif (session('user')['school_level'] != '')
                        <button id="submitButton" type="submit"
                            class="h-12 px-3 bg-blue-600 rounded-lg justify-center items-center gap-2.5 inline-flex">
                            <img src="{{ URL('images/glass.svg') }}" alt="" class="w-[20px] h-[20px]">
                            <div class="text-center text-white text-base font-medium font-['Inter'] leading-normal">Buat
                                Kisi Kisi</div>
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

                <div class="flex flex-row items-center bg-gray-300 my-5 px-2 rounded-md">
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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Jalankan AJAX saat halaman dimuat
            $.ajax({
                url: "{{ route('get.credit.charges.kisi') }}", // Gantilah dengan route yang benar
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
        });

        document.addEventListener("DOMContentLoaded", function() {
            // Memfokuskan ke input email
            document.getElementById("name").focus();
            const numberInput = document.getElementById('jumlah_soal');
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
                if (firstDigit === 1 && secondDigit >= 0) {
                    value = value.charAt(0) + '0';
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

        function clearInputs() {
            document.getElementById('name').value = ''; // Menghapus nilai input nama
            document.getElementById('pokok_materi').value = ''; // Menghapus nilai input subject
            document.getElementById('fase').value = ''; // Menghapus nilai input grade
            document.getElementById('mata-pelajaran').value = ''; // Menghapus nilai input notes
            document.getElementById('element').value = ''; // Menghapus nilai input notes
            document.getElementById('jumlah_soal').value = ''; // Menghapus nilai input notes
            document.getElementById('notes').value = ''; // Menghapus nilai input notes
        }

        function updateCharacterCount(textarea) {
            var characterCountElement = document.getElementById('characterCount');
            var currentCount = textarea.value.length;
            characterCountElement.textContent = currentCount + '/250';
        }
        document.getElementById('kisiKisiForm').addEventListener('submit', function(event) {
            event.preventDefault();

            const submitButton = document.getElementById('submitButton');
            const loadingButton = document.getElementById('loadingButton');
            const imageGenerate = document.getElementById('output')
            const imageGenerate2 = document.getElementById('output2')
            const loadingSpinner = document.getElementById('loadingSpinner');
            const outputContent = document.getElementById('outputContent'); // Tambahkan baris ini

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
