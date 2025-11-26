@extends('generates.generateRubrik')

@section('title', 'Templat Rubrik Nilai - Brainys')

@section('meta')
    <meta name="robots" content="noindex, nofollow">
@endsection

@section('output')

    @php
        $data = session('data');
        $generateId = session('generateId');
    @endphp

    {{-- ====================================================== --}}
    {{-- =============== BAGIAN INFORMASI UMUM ================ --}}
    {{-- ====================================================== --}}
    @if (isset($data['informasi_umum']))
        <div class="mt-5 overflow-x-auto">
            <table class="w-full bg-white border">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="px-6 py-3 text-sm font-bold text-left text-gray-800 uppercase" colspan="2">
                            Informasi Umum
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ([
            'nama_rubrik_nilai' => 'Nama Rubrik Nilai',
            'penyusun' => 'Penyusun',
            'jenjang_sekolah' => 'Jenjang Sekolah',
            'fase_kelas' => 'Fase/Kelas',
            'mata_pelajaran' => 'Mata Pelajaran',
            'element' => 'Elemen',
            'topik_pembelajaran' => 'Topik Pembelajaran',
            'sumber_data' => 'Sumber Data',
            'jenis_rubrik' => 'Jenis Rubrik',
        ] as $key => $label)
                        <tr>
                            <td class="px-6 py-4 text-sm font-semibold text-gray-800 dark:text-gray-200 bg-slate-50">
                                {{ $label }}</td>
                            <td class="px-6 py-4 text-sm text-gray-800">{{ $data['informasi_umum'][$key] ?? '-' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

    {{-- ====================================================== --}}
    {{-- ================ MODE SUMATIF ========================= --}}
    {{-- ====================================================== --}}
    @if (isset($data['type']) && $data['type'] == 'sumatif')

        {{-- ==== DESKRIPSI ASESMEN SUMATIF ==== --}}
        @if (isset($data['deskripsi_asesmen']))
            <div class="p-6 mt-10 bg-white border rounded-lg">
                <h2 class="mb-4 text-lg font-bold">Deskripsi Asesmen</h2>

                @foreach ([
            'jenis_tugas' => 'Jenis Tugas',
            'tugas_asesmen' => 'Tugas Asesmen',
            'instruksi_lengkap' => 'Instruksi',
            'tujuan_asesmen' => 'Tujuan Asesmen',
            'nama_tabel' => 'Nama Tabel',
        ] as $key => $label)
                    @if (isset($data['deskripsi_asesmen'][$key]))
                        <div class="mb-3">
                            <p class="font-semibold text-gray-700">{{ $label }}</p>
                            <p class="text-gray-800 whitespace-pre-wrap">{{ $data['deskripsi_asesmen'][$key] }}</p>
                        </div>
                    @endif
                @endforeach
            </div>
        @endif

        {{-- ==== TABEL RUBRIK SUMATIF ==== --}}
        @if (isset($data['pencapaian']))
            <div class="mt-10">
                <h2 class="mb-4 text-lg font-bold">Rubrik Penilaian Sumatif</h2>

                @foreach ($data['pencapaian'] as $row)
                    <div class="mb-8 overflow-x-auto">
                        <div class="p-3 text-lg font-bold border-l-4 border-blue-500 bg-slate-50">
                            {{ $row['level_pencapaian'] ?? '-' }}
                        </div>
                        <table class="w-full bg-white">
                            @if (isset($row['deskripsi']))
                                <tr>
                                    <td class="w-1/4 px-4 py-3 font-semibold bg-slate-50">Deskripsi</td>
                                    <td class="px-4 py-3">
                                        @if (is_array($row['deskripsi']))
                                            <ul class="ml-5 list-disc">
                                                @foreach ($row['deskripsi'] as $d)
                                                    <li>{{ $d }}</li>
                                                @endforeach
                                            </ul>
                                        @else
                                            {{ $row['deskripsi'] }}
                                        @endif
                                    </td>
                                </tr>
                            @endif

                            @if (isset($row['indikasi_pencapaian']))
                                <tr>
                                    <td class="w-1/4 px-4 py-3 font-semibold bg-slate-50">Indikasi</td>
                                    <td class="px-4 py-3">
                                        @if (is_array($row['indikasi_pencapaian']))
                                            <ul class="ml-5 list-disc">
                                                @foreach ($row['indikasi_pencapaian'] as $i)
                                                    <li>{{ $i }}</li>
                                                @endforeach
                                            </ul>
                                        @else
                                            {{ $row['indikasi_pencapaian'] }}
                                        @endif
                                    </td>
                                </tr>
                            @endif
                        </table>
                    </div>
                @endforeach
            </div>
        @endif

    @endif


    {{-- ====================================================== --}}
    {{-- ================ MODE ANALITIK ======================== --}}
    {{-- ====================================================== --}}
    @if (isset($data['type']) && $data['type'] == 'analitik')

        {{-- ==== DESKRIPSI ASESMEN ANALITIK ==== --}}
        @if (isset($data['deskripsi_asesmen']))
            <div class="p-6 mt-10 bg-white border">
                <h2 class="mb-4 text-lg font-bold">Deskripsi Asesmen</h2>

                @foreach ($data['deskripsi_asesmen'] as $key => $value)
                    @if ($key !== 'sumber_referensi' && isset($value))
                        <div class="mb-3">
                            <p class="font-semibold text-gray-700">{{ ucwords(str_replace('_', ' ', $key)) }}</p>
                            @if (is_array($value))
                                <p class="text-gray-800">{{ json_encode($value) }}</p>
                            @else
                                <p class="text-gray-800">{{ $value }}</p>
                            @endif
                        </div>
                    @endif
                @endforeach
            </div>
        @endif

        {{-- ==== SUMBER REFERENSI ==== --}}
        @if (isset($data['deskripsi_asesmen']['sumber_referensi']))
            <div class="p-6 mt-10 bg-white border">
                <h2 class="mb-4 text-lg font-bold">Sumber Referensi</h2>

                @if (isset($data['deskripsi_asesmen']['sumber_referensi']['kata_kunci']))
                    <div class="mb-4">
                        <p class="font-semibold text-gray-700">Kata Kunci</p>
                        <div class="flex flex-wrap gap-2 mt-2">
                            @foreach ($data['deskripsi_asesmen']['sumber_referensi']['kata_kunci'] as $kunci)
                                <span class="px-3 py-1 text-blue-800 bg-blue-100 rounded">{{ $kunci }}</span>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if (isset($data['deskripsi_asesmen']['sumber_referensi']['jenis_video_rekomendasi']))
                    <div class="mb-4">
                        <p class="font-semibold text-gray-700">Jenis Video Rekomendasi</p>
                        <ul class="ml-5 list-disc">
                            @foreach ($data['deskripsi_asesmen']['sumber_referensi']['jenis_video_rekomendasi'] as $video)
                                <li>{{ $video }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if (isset($data['deskripsi_asesmen']['sumber_referensi']['platform_pencarian']))
                    <div>
                        <p class="font-semibold text-gray-700">Platform Pencarian</p>
                        <p class="text-gray-800">{{ $data['deskripsi_asesmen']['sumber_referensi']['platform_pencarian'] }}
                        </p>
                    </div>
                @endif
            </div>
        @endif

        {{-- ==== TABEL RUBRIK ANALITIK ==== --}}
        @if (isset($data['kriteria_penilaian']))
            <div class="mt-10 overflow-x-auto">
                <h2 class="mb-4 text-lg font-bold">Kriteria Penilaian</h2>

                <table class="w-full bg-white">
                    <thead class="bg-slate-50">
                        <tr>
                            <th class="px-4 py-3 text-left">Kriteria</th>
                            <th class="px-4 py-3 text-left">Melebihi Ekspektasi</th>
                            <th class="px-4 py-3 text-left">Sesuai Ekspektasi</th>
                            <th class="px-4 py-3 text-left">Sedang Berkembang</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data['kriteria_penilaian'] as $row)
                            <tr class="">
                                <td class="px-4 py-3 font-semibold align-top bg-slate-50">{{ $row['kriteria'] ?? '-' }}
                                </td>
                                <td class="px-4 py-3">{{ $row['melebihi_ekspektasi'] ?? '-' }}</td>
                                <td class="px-4 py-3">{{ $row['sesuai_ekspektasi'] ?? '-' }}</td>
                                <td class="px-4 py-3">{{ $row['sedang_berkembang'] ?? '-' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif

    @endif


    @if (isset($generateId) && !empty($generateId))
        <div class="flex flex-col py-4 mb-3">
            <x-output-banner />
            <div class="flex flex-row gap-3">
                <x-export-word generateId="{{ $generateId }}" export="{{ route('export-word') }}" />
                <x-export-excel generateId="{{ $generateId }}" export="{{ route('export-modul-excel') }}" />
            </div>
        </div>
    @endif

    @if (isset($data))
        <script>
            document.getElementById('output').style.display = 'none';
            document.getElementById('imageBox').classList.remove('my-8');
        </script>
    @endif

@endsection
