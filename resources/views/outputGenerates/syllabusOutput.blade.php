@extends('generates.generateSyllabus')

@section('title', 'Templat Syllabus - Brainys')

@section('meta')
    <meta name="robots" content="noindex, nofollow">
@endsection

@section('output')
    @php
        $data = session('data');
        $generateId = session('generateId');
        $userLimit = session('userLimit');
    @endphp

    @isset($data)
        @if (isset($data['informasi_umum']) && !empty($data['informasi_umum']))
            <div class="overflow-x-auto my-3">
                <table class="w-full">
                    <thead class="bg-slate-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-sm font-bold text-gray-800 uppercase" colspan="2">
                                Informasi Umum
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach ($data['informasi_umum'] as $key => $value)
                            <tr class="">
                                <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200 font-semibold bg-slate-50">
                                    {{ str_replace('_', ' ', ucwords($key)) }}
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

        @if (isset($data['silabus_pembelajaran']) && !empty($data['silabus_pembelajaran']))
            <div class="overflow-x-auto my-3">
                <table class="w-full">
                    <thead class="bg-slate-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-sm font-bold text-gray-800 uppercase" colspan="2">
                                Silabus Pembelajaran
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <tr>
                            <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200 font-semibold bg-slate-50">
                                Mata Pelajaran
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200">
                                {{ $data['silabus_pembelajaran']['mata_pelajaran'] }}
                            </td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200 font-semibold bg-slate-50">
                                Tingkat Kelas
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200">
                                {{ $data['silabus_pembelajaran']['tingkat_kelas'] }}
                            </td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200 font-semibold bg-slate-50">
                                Alokasi Waktu
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200">
                                {{ $data['silabus_pembelajaran']['alokasi_waktu'] }}
                            </td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200 font-semibold bg-slate-50">
                                Kompetensi Inti
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200">
                                <ul>
                                    @foreach ($data['silabus_pembelajaran']['kompetensi_inti'] as $ki)
                                        <li>{{ $ki }}</li>
                                    @endforeach
                                </ul>
                            </td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200 font-semibold bg-slate-50">
                                Definisi Kompetensi Inti
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200">
                                {{ $data['silabus_pembelajaran']['definisi_kompetensi_inti'] }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="overflow-x-auto my-3">
                <table class="w-full">
                    <thead class="bg-slate-50">
                        <tr>
                            <th class="px-3 py-4 text-sm text-gray-800 dark:text-gray-200 font-semibold bg-slate-50">
                                Kompetensi Dasar
                            </th>
                            <th class="px-3 py-4 text-sm text-gray-800 dark:text-gray-200 font-semibold bg-slate-50">
                                Materi Pembelajaran
                            </th>
                            <th class="px-3 py-4 text-sm text-gray-800 dark:text-gray-200 font-semibold bg-slate-50">
                                Kegiatan Pembelajaran
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach ($data['silabus_pembelajaran']['inti_silabus'] as $silabus)
                            <tr>
                                <td class="px-3 py-4 text-sm text-gray-800 dark:text-gray-200">
                                    <ul>
                                        @foreach ($silabus['kompetensi_dasar'] as $index => $kd)
                                            <li>{{ $index + 1 }}. {{ $kd }}</li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td class="px-3 py-4 text-sm text-gray-800 dark:text-gray-200">
                                    <ul>
                                        @foreach ($silabus['materi_pembelajaran'] as $index => $materi)
                                            <li>{{ $index + 1 }}. {{ $materi }}</li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td class="px-3 py-4 text-sm text-gray-800 dark:text-gray-200">
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
        @endif

        <div class="mb-3 px-6 py-4">
            <x-export-word generateId="{{ $generateId }}" export="{{ route('export-word-syllabus') }}" />
        </div>

        <script>
            document.getElementById('output').style.display = 'none';
            document.getElementById('imageBox').classList.remove('my-8');
        </script>
    @endisset
@endsection
