@extends('layouts.template')

@section('title', 'Detail History Syllabus - Brainys')

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
            <div class="text-gray-900 text-2xl font-semibold">{{ $data['subject'] }}</div>
            <div class="mt-2 text-gray-500 text-sm leading-snug">Detail hasil generate Syllabus</div>
            <div class="text-slate-400 text-xs mt-2"> Dibuat pada <span
                    class="text-gray-900 font-bold">{{ date('d F Y | H:i', strtotime($data['created_at'])) }}
                </span>
            </div>
        </div>

        <div class="mt-8">
            <div class="text-gray-900 text-lg font-bold bg-gray-100 px-2 py-2">Informasi Umum</div>
            <div class="mt-2">
                <table class="w-full">
                    <tbody>
                        @foreach ($data['generate_output']['informasi_umum'] as $key => $value)
                            <tr>
                                <td class="py-1 text-sm w-[250px]">{{ ucwords(str_replace('_', ' ', $key)) }}</td>
                                <td class="py-1 text-sm">: {{ $value }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="text-gray-900 text-lg font-bold bg-gray-100 px-2 py-2 mt-5">Syllabus Pembelajaran</div>
            <div class="mt-2">
                <table class="w-full">
                    <tbody>
                        <tr>
                            <td class="py-1 text-sm w-[250px]">Mata Pelajaran</td>
                            <td class="py-1 text-sm">:
                                {{ $data['generate_output']['silabus_pembelajaran']['mata_pelajaran'] }}</td>
                        </tr>
                        <tr>
                            <td class="py-1 text-sm w-[250px]">Tingkat Kelas</td>
                            <td class="py-1 text-sm">:
                                {{ $data['generate_output']['silabus_pembelajaran']['tingkat_kelas'] }}</td>
                        </tr>
                        <tr>
                            <td class="py-1 text-sm w-[250px]">Alokasi Waktu</td>
                            <td class="py-1 text-sm">:
                                {{ $data['generate_output']['silabus_pembelajaran']['alokasi_waktu'] }}</td>
                        </tr>
                        <tr>
                            <td class="py-1 text-sm w-[250px]">Kompetensi Inti</td>
                            <td class="py-1 text-sm">
                                <ul>
                                    @foreach ($data['generate_output']['silabus_pembelajaran']['kompetensi_inti'] as $ki)
                                        <li>: {{ $ki }}</li>
                                    @endforeach
                                </ul>
                            </td>
                        </tr>
                        <tr>
                            <td class="py-1 text-sm w-[250px]">Definisi Kompetensi Inti</td>
                            <td class="py-1 text-sm">:
                                {{ $data['generate_output']['silabus_pembelajaran']['definisi_kompetensi_inti'] }}</td>
                        </tr>
                    </tbody>
                </table>

                <table class="w-full mt-5">
                    <tbody class="divide-y divide-slate-50">
                        <tr>
                            <td class="px-1 py-2 text-sm text-gray-800 dark:text-gray-200 font-semibold bg-slate-50">
                                Kompetensi Dasar</td>
                            <td class="px-1 py-2 text-sm text-gray-800 dark:text-gray-200 font-semibold bg-slate-50">
                                Materi Pembelajaran</td>
                            <td class="px-1 py-2 text-sm text-gray-800 dark:text-gray-200 font-semibold bg-slate-50">
                                Kegiatan Pembelajaran</td>
                        </tr>
                        @foreach ($data['generate_output']['silabus_pembelajaran']['inti_silabus'] as $silabus)
                            <tr>
                                <td class="px-1 py-4 text-sm text-gray-800 dark:text-gray-200">
                                    <ul>
                                        @foreach ($silabus['kompetensi_dasar'] as $index => $kd)
                                            <li>{{ $index + 1 }}. {{ $kd }}</li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td class="px-1 py-4 text-sm text-gray-800 dark:text-gray-200">
                                    <ul>
                                        @foreach ($silabus['materi_pembelajaran'] as $index => $materi)
                                            <li>{{ $index + 1 }}. {{ $materi }}</li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td class="px-1 py-4 text-sm text-gray-800 dark:text-gray-200">
                                    <ul>
                                        @foreach ($silabus['kegiatan_pembelajaran'] as $index => $kegiatan)
                                            <li>{{ $index + 1 }}. {{ $kegiatan }}</li>
                                        @endforeach
                                    </ul>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="py-4">
                <form action="{{ route('export-word-syllabus') }}" method="post">
                    @csrf
                    <input type="hidden" name="generate_id" value="{{ $data['id'] }}">
                    <button type="submit" class="flex items-center bg-green-600 px-4 py-3 rounded-lg text-white">
                        <svg class="w-5 h-5 mb-[9px] " aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M14.707 7.793a1 1 0 0 0-1.414 0L11 10.086V1.5a1 1 0 0 0-2 0v8.586L6.707 7.793a1 1 0 1 0-1.414 1.414l4 4a1 1 0 0 0 1.416 0l4-4a1 1 0 0 0-.002-1.414Z" />
                            <path
                                d="M18 12h-2.55l-2.975 2.975a3.5 3.5 0 0 1-4.95 0L4.55 12H2a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-4a2 2 0 0 0-2-2Zm-3 5a1 1 0 1 1 0-2 1 1 0 0 1 0 2Z" />
                        </svg>
                        <span class="ml-3 font-bold font-['Inter']">Download File</span>

                    </button>
                </form>
            </div>



            {{-- <t class="divide-y divide-gray-200">
                <tr>
                    <td class="py-1 text-sm">
                        Mata Pelajaran</td>
                    <td class="py-1 text-sm">

                    </td>
                </tr> --}}
            {{-- <tr class="">
                        <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200 font-semibold bg-slate-50">
                            Tingkat Kelas</td>
                        <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200">
                            {{ $data['silabus_pembelajaran']['tingkat_kelas'] }}
                        </td>
                    </tr>
                    <tr class="">
                        <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200 font-semibold bg-slate-50">
                            Alokasi Waktu</td>
                        <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200">
                            {{ $data['silabus_pembelajaran']['alokasi_waktu'] }}
                        </td>
                    </tr>
                    <tr class="">
                        <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200 font-semibold bg-slate-50">
                            Kompetensi Inti</td>
                        <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200">
                            <ul>
                                @foreach ($data['silabus_pembelajaran']['kompetensi_inti'] as $ki)
                                    <li>{{ $ki }}</li>
                                @endforeach
                            </ul>
                        </td>
                    </tr>
                    <tr class="">
                        <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200 font-semibold bg-slate-50">
                            Definisi Kompetensi Inti</td>
                        <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200">
                            {{ $data['silabus_pembelajaran']['definisi_kompetensi_inti'] }}
                        </td>
                    </tr> --}}


            {{-- <div class="text-gray-900 text-lg font-bold mt-5 bg-gray-100 px-2 py-2">Kegiatan Pembelajaran</div>
            @foreach ($materialHistory['output_data']['kompetensi_dasar'] as $kompetensi)
                <ol class="border-t border-gray-200">
                    <li class="px-6 pt-3 text-left text-sm font-bold text-gray-800 uppercase">
                        {{ $loop->iteration }}.
                        {{ $kompetensi['nama_kompetensi_dasar'] }}
                    </li>
                </ol>


                @foreach ($kompetensi['materi_pembelajaran'] as $materi_pembelajaran)
                    <div class="px-6 py-3">
                        <div class="text-sm text-gray-800">
                            <span class="font-bold">Materi :</span> {{ $materi_pembelajaran['materi'] }}
                        </div>
                        <ul class="pl-10 list-disc mt-3">
                            <li class="text-sm text-gray-800 mb-2">
                                <span class="font-bold">Indikator :</span> {{ $materi_pembelajaran['indikator'] }}
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
                            <li class="text-sm text-gray-800 mb-2">
                                <span class="font-bold">Penilaian :</span>
                                <ul class="pl-5 list-circle">
                                    @foreach ($materi_pembelajaran['penilaian'] as $index => $penilaian)
                                        <li>
                                            {{ chr(97 + $index) }}. {{ $penilaian['jenis'] }}
                                            ({{ $penilaian['bobot'] }}%)
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        </ul>
                    </div>
                @endforeach --}}

        </div>

    </div>
    </div>

@endsection
