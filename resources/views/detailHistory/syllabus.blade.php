@extends('layouts.template')

@section('title', 'Detail History Syllabus - Brainys')

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
                                <td class="py-1 text-sm w-[200px]">{{ ucwords(str_replace('_', ' ', $key)) }}</td>
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
                            <td class="py-1 text-sm w-[200px]">Mata Pelajaran</td>
                            <td class="py-1 text-sm">:
                                {{ $data['generate_output']['silabus_pembelajaran']['mata_pelajaran'] }}</td>
                        </tr>
                        <tr>
                            <td class="py-1 text-sm w-[200px]">Tingkat Kelas</td>
                            <td class="py-1 text-sm">:
                                {{ $data['generate_output']['silabus_pembelajaran']['tingkat_kelas'] }}</td>
                        </tr>
                        <tr>
                            <td class="py-1 text-sm w-[200px]">Alokasi Waktu</td>
                            <td class="py-1 text-sm">:
                                {{ $data['generate_output']['silabus_pembelajaran']['alokasi_waktu'] }}</td>
                        </tr>
                        <tr>
                            <td class="py-1 text-sm w-[200px]">Kompetensi Inti</td>
                            <td class="py-1 text-sm">
                                <ul>
                                    @foreach ($data['generate_output']['silabus_pembelajaran']['kompetensi_inti'] as $ki)
                                        <li>: {{ $ki }}</li>
                                    @endforeach
                                </ul>
                            </td>
                        </tr>
                        <tr>
                            <td class="py-1 text-sm w-[200px]">Definisi Kompetensi Inti</td>
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
                <x-export-word generateId="{{ $data['id'] }}" export="{{ route('export-word-syllabus') }}" />
            </div>

        </div>

    </div>
    </div>

@endsection
