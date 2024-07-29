@extends('generates.generateModulAjar')

@section('title', 'Templat Modul Ajar - Brainys')

@section('meta')
    <meta name="robots" content="noindex, nofollow">
@endsection

@section('output')
    @isset($data)
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class=" bg-slate-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-bold text-gray-800 uppercase" colspan="2">
                            Informasi Umum</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($data['informasi_umum'] as $key => $value)
                        <tr class="">
                            <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200 font-semibold bg-slate-50">
                                {{ str_replace(' ', ' ', ucwords(str_replace('_', ' ', $key))) }}</td>
                            <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200">
                                {{ is_array($value) ? json_encode($value) : htmlspecialchars($value) }}</td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>


        <div class="overflow-x-auto">
            <table class="w-full mt-5">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-bold text-gray-800 uppercase" colspan="2">
                            Sarana dan Prasarana</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($data['sarana_dan_prasarana'] as $key => $value)
                        <tr>
                            <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200 font-semibold bg-slate-50">
                                {{ str_replace(' ', ' ', ucwords(str_replace('_', ' ', $key))) }}</td>
                            <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200">
                                {{ $value }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>


        <div class="overflow-x-auto">
            <table class="w-full mt-5">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-bold text-gray-800 uppercase" colspan="2">
                            Tujuan Kegiatan Pembelajaran</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($data['tujuan_kegiatan_pembelajaran'] as $key => $value)
                        <tr>
                            <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200 font-semibold bg-slate-50">
                                {{ str_replace('_', ' ', ucwords(str_replace('_', ' ', $key))) }}</td>
                            <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200">
                                @if (is_array($value))
                                    <ul>
                                        @foreach ($value as $item)
                                            <li>{{ $loop->iteration }}. {{ $item }}</li>
                                        @endforeach
                                    </ul>
                                @else
                                    {{ $value }}
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full mt-5">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-bold text-gray-800 uppercase" colspan="2">
                            Pemahaman Bermakna</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($data['pemahaman_bermakna'] as $key => $value)
                        <tr>
                            <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200 font-semibold bg-slate-50">
                                {{ str_replace(' ', ' ', ucwords(str_replace('_', ' ', $key))) }}</td>
                            <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200">
                                {{ $value }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full mt-5">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-bold text-gray-800 uppercase" colspan="2">
                            Pertanyaan Pemantik</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($data['pertanyaan_pemantik'] as $index => $pertanyaan)
                        <tr>


                            <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200">
                                {{ $index + 1 }}. {{ $pertanyaan }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="overflow-x-auto">
            @foreach ($data['kompetensi_dasar'] as $kompetensi)
                <div class="mt-5">
                    <div class="bg-slate-50 px-6 py-3 text-left text-sm font-bold text-gray-800 uppercase">
                        Kegiatan Pembelajaran
                    </div>
                    <ol>
                        <li class="px-6 pt-3 text-left text-sm font-bold text-gray-800 uppercase">
                            {{ $loop->iteration }}.
                            {{ $kompetensi['nama_kompetensi_dasar'] }}
                        </li>
                    </ol>

                    <div class="divide-y divide-gray-200">
                        @foreach ($kompetensi['materi_pembelajaran'] as $materi_pembelajaran)
                            <div class="px-6 py-3">

                                <li class="text-sm text-gray-800">

                                    <span class="font-bold">
                                        Materi :
                                    </span>
                                    {{ $materi_pembelajaran['materi'] }}
                                    <ul class="pl-10 list-disc mt-3">
                                        <li class="text-sm text-gray-800 mb-2">
                                            <span class="font-bold">
                                                Indikator :
                                            </span>
                                            {{ $materi_pembelajaran['indikator'] }}
                                        </li>
                                        <li class="text-sm text-gray-800 mb-2">
                                            <span class="font-bold">Alokasi Waktu : </span>
                                            {{ $materi_pembelajaran['alokasi_waktu'] }}
                                        </li>
                                        <li class="text-sm text-gray-800 mb-2">
                                            <span class="font-bold">
                                                Penilaian :
                                            </span>

                                            <ul class="pl-5 list-circle">
                                                @foreach ($materi_pembelajaran['penilaian'] as $index => $penilaian)
                                                    <li>
                                                        {{ chr(97 + $index) }}. {{ $penilaian['jenis'] }}
                                                        ({{ $penilaian['bobot'] }}%)
                                                        <!-- Nested list items here -->
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>


        <div class="mb-3 px-6 py-4 flex flex-row gap-3">
            <x-export-word generateId="{{ $generateId }}" export="{{ route('export-word') }}" />
            <x-export-excel generateId="{{ $generateId }}" export="{{ route('export-modul-excel') }}" />
        </div>

    @endisset
@endsection
