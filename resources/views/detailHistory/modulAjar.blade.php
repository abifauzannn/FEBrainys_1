@extends('layouts.template')

@section('title', 'Detail History Modul Ajar - Brainys')

@section('meta')
    <meta name="robots" content="noindex, nofollow">
@endsection

@section('content')
    <x-nav></x-nav>

    <div class="container mx-auto px-4 sm:px-10 py-9 font-['Inter']">

        <button onclick="window.location='{{ route('history') }}'" class="mb-6">
            <div class="flex items-center">
                <img src="{{ URL('images/back.svg') }}" alt="" class="w-6 h-6">
                <div class="text-black text-base font-semibold ml-2">Kembali</div>
            </div>
        </button>

        <div class="w-full">
            <div class="text-gray-900 text-2xl font-semibold">{{ $materialHistory['name'] }}</div>
            <div class="mt-2 text-gray-500 text-sm leading-snug">Detail hasil generate Modul Ajar</div>
            <div class="text-slate-400 text-xs mt-2"> Dibuat pada <span
                    class="text-gray-900 font-bold">{{ date('d F Y | H:i', strtotime($materialHistory['created_at'])) }}
                </span>
            </div>
        </div>

        <div class="mt-8">
            <div class="text-gray-900 text-lg font-bold bg-gray-100 px-2 py-2">Informasi Umum</div>
            <div class="mt-2">
                <table class="w-full">
                    <tbody>
                        @foreach ($materialHistory['output_data']['informasi_umum'] as $key => $value)
                            <tr>
                                <td class="py-1 text-sm w-[200px]">{{ ucwords(str_replace('_', ' ', $key)) }}</td>
                                <td class="py-1 text-sm">: {{ $value }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="text-gray-900 text-lg font-bold bg-gray-100 px-2 py-2 mt-5">Sarana dan Prasarana</div>
            <div class="mt-2">
                <table class="w-full">
                    <tbody>
                        @foreach ($materialHistory['output_data']['sarana_dan_prasarana'] as $key => $value)
                            <tr>
                                <td class="py-1 text-sm w-[200px]">
                                    {{ str_replace(' ', ' ', ucwords(str_replace('_', ' ', $key))) }}
                                </td>
                                <td class="py-1 text-sm">: {{ $value }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="text-gray-900 text-lg font-bold bg-gray-100 px-2 py-2 mt-5">Komponen Pembelajaran</div>
            <div class="mt-2">
                <table class="w-full">
                    <tbody>
                        @foreach ($materialHistory['output_data']['komponen_pembelajaran'] as $key => $value)
                            <tr>
                                <td class="py-1 text-sm w-[200px]">
                                    {{ str_replace(' ', ' ', ucwords(str_replace('_', ' ', $key))) }}
                                </td>
                                <td class="py-1 text-sm">
                                    <ul>
                                        @foreach ($value as $item)
                                            <li>{{ $loop->iteration }}. {{ $item }}</li>
                                        @endforeach
                                    </ul>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="text-gray-900 text-lg font-bold bg-gray-100 px-2 py-2 mt-5">Tujuan Kegiatan Pembelajaran</div>
            <div class="mt-2">
                <table class="w-full">
                    <tbody>
                        @foreach ($materialHistory['output_data']['tujuan_kegiatan_pembelajaran'] as $key => $value)
                            <tr>
                                <td class="py-1 text-sm w-[200px]">
                                    {{ str_replace('_', ' ', ucwords(str_replace('_', ' ', $key))) }}
                                </td>
                                <td class="py-1 text-sm">
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

            <div class="text-gray-900 text-lg font-bold bg-gray-100 px-2 py-2 mt-5">Pemahaman Bermakna</div>
            <div class="mt-2">
                <table class="w-full">
                    <tbody>
                        @foreach ($materialHistory['output_data']['pemahaman_bermakna'] as $key => $value)
                            <tr>
                                <td class="py-1 text-sm w-[200px]">
                                    {{ str_replace(' ', ' ', ucwords(str_replace('_', ' ', $key))) }}
                                </td>
                                <td class="py-1 text-sm">
                                    : {{ $value }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="text-gray-900 text-lg font-bold bg-gray-100 px-2 py-2 mt-5">Pertanyaan Pemantik</div>
            <div class="mt-2">
                <table class="w-full">
                    <tbody class="divide-y divide-gray-200">
                        @foreach ($materialHistory['output_data']['pertanyaan_pemantik'] as $index => $pertanyaan)
                            <tr>
                                <td class="py-2 text-sm">{{ $index + 1 }}.
                                    {{ $pertanyaan }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Tabel Kegiatan Pembelajaran -->
        <div class="text-gray-900 text-lg font-bold mt-5 bg-gray-100 px-2 py-2">Kegiatan Pembelajaran</div>
        @foreach ($materialHistory['output_data']['kompetensi_dasar'] as $kompetensi)
            <div>
                <ol class="border-t border-gray-200">
                    <li class="px-6 pt-3 text-left text-sm font-bold text-gray-800 uppercase">
                        {{ $loop->iteration }}.
                        {{ $kompetensi['nama_kompetensi_dasar'] }}
                    </li>
                </ol>

                <div class="">
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

                                        <span class="font-bold">
                                            Nilai Karakter :
                                        </span>
                                        {{ $materi_pembelajaran['nilai_karakter'] }}
                                    </li>
                                    <li class="text-sm text-gray-800 mb-2">

                                        <span class="font-bold">
                                            Kegiatan Pembelajaran :
                                        </span>

                                        {{ $materi_pembelajaran['kegiatan_pembelajaran'] }}
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

        <!-- Button untuk download file -->
        <div class=" mb-7 px-4 sm:px-10 container mx-auto">
            <x-export-word generateId="{{ $materialHistory['id'] }}" export="{{ route('export-word') }}" />
        </div>
    </div>
    </div>

@endsection
