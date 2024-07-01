@extends('generates.generateBahanAjar')

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
                            <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200 font-semibold  bg-slate-50">
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
                            Pendahuluan</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($data['pendahuluan'] as $key => $value)
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
                            Materi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($data['konten'] as $content)
                        <tr>
                            <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200 font-semibold bg-slate-50">
                                {{ $content['nama_konten'] }}</td>
                            <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200">
                                {{ $content['isi_konten'] }}</td>
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
                            Studi Kasus</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($data['studi_kasus'] as $case)
                        <tr>
                            <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200 font-semibold bg-slate-50">
                                {{ $case['nama_studi_kasus'] }}</td>
                            <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200">
                                {{ $case['isi_studi_kasus'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="overflow-x-auto mt-5">
            <table class="w-full">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-bold text-gray-800 uppercase" colspan="2">
                            Quiz & Evaluasi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <tr>
                        <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200 font-semibold bg-slate-50">
                            Soal Quiz</td>
                        <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200">
                            {{ $data['quiz']['soal_quiz'] }}</td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200 font-semibold bg-slate-50">
                            Evaluasi</td>
                        <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200">
                            {{ $data['evaluasi']['isi_evaluasi'] }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="overflow-x-auto mt-5">
            <table class="w-full">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-bold text-gray-800 uppercase" colspan="2">
                            Referensi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($data['lampiran']['sumber_referensi'] as $referensi)
                        <tr>
                            <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200 before:content-['•'] before:mr-2">
                                {{ $referensi }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mb-3 px-6 py-4">
            <form action="{{ route('export-bahan-ajar') }}" method="post">
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
