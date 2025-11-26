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

    @php
        $type = [['value' => 'analitik', 'label' => 'Analitik'], ['value' => 'sumatif', 'label' => 'Sumatif']];
    @endphp

    <x-page-title url="{{ route('dashboard') }}" title="Templat Rubrik Nilai"
        description="Gunakan templat rubrik penilaian di berbagai jenjang sekolah." />

    <div class="container flex flex-col px-3 mx-auto sm:px-10 lg:flex-row">
        <div class="w-full lg:w-[500px] flex-col justify-start items-start sm:gap-6 inline-flex h-auto">
            <form action="{{ route('generateRubrik') }}" method="post" class="w-full" id="modulAjarForm">
                <!-- Input untuk Nama Silabus -->
                @csrf

                <x-generate-field type="text" id="name" name="name" label="Nama Rubrik"
                    placeholder="masukan nama rubrik nilai" tooltipId="nameTooltip"
                    tooltipText="Contoh : Modul Ajar biologi smp kelas 8" />

                <!-- Toggle Untuk Menonaktifkan Chain Select & Topik Pembelajaran -->
                <div class="flex items-center justify-between gap-3">
                    <label class="text-[16px] font-medium text-[#111928]">Gunakan referensi dari modul ajar</label>

                    <label class="inline-flex items-center cursor-pointer">
                        <input type="checkbox" id="disableToggle" class="sr-only peer">
                        <div
                            class="relative h-6 transition-colors duration-300 bg-gray-300 rounded-full w-11 peer-checked:bg-blue-600">
                            <!-- Bullet dengan transisi -->
                            <span id="bullet"
                                class="absolute top-0.5 left-0.5 w-5 h-5 bg-white rounded-full shadow-md transition-all duration-300"></span>
                        </div>
                    </label>
                </div>

                <input type="hidden" id="data_source" name="data_source" value="manual">

                <div id="toggleHiddenGroup">
                    {{-- ------- START: CHAIN SELECT (ditempel langsung) ------- --}}
                    <div>
                        <p id="schoolLevel" class="hidden">{{ session('user')['school_level'] }}</p>

                        <!-- FASE DROPDOWN -->
                        <div class="mb-4 form-group">
                            <label for="fase">Fase (Kelas)</label>
                            <div class="relative w-full mt-3 custom-select-wrapper">
                                <button type="button" id="faseBtn" class="w-full custom-select-button">
                                    <span id="faseBtnText" class="custom-select-text">Select Fase</span>
                                    <svg class="custom-select-arrow" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2">
                                        <polyline points="6 9 12 15 18 9"></polyline>
                                    </svg>
                                </button>
                                <input type="hidden" id="fase" name="fase" required>

                                <div id="faseDropdown" class="hidden custom-select-dropdown">
                                    <div class="custom-select-search">
                                        <input type="text" id="faseSearch" class="custom-select-search-input"
                                            placeholder="Cari Fase...">
                                    </div>
                                    <ul id="faseList" class="custom-select-list">
                                        <li class="custom-select-empty">Loading...</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- MATA PELAJARAN DROPDOWN -->
                        <div class="mb-4 form-group lg:max-w-[500px]">
                            <label for="mata-pelajaran">Mata Pelajaran</label>
                            <div class="relative w-full mt-3 custom-select-wrapper">
                                <button type="button" id="mataBtn" class="w-full custom-select-button" disabled>
                                    <span id="mataBtnText" class="custom-select-text">Select Mata Pelajaran</span>
                                    <svg class="custom-select-arrow" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2">
                                        <polyline points="6 9 12 15 18 9"></polyline>
                                    </svg>
                                </button>
                                <input type="hidden" id="mata-pelajaran" name="mata-pelajaran" required>

                                <div id="mataDropdown" class="hidden custom-select-dropdown">
                                    <div class="custom-select-search">
                                        <input type="text" id="mataSearch" class="custom-select-search-input"
                                            placeholder="Cari Mata Pelajaran...">
                                    </div>
                                    <ul id="mataList" class="custom-select-list">
                                        <li class="custom-select-empty">Select Fase terlebih dahulu</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- ELEMEN CAPAIAN DROPDOWN -->
                        <div class="mb-4 form-group">
                            <label for="element">Elemen Capaian</label>
                            <div class="relative w-full mt-3 custom-select-wrapper">
                                <button type="button" id="elementBtn" class="w-full custom-select-button" disabled>
                                    <span id="elementBtnText" class="custom-select-text">Select Element</span>
                                    <svg class="custom-select-arrow" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2">
                                        <polyline points="6 9 12 15 18 9"></polyline>
                                    </svg>
                                </button>
                                <input type="hidden" id="element" name="element" required>

                                <div id="elementDropdown" class="hidden custom-select-dropdown">
                                    <div class="custom-select-search">
                                        <input type="text" id="elementSearch" class="custom-select-search-input"
                                            placeholder="Cari Element...">
                                    </div>
                                    <ul id="elementList" class="custom-select-list">
                                        <li class="custom-select-empty">Select Mata Pelajaran terlebih dahulu</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- ------- END: CHAIN SELECT ------- --}}

                    <x-generate-field type="text" id="topik_pembelajaran" name="topik_pembelajaran"
                        label="Topik Pembelajaran" placeholder="masukan topik pembelajaran" tooltipText="" />
                </div>

                <div id="loadModulWrapper" style="display: none;">
                    {{-- ------- START: LOAD MODUL (ditempel langsung) ------- --}}
                    <div class="mb-4 form-group">
                        <label for="history">Load Modul Ajar</label>

                        <div class="relative w-full mt-3 custom-select-wrapper">
                            <button type="button" id="history-btn" class="w-full custom-select-button">
                                <span id="history-btn-text" class="custom-select-text">Pilih Modul Ajar</span>
                                <svg class="custom-select-arrow" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2">
                                    <polyline points="6 9 12 15 18 9"></polyline>
                                </svg>
                            </button>

                            <input type="hidden" id="history" name="history">

                            <div id="history-dropdown" class="hidden custom-select-dropdown">
                                <div class="custom-select-search">
                                    <input type="text" id="history-search" class="custom-select-search-input"
                                        placeholder="Cari Modul...">
                                </div>

                                <ul id="history-list" class="custom-select-list">
                                    <li class="custom-select-empty">Loading...</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    {{-- ------- END: LOAD MODUL ------- --}}
                </div>

                <x-select-field id="type" label="Jenis Rubrik" name="type" :options="$type"
                    defaultOption="Pilih Jenis Rubrik" />

                <x-textarea-field id="notes" name="notes" label="Deskripsi rubrik nilai"
                    tooltipId="descriptionTooltip" placeholder="masukan deskripsi rubrik nilai"
                    tooltipText="Contoh :
                 buatkan modul ajar untuk rangkaian listrik" />

                <div class="flex items-center justify-between -mt-2">
                    <div class="inline-flex items-end self-stretch justify-start gap-5">
                        <div id="characterCount"
                            class="text-sm font-normal leading-snug text-left text-gray-500 font-inter">0/250</div>
                    </div>
                </div>

                <div class="flex justify-between pt-6">
                    <button type="button" onclick="clearInputs()"
                        class="group h-12 px-6 bg-white rounded-lg justify-center items-center gap-2.5 inline-flex border border-gray-900 hover:bg-gray-900 hover:border-white hover:text-white transition duration-300 ease-in-out">
                        <svg width="20" height="20" viewBox="0 0 20 20"
                            class="transition duration-300 ease-in-out group-hover:fill-white"
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
                                d="M9.107 5.448c.598-1.75 3.016-1.803 3.725-.159l.06.16l.807 2.36a4 4 0 0 0 2.276 2.411l.217.081l2.36.806c1.75.598 1.803 3.016.16 3.725l-.16.06l-2.36.807a4 4 0 0 0-2.412 2.276l-.081-.216l-.806 2.361c-.598 1.75-3.016 1.803-3.724.16l-.062-.16l-.806-2.36a4 4 0 0 0-2.276-2.412l-.216-.081l-2.36-.806c-1.751-.598-1.804-3.016-.16-3.724l.16-.062l2.36-.806A4 4 0 0 0 8.22 8.025l.081-.216zM19 2a1 1 0 0 1 .898.56l.048.117l.35 1.026l1.027.35a1 1 0 0 1 .118 1.845l-.118.048l-1.026.35l-.35 1.027a1 1 0 0 1-1.845.117l-.048-.117l-.35-1.026l-1.027-.35a1 1 0 0 1-.118-1.845l.118-.048l1.026-.35l.35-1.027A1 1 0 0 1 19 2" />
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

    {{-- ---------------------------- --}}
    {{-- SCRIPTS (jQuery sekali, lalu merged logic) --}}
    {{-- ---------------------------- --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(function() {

            /* =========================
             * CREDIT COUNTER AJAX
             * ========================= */
            $.ajax({
                url: "{{ route('get.credit.charges.modulAjar') }}",
                type: "GET",
                beforeSend() {
                    $('#creditValue').text("Loading...");
                },
                success(response) {
                    $('#creditValue').text(
                        response.success ?
                        response.credit_charged_generate :
                        "Gagal mengambil data"
                    );
                },
                error() {
                    console.log(response)
                }
            });

            /* ==================================================
             * Global helpers & shared dropdown utilities (merged)
             * ================================================== */

            // single truncate used by both
            function truncate(text, max = 32) {
                if (!text && text !== 0) return "";
                text = String(text);
                return text.length > max ? text.substring(0, max) + "..." : text;
            }

            // close all dropdowns & remove active class
            function closeAllDropdowns() {
                $('.custom-select-dropdown').addClass('hidden');
                $('.custom-select-button').removeClass('active');
            }

            // close dropdown helper for plain DOM usage too
            function closeDropdownByEl($btn, $dropdown) {
                $dropdown.addClass('hidden');
                $btn.removeClass('active');
            }

            // Make sure clicking outside closes everything
            $(document).on('click', function(e) {
                // if click not inside any custom select wrapper -> close all
                if (!$(e.target).closest('.custom-select-wrapper').length) {
                    closeAllDropdowns();
                }
            });

            // small util for keyboard/search behavior (will be attached per-dropdown below)
            function attachSearchHandler($searchInput, $list) {
                let sTimeout;
                $searchInput.on('input', function() {
                    clearTimeout(sTimeout);
                    sTimeout = setTimeout(() => {
                        const q = (this.value || '').toLowerCase();
                        $list.find('.custom-select-item').each(function() {
                            const text = $(this).text().toLowerCase();
                            $(this).toggle(text.includes(q));
                        });
                        // For history which uses class .history-item
                        $list.find('.history-item').each(function() {
                            const text = $(this).text().toLowerCase();
                            $(this).toggle(text.includes(q));
                        });
                    }, 120);
                });
            }

            /* ==================================================
             * CHAIN SELECT (merged logic)
             * ================================================== */
            const API_URL = 'https://be.brainys.oasys.id/api';
            const sessionLevel = $("#schoolLevel").text().trim();

            let faseData = [];
            let mataData = {};
            let elementData = {};

            // init dropdown open handlers (DOM-based)
            function initDropdown(triggerSelector, dropdownSelector, searchSelector) {
                const $trigger = $(triggerSelector);
                const $dropdown = $(dropdownSelector);
                const $search = $(searchSelector);
                const $list = $dropdown.find('.custom-select-list');

                // open/close
                $trigger.on('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    const isOpen = !$dropdown.hasClass('hidden');
                    closeAllDropdowns();
                    if (!isOpen) {
                        $dropdown.removeClass('hidden');
                        $trigger.addClass('active');
                        // focus search if present
                        $search && $search.focus();
                    }
                });

                // search behavior
                if ($search.length && $list.length) {
                    attachSearchHandler($search, $list);
                }
            }

            // Load fase
            $.ajax({
                url: API_URL + "/capaian-pembelajaran/fase",
                method: "POST",
                success: function(response) {
                    if (response.status === "success") {
                        faseData = response.data.filter(i => {
                            if (sessionLevel === "sd" || sessionLevel === "paketa") {
                                return i.fase.includes("Fase A") || i.fase.includes("Fase B") ||
                                    i.fase
                                    .includes("Fase C");
                            }
                            if (sessionLevel === "smp" || sessionLevel === "paketb") {
                                return i.fase.includes("Fase D");
                            }
                            if (sessionLevel === "sma" || sessionLevel === "smk" ||
                                sessionLevel ===
                                "paketc") {
                                return i.fase.includes("Fase E") || i.fase.includes("Fase F");
                            }
                            return true;
                        });

                        const $faseList = $('#faseList');
                        $faseList.html(
                            faseData.map(item =>
                                `<li class="custom-select-item" data-value="${item.fase}">${item.fase}</li>`
                            ).join('')
                        );

                        // Attach event listeners
                        $faseList.find('.custom-select-item').on('click', function(e) {
                            const value = $(this).data('value');
                            selectFase(value);
                        });
                    }
                },
                error: function() {
                    $('#faseList').html(`<li class="custom-select-empty">Gagal memuat fase</li>`);
                }
            });

            function selectFase(value) {
                $('#fase').val(value);
                $('#faseBtnText').text(truncate(value, 30));
                closeAllDropdowns();
                $('#faseBtn').removeClass('active');

                // Load Mata Pelajaran
                $.ajax({
                    url: API_URL + "/capaian-pembelajaran/mata-pelajaran",
                    method: "POST",
                    contentType: "application/json",
                    data: JSON.stringify({
                        fase: value
                    }),
                    success: function(response) {
                        if (response.status === "success") {
                            mataData[value] = response.data;
                            const mataHtml = response.data.map(item =>
                                `<li class="custom-select-item" data-value="${item.mata_pelajaran}">${item.mata_pelajaran}</li>`
                            ).join('');
                            $('#mataList').html(mataHtml);

                            $('#mataBtn').prop('disabled', false);
                            $('#mataBtnText').text('Select Mata Pelajaran');
                            $('#mata-pelajaran').val('');

                            $('#mataList').find('.custom-select-item').on('click', function() {
                                selectMata($(this).data('value'));
                            });
                        }
                    },
                    error: function() {
                        $('#mataList').html(
                            `<li class="custom-select-empty">Gagal memuat mata pelajaran</li>`);
                    }
                });
            }

            function selectMata(value) {
                $('#mata-pelajaran').val(value);
                $('#mataBtnText').text(truncate(value, 30));
                closeAllDropdowns();
                $('#mataBtn').removeClass('active');

                const fase = $('#fase').val();

                // Load Element
                $.ajax({
                    url: API_URL + "/capaian-pembelajaran/element",
                    method: "POST",
                    contentType: "application/json",
                    data: JSON.stringify({
                        fase,
                        mata_pelajaran: value
                    }),
                    success: function(response) {
                        if (response.status === "success") {
                            const elementHtml = response.data.map(item =>
                                `<li class="custom-select-item" data-value="${item.element}">${item.element}</li>`
                            ).join('');
                            $('#elementList').html(elementHtml);

                            $('#elementBtn').prop('disabled', false);
                            $('#elementBtnText').text('Select Element');
                            $('#element').val('');

                            $('#elementList').find('.custom-select-item').on('click', function() {
                                selectElement($(this).data('value'));
                            });
                        }
                    },
                    error: function() {
                        $('#elementList').html(
                            `<li class="custom-select-empty">Gagal memuat elemen</li>`);
                    }
                });
            }

            function selectElement(value) {
                $('#element').val(value);
                $('#elementBtnText').text(value);
                closeAllDropdowns();
                $('#elementBtn').removeClass('active');
            }

            // Initialize chain dropdowns
            initDropdown('#faseBtn', '#faseDropdown', '#faseSearch');
            initDropdown('#mataBtn', '#mataDropdown', '#mataSearch');
            initDropdown('#elementBtn', '#elementDropdown', '#elementSearch');

            /* ==================================================
             * LOAD MODUL (merged logic)
             * ================================================== */

            let historyData = [];
            let loadingHistory = false;
            let loadedHistory = false;

            const $historyBtn = $('#history-btn');
            const $historyDropdown = $('#history-dropdown');
            const $historyList = $('#history-list');
            const $historySearch = $('#history-search');

            // skeleton & error states
            const skeletonHtml = `<li class='custom-select-empty animate-pulse'>Sedang memuat modul...</li>`;
            const errorStateHtml = `
                <li class="text-red-600 custom-select-empty">
                    Gagal memuat.
                    <button id="history-retry" class="ml-1 text-blue-600 underline">Retry</button>
                </li>
            `;

            function fetchHistory() {
                if (loadingHistory || loadedHistory) return;
                loadingHistory = true;
                $historyList.html(skeletonHtml);

                $.ajax({
                    url: "{{ route('loadModul') }}",
                    method: "GET",
                    timeout: 7000,
                    success: (res) => {
                        loadingHistory = false;
                        loadedHistory = true;

                        const items = res.data.items || [];

                        if (!items.length) {
                            $historyList.html(`<li class='custom-select-empty'>Tidak ada modul</li>`);
                            return;
                        }

                        historyData = items;

                        $historyList.html(
                            items.map(i => `
                                <li class="history-item custom-select-item" data-id="${i.id}">
                                    ${i.name} - ${i.subject}
                                </li>
                            `).join("")
                        );

                        // attach click
                        $historyList.find('.history-item').on('click', function() {
                            selectHistory($(this).data('id'));
                        });
                    },
                    error: () => {
                        loadingHistory = false;
                        $historyList.html(errorStateHtml);
                        $('#history-retry').on('click', fetchHistory);
                    }
                });
            }

            function selectHistory(id) {
                const item = historyData.find(x => x.id == id);
                if (!item) return;
                $('#history').val(id);
                $('#history-btn-text').text(truncate(item.name + " - " + item.subject, 30));
                closeAllDropdowns();
            }

            // open history dropdown
            $historyBtn.on('click', function(e) {
                e.stopPropagation();
                const open = !$historyDropdown.hasClass('hidden');

                // close other dropdowns first
                closeAllDropdowns();

                if (!open) {
                    $historyDropdown.removeClass('hidden');
                    $historyBtn.addClass('active');
                    $historySearch.focus();
                    fetchHistory();
                }
            });

            // history search
            attachSearchHandler($historySearch, $historyList);

            /* ==================================================
             * initDropdown for history already done above behavior-like
             * ================================================== */

            /* ==================================================
             * TOGGLE SWITCH HANDLER (merged)
             * ================================================== */
            const toggle = document.getElementById("disableToggle");
            const group = document.getElementById("toggleHiddenGroup");
            const loadModulWrapper = $("#loadModulWrapper");
            const dataSourceInput = document.getElementById("data_source");
            const topikPembelajaranInput = document.getElementById("topik_pembelajaran");

            // move bullet initial position based on checkbox status (sensible default)
            if (document.getElementById('disableToggle').checked) {
                $('#bullet').css('transform', 'translateX(1.25rem)');
                dataSourceInput.value = "modul_ajar"; // Set initial value if already checked
                topikPembelajaranInput.removeAttribute('required'); // Remove requiredx
            }

            toggle.addEventListener("change", function() {
                if (this.checked) {

                    // HIDE chain select, SHOW load modul
                    group.style.display = "none";
                    loadModulWrapper.show();

                    // Set data_source ke "modul-ajar"
                    dataSourceInput.value = "modul_ajar";

                    // clear chain values
                    $("#fase").val("");
                    $("#mata-pelajaran").val("");
                    $("#element").val("");
                    $("#topik_pembelajaran").val("");

                    $("#faseBtnText").text("Select Fase");
                    $("#mataBtnText").text("Select Mata Pelajaran");
                    $("#elementBtnText").text("Select Element");
                    document.getElementById('bullet').style.transform = 'translateX(1.25rem)';

                    // REMOVE required dari topik_pembelajaran
                    topikPembelajaranInput.removeAttribute('required');

                    // fetch load-modul data
                    fetchHistory();

                } else {

                    // Set data_source ke "manual"
                    dataSourceInput.value = "manual";

                    // ADD required ke topik_pembelajaran
                    topikPembelajaranInput.setAttribute('required', 'required');

                    // SHOW chain select, HIDE load modul
                    group.style.display = "block";
                    loadModulWrapper.hide();
                    document.getElementById('bullet').style.transform = 'translateX(0)';
                }
            });

            /* ==================================================
             * FORM SUBMIT LOADER (merged)
             * ================================================== */
            document.getElementById('modulAjarForm').addEventListener('submit', function(event) {
                // show loader UI
                $("#submitButton").hide();
                $("#loadingButton").show();
                $("#outputContent").hide();
                // allow form to submit naturally

                console.log("#history")
            });

            /* ==================================================
             * Initialize: attach other searches (fase/mata/element)
             * ================================================== */
            attachSearchHandler($('#faseSearch'), $('#faseList'));
            attachSearchHandler($('#mataSearch'), $('#mataList'));
            attachSearchHandler($('#elementSearch'), $('#elementList'));

            // Clear inputs helper (used by tombol "Hapus")
            window.clearInputs = function() {
                // reset form fields
                $('#modulAjarForm')[0].reset();
                // reset custom selects
                $('#fase').val('');
                $('#mata-pelajaran').val('');
                $('#element').val('');
                $('#history').val('');

                // Set required kembali ke topik_pembelajaran (karena default toggle OFF)
                topikPembelajaranInput.setAttribute('required', 'required');

                $('#faseBtnText').text('Select Fase');
                $('#mataBtnText').text('Select Mata Pelajaran');
                $('#elementBtnText').text('Select Element');
                $('#history-btn-text').text('Pilih Modul Ajar');
                closeAllDropdowns();
            };

        }); // end $(function)
    </script>

@endsection
