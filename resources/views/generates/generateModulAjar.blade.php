@extends('layouts.template')

@section('title', 'Templat Modul Ajar - Brainys')

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

    <div class="container mx-auto px-4 py-6 sm:px-10 sm:py-9 relative">
        <x-back-button url="{{ route('dashboard') }}" />
        <x-banner-page-generate title="Templat Modul Ajar" description="Gunakan template modul ajar kurikulum merdeka" />
        @if (session('user')['school_level'] == '')
            <x-alert-jenjang />
        @endif
    </div>

    <div class="flex container mx-auto px-3 sm:px-10 flex-col lg:flex-row">
        <div class="w-full lg:w-[500px] flex-col justify-start items-start sm:gap-6 inline-flex h-auto">
            <form action="{{ route('generateModulAjar') }}" method="post" class="w-full" id="modulAjarForm">
                <!-- Input untuk Nama Silabus -->
                @csrf

                <x-generate-field type="text" id="name" name="name" label="Nama Modul Ajar"
                    placeholder="masukan nama modul ajar" tooltipId="nameTooltip"
                    tooltipText="Contoh : Modul Ajar biologi smp kelas 8" />

                <div class="mb-4 form-group">
                    <label for="fase"
                        class="text-gray-900 text-base font-['Inter'] mb-[30px] leading-normal font-semibold">Fase
                        (Kelas)</label>
                    <select id="fase" name="fase" required
                        class="bg-white mt-[10px] font-['Inter'] shadow appearance-none border border-gray-300 text-gray-900 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="" class="">Select Fase</option>
                    </select>
                </div>

                <div class="mb-4 form-group">
                    <label for="mata-pelajaran"
                        class="text-gray-900 text-base font-['Inter'] mb-[30px] leading-normal font-semibold">Mata Pelajaran
                    </label>
                    <select id="mata-pelajaran"
                        name="mata-pelajaran"class="bg-white font-['Inter'] mt-[10px] shadow appearance-none  border border-gray-300 text-gray-900 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        required disabled>
                        <option value="" class="font">Select Mata Pelajaran</option>
                    </select>
                </div>

                <div class="mb-4 form-group">
                    <label for="element"
                        class="text-gray-900 text-base font-['Inter'] mb-[30px] leading-normal font-semibold">Elemen Capaian
                    </label>
                    <select id="element"
                        name="element"class="bg-white font-['Inter'] mt-[10px] shadow appearance-none  border border-gray-300 text-gray-900 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        required disabled>
                        <option value="" class="font">Select Element</option>
                    </select>
                </div>

                <x-textarea-field id="notes" name="notes" label="Deskripsi modul ajar" tooltipId="descriptionTooltip"
                    placeholder="masukan deskripsi point modul ajar"
                    tooltipText="Contoh :
                 buatkan modul ajar untuk rangkaian listrik" />


                <div class="flex justify-between items-center -mt-2">
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
                            <img src="{{ URL('images/glass.svg') }}" alt="" class="w-[20px] h-[20px]"
                                loading="lazy">
                            <div class="text-center text-white text-base font-medium font-['Inter'] leading-normal">Buat
                                Modul Ajar</div>
                        </button>
                    @elseif (session('user')['school_level'] != '')
                        <button id="submitButton" type="submit"
                            class="h-12 px-3 bg-blue-600 rounded-lg justify-center items-center gap-2.5 inline-flex">
                            <img src="{{ URL('images/glass.svg') }}" alt="" class="w-[20px] h-[20px]"
                                loading="lazy">
                            <div class="text-center text-white text-base font-medium font-['Inter'] leading-normal">Buat
                                Modul Ajar</div>
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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            var API_URL = 'https://testing.brainys.oasys.id/api';
            // var API_URL = 'http://127.0.0.1:8000/api';

            // Fetch Fase
            $.ajax({
                url: API_URL + "/capaian-pembelajaran/fase",
                method: "POST",
                success: function(response) {
                    if (response.status === "success") {
                        response.data.forEach(function(item) {
                            $("#fase").append(new Option(item.fase, item.fase));
                        });
                    }
                },
            });

            // Fetch Mata Pelajaran based on Fase
            $("#fase").on("change", function() {
                let fase = $(this).val();
                $("#mata-pelajaran")
                    .prop("disabled", true)
                    .empty()
                    .append(new Option("Select Mata Pelajaran", ""));

                if (fase) {
                    $.ajax({
                        url: API_URL + "/capaian-pembelajaran/mata-pelajaran",
                        method: "POST",
                        contentType: "application/json",
                        data: JSON.stringify({
                            fase: fase
                        }),
                        success: function(response) {
                            if (response.status === "success") {
                                $("#mata-pelajaran").prop("disabled", false);
                                response.data.forEach(function(item) {
                                    $("#mata-pelajaran").append(
                                        new Option(item.mata_pelajaran, item
                                            .mata_pelajaran)
                                    );
                                });
                            }
                        },
                    });
                }
            });

            // Fetch Element based on Mata Pelajaran and Fase
            $("#mata-pelajaran").on("change", function() {
                let fase = $("#fase").val();
                let mataPelajaran = $(this).val();
                $("#element")
                    .prop("disabled", true)
                    .empty()
                    .append(new Option("Select Element", ""));

                if (fase && mataPelajaran) {
                    $.ajax({
                        url: API_URL + "/capaian-pembelajaran/element",
                        method: "POST",
                        contentType: "application/json",
                        data: JSON.stringify({
                            fase: fase,
                            mata_pelajaran: mataPelajaran,
                        }),
                        success: function(response) {
                            if (response.status === "success") {
                                $("#element").prop("disabled", false);
                                response.data.forEach(function(item) {
                                    $("#element").append(
                                        new Option(item.element, item.element)
                                    );
                                });
                            }
                        },
                    });
                }
            });

            // Fetch Capaian Pembelajaran and Capaian Pembelajaran Redaksi based on Element
            $("#element").on("change", function() {
                let fase = $("#fase").val();
                let mataPelajaran = $("#mata-pelajaran").val();
                let element = $(this).val();

                if (fase && mataPelajaran && element) {
                    $.ajax({
                        url: API_URL + "/capaian-pembelajaran/final",
                        method: "POST",
                        contentType: "application/json",
                        data: JSON.stringify({
                            fase: fase,
                            mata_pelajaran: mataPelajaran,
                            element: element,
                        }),
                        success: function(response) {
                            if (response.status === "success") {
                                if (response.data) {
                                    $("#capaian-pembelajaran").val(response.data
                                        .capaian_pembelajaran || "No data available");
                                    $("#capaian-pembelajaran-redaksi").val(response.data
                                        .capaian_pembelajaran_redaksi || "No data available"
                                    );
                                } else {
                                    $("#capaian-pembelajaran").val("No data available");
                                    $("#capaian-pembelajaran-redaksi").val("No data available");
                                }
                            } else {
                                $("#capaian-pembelajaran").val("Error retrieving data");
                                $("#capaian-pembelajaran-redaksi").val("Error retrieving data");
                            }
                        },
                    });
                }
            });
        });

        document.addEventListener("DOMContentLoaded", function() {
            // Memfokuskan ke input email
            document.getElementById("name").focus();
        });

        function clearInputs() {
            document.getElementById('name').value = ''; // Menghapus nilai input nama
            document.getElementById('fase').value = ''; // Menghapus nilai input grade
            document.getElementById('mata-pelajaran').value = ''; // Menghapus nilai input notes
            document.getElementById('element').value = ''; // Menghapus nilai input notes
            document.getElementById('pekan').value = ''; // Menghapus nilai input notes
            document.getElementById('notes').value = ''; // Menghapus nilai input notes
        }

        function updateCharacterCount(textarea) {
            var characterCountElement = document.getElementById('characterCount');
            var currentCount = textarea.value.length;
            characterCountElement.textContent = currentCount + '/250';
        }
        document.getElementById('modulAjarForm').addEventListener('submit', function(event) {
            event.preventDefault();

            const submitButton = document.getElementById('submitButton');
            const loadingButton = document.getElementById('loadingButton');
            const outputContent = document.getElementById('outputContent'); // Tambahkan baris ini
            const imageGenerate = document.getElementById('output');
            const imageGenerate2 = document.getElementById('output2');
            const loadingSpinner = document.getElementById('loadingSpinner');

            submitButton.style.display = 'none';
            loadingButton.style.display = 'inline-flex';
            outputContent.style.display = 'none'; // Tambahkan baris ini
            imageGenerate.style.display = 'none';
            imageGenerate2.style.display = 'inline-flex';
            loadingSpinner.style.display = 'inline-flex';

            this.submit();
        });
    </script>

@endsection
