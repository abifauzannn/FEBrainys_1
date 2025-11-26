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

    <x-page-title url="{{ route('dashboard') }}" title="Templat Silabus"
        description="Gunakan template Silabus kurikulum merdeka" />

    <div class="container flex flex-col px-3 mx-auto sm:px-10 lg:flex-row">
        <div class="w-full lg:w-[500px] flex-col justify-start items-start sm:gap-6 inline-flex">
            <form action="{{ route('generateSyllabus') }}" method="post" class="w-full" id="silabusForm">
                <!-- Input untuk Nama Silabus -->
                @csrf

                <x-generate-field type="text" id="name" name="name" label="Nama Silabus"
                    placeholder="masukan nama silabus" tooltipId="nameTooltip"
                    tooltipText="Contoh : silabus biologi smp kelas 8" />

                <div class="mb-4 form-group">
                    <p id="schoolLevel" class="hidden">{{ session('user')['school_level'] }}</p>
                    <label for="fase"
                        class="text-gray-900 text-base font-['Inter'] mb-[30px] leading-normal font-semibold">Fase
                        (Kelas)</label>
                    <select id="fase" name="fase" required
                        class="bg-white mt-[10px] font-['Inter'] shadow appearance-none border border-gray-300 text-gray-900 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="" class="">Select Fase</option>
                    </select>
                </div>

                <div class="mb-4 form-group">
                    <label for="mata-pelajaran"
                        class="text-gray-900 text-base font-['Inter'] mb-[30px] leading-normal font-semibold">Mata Pelajaran
                    </label>
                    <select id="mata-pelajaran"
                        name="mata-pelajaran"class="bg-white font-['Inter'] mt-[10px] shadow appearance-none  border border-gray-300 text-gray-900 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        required disabled>
                        <option value="" class="font">Select Mata Pelajaran</option>
                    </select>
                </div>

                <x-textarea-field id="notes" name="notes" label="Deskripsi Silabus"
                    placeholder="masukan deskripsi silabus" tooltipId="descriptionTooltip"
                    tooltipText=" Contoh : Buatkan silabus untuk mata pelajaran Geografi kelas 11" required />

                <div class="flex justify-end -mt-2">
                    <div class="inline-flex items-end self-stretch justify-start gap-5">
                        <div id="characterCount"
                            class="text-sm font-normal leading-snug text-left text-gray-500 font-inter">0/250</div>
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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Jalankan AJAX saat halaman dimuat
            $.ajax({
                url: "{{ route('get.credit.charges.syllabus') }}", // Gantilah dengan route yang benar
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

        $(document).ready(function() {
            var API_URL = 'https://testing.brainys.oasys.id/api';
            var sessionLevel = $("#schoolLevel").text().trim();
            console.log("Session Level:", sessionLevel); // Ambil session dari HTML
            // var API_URL = 'http://127.0.0.1:8000/api';

            // Fetch Fase
            $.ajax({
                url: API_URL + "/capaian-pembelajaran/fase",
                method: "POST",
                success: function(response) {
                    console.log("Fase Response:", response); // Debugging di Console

                    if (response.status === "success") {
                        let filteredData = response.data;

                        // Filter hanya untuk SD (Fase A, B, C)
                        if (sessionLevel === "sd" || sessionLevel === "paketa") {
                            filteredData = response.data.filter(item =>
                                item.fase.includes("Fase A") ||
                                item.fase.includes("Fase B") ||
                                item.fase.includes("Fase C")
                            );
                        }

                        if (sessionLevel === "smp" || sessionLevel === "paketb") {
                            filteredData = response.data.filter(item =>
                                item.fase.includes("Fase D")
                            );
                        }

                        if (sessionLevel === "sma" || sessionLevel === "smk" ||
                            sessionLevel === "paketc") {
                            filteredData = response.data.filter(item =>
                                item.fase.includes("Fase E") || item.fase.includes("Fase F")
                            );
                        }


                        // Tambahkan opsi ke dropdown
                        filteredData.forEach(function(item) {
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
    </script>
@endsection
