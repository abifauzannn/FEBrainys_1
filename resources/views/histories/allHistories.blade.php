@extends('layouts.template')

@section('title', 'History Modul Ajar - Brainys')

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

    <div class="container mx-auto px-4 sm:px-10 py-9 font-['Inter']">

        <button onclick="window.location='{{ route('dashboard') }}'" class="mb-6">
            <div class="flex items-center">
                <img src="{{ URL('images/back.svg') }}" alt="" class="w-6 h-6">
                <div class="text-black text-base font-semibold ml-2">Kembali</div>
            </div>
        </button>

        <div class="w-full flex justify-between flex-col sm:flex-row">
            <div>
                <div class="text-gray-900 text-2xl font-semibold font-['Inter']">Riwayat Generasi</div>
                <div class="mt-2 text-gray-500 text-sm leading-snug">Semua hasil pembuatan templat di tampilkan disini</div>
            </div>

            <div class="inline-flex justify-start sm:justify-center items-center gap-[16px] mt-[14px]">
                <div class="text-gray-900 text-md font-semibold font-['Inter']">Filter</div>
                <div class="relative">
                    <button id="filterButton" class="py-2 px-4 bg-white rounded-md shadow-md flex items-center w-48">
                        <span id="selectedOption" class="">Semua</span>
                    </button>

                    <div id="filterDropdown" class="hidden absolute bg-white border rounded-md shadow-md w-48 mt-2 z-50">
                        <button
                            class="filter-btn px-4 py-2 cursor-pointer hover:bg-gray-100 inline-flex justify-start items-center w-full"
                            data-filter="all">
                            <span class="flex w-3 h-3 me-3 bg-grey-600 rounded-full"></span>Semua
                        </button>
                        <button
                            class="filter-btn px-4 py-2 cursor-pointer hover:bg-gray-100 inline-flex justify-start items-center w-full"
                            data-filter="material">
                            <span class="flex w-3 h-3 me-3 bg-[#225AAD] rounded-full"></span>Modul Ajar
                        </button>
                        <button
                            class="filter-btn px-4 py-2 cursor-pointer hover:bg-gray-100 inline-flex justify-start items-center w-full"
                            data-filter="syllabus">
                            <span class="flex w-3 h-3 me-3 bg-blue-300 rounded-full"></span>Silabus
                        </button>
                        <button
                            class="filter-btn px-4 py-2 cursor-pointer hover:bg-gray-100 inline-flex justify-start items-center w-full"
                            data-filter="exercise">
                            <span class="flex w-3 h-3 me-3 bg-[#F2AC24] rounded-full"></span>Soal
                        </button>
                        <button
                            class="filter-btn px-4 py-2 cursor-pointer hover:bg-gray-100 inline-flex justify-start items-center w-full"
                            data-filter="exercise">
                            <span class="flex w-3 h-3 me-3 bg-[#38B70B] rounded-full"></span>Kisi
                            Kisi Soal
                        </button>
                        <button
                            class="filter-btn px-4 py-2 cursor-pointer hover:bg-gray-100 inline-flex justify-start items-center w-full"
                            data-filter="exercise">
                            <span class="flex w-3 h-3 me-3 bg-[#7B35EE] rounded-full"></span>ATP
                        </button>
                        <button
                            class="filter-btn px-4 py-2 cursor-pointer hover:bg-gray-100 inline-flex justify-start items-center w-full"
                            data-filter="bahan-ajar">
                            <span class="flex w-3 h-3 me-3 bg-[#FD6969] rounded-full"></span>Bahan Ajar
                        </button>
                        <button
                            class="filter-btn px-4 py-2 cursor-pointer hover:bg-gray-100 inline-flex justify-start items-center w-full"
                            data-filter="exercise">
                            <span class="flex w-3 h-3 me-3 bg-[#D0EC27] rounded-full"></span>Materi Gamifikasi
                        </button>
                    </div>
                </div>
            </div>
        </div>

        @if (session('error'))
            <p>{{ session('error') }}</p>
        @endif

        <div class="container mx-auto py-5">
            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach ($allHistory as $history)
                    <div class="history-item h-auto p-6 bg-white border border-gray-200 rounded-lg shadow flex flex-col justify-between hover:shadow-lg hover:scale-100 duration-300"
                        data-type="{{ $history['type'] }}">
                        <header class="mb-3">
                            @if ($history['type'] == 'material')
                                <button
                                    class="w-auto bg-[#225AAD] text-white px-2 py-1 rounded-full mb-3 font-bold text-xs hover:cursor-default"
                                    disabled>Modul Ajar</button>
                            @elseif ($history['type'] == 'syllabus')
                                <button
                                    class="w-auto bg-yellow-100 text-orange-700 px-2 py-1 rounded-full mb-3 font-bold text-xs hover:cursor-default"
                                    disabled>Silabus</button>
                            @elseif ($history['type'] == 'exercise')
                                <button
                                    class="w-auto bg-blue-100 text-blue-700 px-2 py-1 rounded-full mb-3 font-bold text-xs hover:cursor-default"
                                    disabled>Soal</button>
                            @elseif ($history['type'] == 'bahan-ajar')
                                <button
                                    class="w-auto  bg-[#FD6969] text-white px-2 py-1 rounded-full mb-3 font-bold text-xs hover:cursor-default"
                                    disabled>Bahan Ajar</button>
                            @endif
                            <div class="text-gray-900 text-xl font-semibold font-inter capitalize">{{ $history['name'] }}
                            </div>
                            <div class="text-slate-400 text-xs font-inter mt-2"> Dibuat pada <span
                                    class="text-gray-900 font-bold">{{ date('d F Y | H:i', strtotime($history['created_at'])) }}</span>
                            </div>
                        </header>
                        <section class="w-full min-h-32 max-h-32">
                            <div class="text-gray-700 mb-2 break-words">{{ Str::limit($history['description'], 112) }}</div>
                        </section>
                        <footer class="">
                            <button
                                class="border border-blue-600 px-5 py-2 rounded-full text-blue-600 mt-3 gap-2 hover:bg-blue-600 hover:text-white transition duration-300 ease-in-out w-full flex justify-center items-center hover:font-semibold"
                                onclick="
                                @if ($history['type'] == 'material') window.location = '{{ route('detailModulAjar', $history['id']) }}';
                                @elseif($history['type'] == 'syllabus') window.location = '{{ route('detailSyllabus', $history['id']) }}';
                                @else window.location = '{{ route('detailExercise', $history['id']) }}'; @endif">
                                <svg class="w-4 h-4 mb-[3px]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-width="2"
                                        d="M21 12c0 1.2-4 6-9 6s-9-4.8-9-6c0-1.2 4-6 9-6s9 4.8 9 6Z" />
                                    <path stroke="currentColor" stroke-width="2" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                </svg>
                                <a href="#">
                                    <span class="font-inter text-sm">VIEW ALL</span>
                                </a>
                            </button>
                            <form
                                action="@if ($history['type'] == 'material') {{ route('export-word') }}
                                @elseif ($history['type'] == 'syllabus') {{ route('export-word-syllabus') }}
                                @elseif ($history['type'] == 'exercise') {{ route('export-essay') }} @endif"
                                method="post">
                                @csrf
                                <input type="hidden" name="generate_id" value="{{ $history['id'] }}">
                                <button
                                    class="border border-green-600 px-5 py-2 rounded-full text-green-600 mt-3 gap-2 hover:bg-green-600 hover:text-white hover:font-semibold transition duration-300 ease-in-out w-full flex justify-center items-center">
                                    <svg class="w-4 h-4 mb-[3px]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M14.707 7.793a1 1 0 0 0-1.414 0L11 10.086V1.5a1 1 0 0 0-2 0v8.586L6.707 7.793a1 1 0 1 0-1.414 1.414l4 4a1 1 0 0 0 1.416 0l4-4a1 1 0 0 0-.002-1.414Z" />
                                        <path
                                            d="M18 12h-2.55l-2.975 2.975a3.5 3.5 0 0 1-4.95 0L4.55 12H2a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-4a2 2 0 0 0-2-2Zm-3 5a1 1 0 1 1 0-2 1 1 0 0 1 0 2Z" />
                                    </svg>
                                    <span class="font-inter text-sm">EXPORT</span>
                                </button>
                            </form>
                        </footer>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <script>
        // Toggle the dropdown visibility
        document.getElementById('filterButton').addEventListener('click', function() {
            document.getElementById('filterDropdown').classList.toggle('hidden');
        });

        // Change filter option
        document.querySelectorAll('.filter-btn').forEach(function(button) {
            button.addEventListener('click', function() {
                var filter = this.getAttribute('data-filter');
                document.getElementById('selectedOption').textContent = this.textContent;
                document.getElementById('filterDropdown').classList.add('hidden');
                filterHistory(filter);
            });
        });

        // Function to filter history items
        function filterHistory(filter) {
            var items = document.querySelectorAll('.history-item');
            items.forEach(function(item) {
                if (filter === 'all') {
                    item.style.display = 'block';
                } else {
                    if (item.getAttribute('data-type') === filter) {
                        item.style.display = 'block';
                    } else {
                        item.style.display = 'none';
                    }
                }
            });
        }

        // Close the dropdown if clicked outside
        document.addEventListener('click', function(event) {
            var isClickInside = document.getElementById('filterButton').contains(event.target) || document
                .getElementById('filterDropdown').contains(event.target);
            if (!isClickInside) {
                document.getElementById('filterDropdown').classList.add('hidden');
            }
        });
    </script>

@endsection
