@extends('generates.generateModulAjar')

@section('title', 'Templat Modul Ajar - Brainys')

@section('meta')
    <meta name="robots" content="noindex, nofollow">
@endsection

@section('output')

    @php
        $data = session('data');
        $generateId = session('generateId');
        $userLimit = session('userLimit');
    @endphp
    <!-- Display the session data in tables -->
    @if (isset($data['informasi_umum']) && !empty($data['informasi_umum']))
        <div class="overflow-x-auto mt-5">
            <table class="w-full bg-white ">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-bold text-gray-800 uppercase" colspan="2">
                            Informasi Umum
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @php
                        $informasiUmum = [
                            'nama_modul_ajar' => 'Nama Modul Ajar',
                            'penyusun' => 'Nama Penyusun',
                            'jenjang_sekolah' => 'Satuan Pendidikan',
                            'fase_kelas' => 'Fase/Kelas',
                            'mata_pelajaran' => 'Mata Pelajaran',
                            'alokasi_waktu' => 'Alokasi Waktu',
                            'kompetensi_awal' => 'Kompetensi Awal',
                            'profil_pelajar_pancasila' => 'Profil Pelajar Pancasila',
                            'target_peserta_didik' => 'Target Peserta Didik',
                            'model_pembelajaran' => 'Model Pembelajaran',
                            'element' => 'Elemen',
                            'capaian_pembelajaran' => 'Capaian Pembelajaran',
                        ];
                    @endphp

                    @foreach ($informasiUmum as $key => $label)
                        <tr>
                            <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200 font-semibold bg-slate-50">
                                {{ $label }}
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200">
                                {{ is_array($data['informasi_umum'][$key]) ? json_encode($data['informasi_umum'][$key]) : htmlspecialchars($data['informasi_umum'][$key]) }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

    @if (isset($data['sarana_dan_prasarana']) && !empty($data['sarana_dan_prasarana']))
        <div class="overflow-x-auto mt-5">
            <table class="w-full bg-white ">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-bold text-gray-800 uppercase" colspan="2">
                            Sarana dan Prasarana
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($data['sarana_dan_prasarana'] as $key => $value)
                        <tr>
                            <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200 font-semibold bg-slate-50">
                                {{ str_replace(' ', ' ', ucwords(str_replace('_', ' ', $key))) }}
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200">
                                {{ $value }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

    @if (isset($data['tujuan_kegiatan_pembelajaran']) && !empty($data['tujuan_kegiatan_pembelajaran']))
        <div class="overflow-x-auto mt-5">
            <table class="w-full bg-white ">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-bold text-gray-800 uppercase" colspan="2">
                            Tujuan Kegiatan Pembelajaran
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($data['tujuan_kegiatan_pembelajaran'] as $key => $value)
                        <tr>
                            <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200 font-semibold bg-slate-50">
                                {{ str_replace('_', ' ', ucwords(str_replace('_', ' ', $key))) }}
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200">
                                @if (is_array($value))
                                    <ol>
                                        @foreach ($value as $item)
                                            <li>{{ $loop->iteration }}. {{ $item }}</li>
                                        @endforeach
                                    </ol>
                                @else
                                    {{ $value }}
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

    @if (isset($data['pemahaman_bermakna']) && !empty($data['pemahaman_bermakna']))
        <div class="overflow-x-auto mt-5">
            <table class="w-full bg-white ">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-bold text-gray-800 uppercase" colspan="2">
                            Pemahaman Bermakna
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($data['pemahaman_bermakna'] as $key => $value)
                        <tr>
                            <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200 font-semibold bg-slate-50">
                                {{ str_replace(' ', ' ', ucwords(str_replace('_', ' ', $key))) }}
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200">
                                {{ $value }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

    @if (isset($data['pertanyaan_pemantik']) && !empty($data['pertanyaan_pemantik']))
        <div class="overflow-x-auto mt-5">
            <table class="w-full bg-white ">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-bold text-gray-800 uppercase" colspan="2">
                            Pertanyaan Pemantik
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($data['pertanyaan_pemantik'] as $index => $pertanyaan)
                        <tr>
                            <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200">
                                {{ $index + 1 }}. {{ $pertanyaan }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

    @if (isset($data['kompetensi_dasar']) && !empty($data['kompetensi_dasar']))
        <div class="overflow-x-auto mt-5">
            @foreach ($data['kompetensi_dasar'] as $kompetensi)
                <div class="mt-5">
                    <div class="bg-slate-50 px-6 py-3 text-left text-sm font-bold text-gray-800 uppercase">
                        Kegiatan Pembelajaran
                    </div>
                    <ol class="list-decimal pl-6">
                        <div class="pt-3 text-sm font-bold text-gray-800 uppercase">
                            {{ $loop->iteration }}. {{ $kompetensi['nama_kompetensi_dasar'] }}
                        </div>
                    </ol>

                    <div class="divide-y divide-gray-200">
                        @foreach ($kompetensi['materi_pembelajaran'] as $materi_pembelajaran)
                            <div class="px-6 py-3">
                                <li class="text-sm text-gray-800">
                                    <span class="font-bold">Materi :</span> {{ $materi_pembelajaran['materi'] }}
                                    <ul class="pl-10 mt-3">
                                        <li class="text-sm text-gray-800 mb-2">
                                            <span class="font-bold">Tujuan Pemebelajaran Materi :</span>
                                            {{ $materi_pembelajaran['tujuan_pembelajaran_materi'] }}
                                        </li>
                                        <li class="text-sm text-gray-800 mb-2">
                                            <span class="font-bold">Indikator :</span>
                                            {{ $materi_pembelajaran['indikator'] }}
                                        </li>
                                        <li class="text-sm text-gray-800 mb-2">
                                            <span class="font-bold">Nilai Karakter :</span>
                                            {{ $materi_pembelajaran['nilai_karakter'] }}
                                        </li>
                                        <li class="text-sm text-gray-800 mb-2">
                                            <span class="font-bold">Kegiatan Pembelajaran :</span>
                                            {{ $materi_pembelajaran['kegiatan_pembelajaran'] }}
                                        </li>
                                        <li class="text-sm text-gray-800 mb-2">
                                            <span class="font-bold">Alokasi Waktu :</span>
                                            {{ $materi_pembelajaran['alokasi_waktu'] }}
                                        </li>
                                        @if (isset($materi_pembelajaran['penilaian']) && !empty($materi_pembelajaran['penilaian']))
                                            <li class="text-sm text-gray-800 mb-2">
                                                <span class="font-bold">Penilaian:</span>
                                                <ul class="pl-5">
                                                    @foreach ($materi_pembelajaran['penilaian'] as $penilaian)
                                                        <li>{{ $penilaian['jenis'] }}: {{ $penilaian['bobot'] }}%</li>
                                                    @endforeach
                                                </ul>
                                            </li>
                                        @endif
                                    </ul>
                                </li>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    @if (isset($data['lampiran']) && !empty($data['lampiran']))
        <div class="mt-5">
            <div class="pt-3 text-sm font-bold text-gray-800 uppercase mb-2">Glosarium</div>
            <ol class="list-decimal pl-6">
                @foreach ($data['lampiran']['glosarium_materi'] as $index => $glosarium)
                    <li class="text-sm text-gray-800 mb-2">{{ $glosarium }}</li>
                @endforeach
            </ol>
        </div>
        <div class="mt-5">
            <div class="pt-3 text-sm font-bold text-gray-800 uppercase mb-2">Daftar Pustaka</div>
            <ol class="list-decimal pl-6">
                @foreach ($data['lampiran']['daftar_pustaka'] as $index => $pustaka)
                    <li class="text-sm text-gray-800 mb-2">{{ $pustaka }}</li>
                @endforeach
            </ol>
        </div>
    @endif

    @if (isset($generateId) && !empty($generateId))
        <div class="mb-3 px-6 py-4 flex flex-col">
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
