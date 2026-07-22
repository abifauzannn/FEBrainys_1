@extends('layouts.template')

@section('title', 'Riwayat Generasi - Brainys')

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
                <div class="ml-2 text-base font-semibold text-black">Kembali</div>
            </div>
        </button>

        <div class="flex flex-col justify-between w-full sm:flex-row">
            <div>
                <div class="text-gray-900 text-2xl font-semibold font-['Inter']">Riwayat Generasi</div>
                <div class="mt-2 text-sm leading-snug text-gray-500">Semua hasil pembuatan templat di tampilkan disini</div>
            </div>

            <div class="inline-flex justify-start sm:justify-center items-center gap-[16px] mt-[14px]">
                <div class="text-gray-900 text-md font-semibold font-['Inter']">Filter</div>
                <div class="relative">
                    <form method="GET" action="{{ route('history') }}" id="filterForm">
                        <input type="hidden" name="page" value="1">
                        <input type="hidden" name="type" id="filterInput" value="{{ $type }}">
                        <button type="button" id="filterButton"
                            class="flex items-center w-48 px-4 py-2 bg-white rounded-md shadow-md">
                            <span id="selectedOption">
                                {{ $type == 'all'
                                    ? 'Semua'
                                    : ($type == 'material'
                                        ? 'Modul Ajar'
                                        : ($type == 'syllabus'
                                            ? 'Silabus'
                                            : ($type == 'exercise'
                                                ? 'Soal'
                                                : ($type == 'hint'
                                                    ? 'Kisi Kisi Soal'
                                                    : ($type == 'atp'
                                                        ? 'ATP'
                                                        : ($type == 'bahan-ajar'
                                                            ? 'Bahan Ajar'
                                                            : ($type == 'gamification'
                                                                ? 'Materi Gamifikasi'
                                                                : ($type == 'simulation'
                                                                    ? 'Materi Simulasi'
                                                                    : '')))))))) }}
                            </span>
                        </button>

                        <div id="filterDropdown"
                            class="absolute z-50 hidden w-48 mt-2 bg-white border rounded-md shadow-md">
                            <button
                                class="inline-flex items-center justify-start w-full px-4 py-2 cursor-pointer filter-btn hover:bg-gray-100"
                                data-filter="all">
                                <span class="flex w-3 h-3 bg-gray-600 rounded-full me-3"></span>Semua
                            </button>
                            <button
                                class="inline-flex items-center justify-start w-full px-4 py-2 cursor-pointer filter-btn hover:bg-gray-100"
                                data-filter="material">
                                <span class="flex w-3 h-3 me-3 bg-[#225AAD] rounded-full"></span>Modul Ajar
                            </button>
                            <button
                                class="inline-flex items-center justify-start w-full px-4 py-2 cursor-pointer filter-btn hover:bg-gray-100"
                                data-filter="syllabus">
                                <span class="flex w-3 h-3 bg-blue-300 rounded-full me-3"></span>Silabus
                            </button>
                            <button
                                class="inline-flex items-center justify-start w-full px-4 py-2 cursor-pointer filter-btn hover:bg-gray-100"
                                data-filter="exercise">
                                <span class="flex w-3 h-3 me-3 bg-[#F2AC24] rounded-full"></span>Soal
                            </button>
                            <button
                                class="inline-flex items-center justify-start w-full px-4 py-2 cursor-pointer filter-btn hover:bg-gray-100"
                                data-filter="hint">
                                <span class="flex w-3 h-3 me-3 bg-[#38B70B] rounded-full"></span>Kisi Kisi Soal
                            </button>
                            <button
                                class="inline-flex items-center justify-start w-full px-4 py-2 cursor-pointer filter-btn hover:bg-gray-100"
                                data-filter="atp">
                                <span class="flex w-3 h-3 me-3 bg-[#7B35EE] rounded-full"></span>ATP
                            </button>
                            <button
                                class="inline-flex items-center justify-start w-full px-4 py-2 cursor-pointer filter-btn hover:bg-gray-100"
                                data-filter="bahan-ajar">
                                <span class="flex w-3 h-3 me-3 bg-[#FD6969] rounded-full"></span>Bahan Ajar
                            </button>
                            <button
                                class="inline-flex items-center justify-start w-full px-4 py-2 cursor-pointer filter-btn hover:bg-gray-100"
                                data-filter="gamification">
                                <span class="flex w-3 h-3 me-3 bg-[#D0EC27] rounded-full"></span>Materi Gamifikasi
                            </button>
                            {{-- SIMULASI --}}
                            <button
                                class="inline-flex items-center justify-start w-full px-4 py-2 cursor-pointer filter-btn hover:bg-gray-100"
                                data-filter="simulation">
                                <span class="flex w-3 h-3 me-3 bg-[#F97316] rounded-full"></span>Materi Simulasi
                            </button>
                        </div>

                    </form>

                </div>
            </div>
        </div>

        @if (session('error'))
            <p>{{ session('error') }}</p>
        @endif

        <div class="container py-5 mx-auto">
            <div class="grid grid-cols-1 gap-6 md:grid-cols-3 lg:grid-cols-4">
                @foreach ($historyData as $history)
                    <div class="flex flex-col justify-between h-auto p-6 duration-300 bg-white border border-gray-200 rounded-lg shadow history-item hover:shadow-lg hover:scale-100"
                        data-type="{{ $history['type'] }}">
                        <header class="mb-3">
                            @if ($history['type'] == 'material')
                                <button
                                    class="w-auto px-2 py-1 mb-3 text-xs font-bold text-blue-900 bg-blue-100 rounded-full hover:cursor-default"
                                    disabled>Modul Ajar</button>
                            @elseif ($history['type'] == 'syllabus')
                                <button
                                    class="w-auto px-2 py-1 mb-3 text-xs font-bold rounded-full bg-cyan-100 text-cyan-500 hover:cursor-default"
                                    disabled>Silabus</button>
                            @elseif ($history['type'] == 'exercise')
                                <button
                                    class="w-auto px-2 py-1 mb-3 text-xs font-bold text-orange-700 bg-yellow-100 rounded-full hover:cursor-default"
                                    disabled>Soal</button>
                            @elseif ($history['type'] == 'bahan-ajar')
                                <button
                                    class="w-auto px-2 py-1 mb-3 text-xs font-bold text-red-500 bg-red-100 rounded-full hover:cursor-default"
                                    disabled>Bahan Ajar</button>
                            @elseif ($history['type'] == 'gamification')
                                <button
                                    class="w-auto px-2 py-1 mb-3 text-xs font-bold rounded-full bg-lime-100 text-lime-500 hover:cursor-default"
                                    disabled>Gamifikasi</button>
                            @elseif ($history['type'] == 'hint')
                                <button
                                    class="w-auto px-2 py-1 mb-3 text-xs font-bold text-green-500 rounded-full bg-green-50 hover:cursor-default"
                                    disabled>Kisi Kisi</button>
                            @elseif ($history['type'] == 'atp')
                                <button
                                    class="w-auto px-2 py-1 mb-3 text-xs font-bold text-purple-900 rounded-full bg-purple-50 hover:cursor-default"
                                    disabled>ATP</button>
                            @elseif ($history['type'] == 'simulation')
                                <button
                                    class="w-auto px-2 py-1 mb-3 text-xs font-bold text-orange-500 bg-orange-100 rounded-full hover:cursor-default"
                                    disabled>Simulasi</button>
                            @endif
                            <div class="text-xl font-semibold text-gray-900 capitalize font-inter">
                                {{ $history['name'] ?? '' }}
                            </div>
                            <div class="mt-2 text-xs text-slate-400 font-inter"> Dibuat pada <span
                                    class="font-bold text-gray-900">{{ $history['created_at_format'] ?? $history['created_at'] }}</span>
                            </div>
                        </header>
                        <section class="w-full min-h-32 max-h-32">
                            <div class="mb-2 text-gray-700 break-words">{{ Str::limit($history['description'], 112) }}
                            </div>
                        </section>
                        <footer class="">
                            <button
                                class="flex items-center justify-center w-full gap-2 px-5 py-2 mt-3 text-blue-600 transition duration-300 ease-in-out border border-blue-600 rounded-full hover:bg-blue-600 hover:text-white hover:font-semibold"
                                onclick="
                                @if ($history['type'] == 'material') window.location = '{{ route('detailModulAjar', $history['id']) }}';
                                @elseif($history['type'] == 'bahan-ajar') window.location = '{{ route('detailBahanAjar', $history['id']) }}';
                                @elseif($history['type'] == 'syllabus') window.location = '{{ route('detailSyllabus', $history['id']) }}';
                                @elseif($history['type'] == 'exercise') window.location = '{{ route('detailExercise', $history['id']) }}';
                                @elseif($history['type'] == 'gamification') window.location = '{{ route('detailGamifikasi', $history['id']) }}';
                                @elseif($history['type'] == 'hint') window.location = '{{ route('detailKisi', $history['id']) }}';
                                @elseif($history['type'] == 'atp') window.location = '{{ route('detailAtp', $history['id']) }}';
                                @elseif($history['type'] == 'simulation') window.location = '{{ route('detailSimulasi', $history['id']) }}'; @endif">
                                <svg class="w-4 h-4 mb-[3px]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-width="2"
                                        d="M21 12c0 1.2-4 6-9 6s-9-4.8-9-6c0-1.2 4-6 9-6s9 4.8 9 6Z" />
                                    <path stroke="currentColor" stroke-width="2" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                </svg>
                                <a href="#">
                                    <span class="text-sm font-inter">VIEW ALL</span>
                                </a>
                            </button>
                            <form
                                action="@if ($history['type'] == 'material') {{ route('export-word') }}
                                @elseif ($history['type'] == 'syllabus') {{ route('export-word-syllabus') }}
                                @elseif ($history['type'] == 'exercise') {{ route('export-essay') }}
                                @elseif ($history['type'] == 'gamification') {{ route('export-gamifikasi-word') }}
                                @elseif ($history['type'] == 'bahan-ajar') {{ route('export-bahan-ajar') }}
                                @elseif ($history['type'] == 'hint') {{ route('export-kisi-kisi-word') }}
                                @elseif ($history['type'] == 'atp') {{ route('export-atp-word') }}
                                @elseif ($history['type'] == 'simulation') {{ route('export-simulasi-word') }} @endif"
                                method="post">
                                @csrf
                                <input type="hidden" name="generate_id" value="{{ $history['id'] }}">
                                <button
                                    class="flex items-center justify-center w-full gap-2 px-5 py-2 mt-3 text-green-600 transition duration-300 ease-in-out border border-green-600 rounded-full hover:bg-green-600 hover:text-white hover:font-semibold">
                                    <svg class="w-4 h-4 mb-[3px]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M14.707 7.793a1 1 0 0 0-1.414 0L11 10.086V1.5a1 1 0 0 0-2 0v8.586L6.707 7.793a1 1 0 1 0-1.414 1.414l4 4a1 1 0 0 0 1.416 0l4-4a1 1 0 0 0-.002-1.414Z" />
                                        <path
                                            d="M18 12h-2.55l-2.975 2.975a3.5 3.5 0 0 1-4.95 0L4.55 12H2a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-4a2 2 0 0 0-2-2Zm-3 5a1 1 0 1 1 0-2 1 1 0 0 1 0 2Z" />
                                    </svg>
                                    <span class="text-sm font-inter">EXPORT</span>
                                </button>
                            </form>
                        </footer>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Pagination Links -->
        <div class="flex justify-center mt-4 space-x-2">
            @if ($currentGroupStart > 1)
                <a href="{{ route('history', ['page' => $currentGroupStart - 1, 'type' => $type]) }}"
                    class="px-3 py-1 text-white bg-blue-500 rounded">Sebelumnya</a>
            @endif

            @for ($i = $currentGroupStart; $i <= $currentGroupEnd; $i++)
                <a href="{{ route('history', ['page' => $i, 'type' => $type]) }}"
                    class="px-3 py-1 {{ $i == $page ? 'bg-blue-500 text-white' : 'bg-white border' }} rounded">{{ $i }}</a>
            @endfor

            @if ($currentGroupEnd < $totalPages)
                <a href="{{ route('history', ['page' => $currentGroupEnd + 1, 'type' => $type]) }}"
                    class="px-3 py-1 text-white bg-blue-500 rounded">Berikutnya</a>
            @endif
        </div>
    </div>

    <script>
        document.getElementById('filterButton').addEventListener('click', function() {
            document.getElementById('filterDropdown').classList.toggle('hidden');
        });

        document.querySelectorAll('.filter-btn').forEach(function(button) {
            button.addEventListener('click', function() {
                var filterValue = this.getAttribute('data-filter');
                document.getElementById('filterInput').value = filterValue;
                document.getElementById('filterForm').submit();
            });
        });
    </script>
@endsection
