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
                            Komponen Pembelajaran</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($data['komponen_pembelajaran'] as $key => $value)
                        <tr>
                            <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200 font-semibold bg-slate-50">
                                {{ str_replace(' ', ' ', ucwords(str_replace('_', ' ', $key))) }}</td>
                            <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200">
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
        </div>


        <div class="mb-3 px-6 py-4">
            <form action="{{ route('export-word') }}" method="post">
                @csrf
                <input type="hidden" name="generate_id" value="{{ $generateId }}">
                <button type="submit" class="flex items-center bg-green-600 px-4 py-3 rounded-lg text-white">
                    <svg class="w-5 h-5 mb-[9px] " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                        viewBox="0 0 20 20">
                        <path
                            d="M14.707 7.793a1 1 0 0 0-1.414 0L11 10.086V1.5a1 1 0 0 0-2 0v8.586L6.707 7.793a1 1 0 1 0-1.414 1.414l4 4a1 1 0 0 0 1.416 0l4-4a1 1 0 0 0-.002-1.414Z" />
                        <path
                            d="M18 12h-2.55l-2.975 2.975a3.5 3.5 0 0 1-4.95 0L4.55 12H2a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-4a2 2 0 0 0-2-2Zm-3 5a1 1 0 1 1 0-2 1 1 0 0 1 0 2Z" />
                    </svg>
                    <span class="ml-3 font-bold font-['Inter']">Download File</span>

                </button>
            </form>
        </div>

    @endisset
@endsection
