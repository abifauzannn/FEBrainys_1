@extends('layouts.template')

@section('title', 'Generate Syllabus')

@section('content')
    <x-nav></x-nav>

    <div class="container mx-auto px-10 py-9">
        @if (session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 my-4" role="alert">
                <p class="font-bold">Success!</p>
                <p>{{ session('success') }}</p>
            </div>
        @endif

        <a href="/dashboard">
            <div class="w-[90px] h-6 justify-start items-end gap-1 inline-flex mb-6">
                <img src="{{ URL('images/back.svg') }}" alt="" class="w-6 h-6">
                <div class="text-black text-base font-semibold font-['Inter']">Kembali</div>
            </div>
        </a>


        <div class="w-[1170px] h-[60px] flex-col justify-start items-start gap-2 inline-flex">
            <div class="text-gray-900 text-2xl font-semibold font-['Inter'] leading-[30px]">Template Modul Ajar</div>
            <div class="w-[549px] text-gray-500 text-sm font-normal font-['Inter'] leading-snug">Lorem ipsum dolor sit
                amet, consectetur adipiscing elit. Cras ultrices lectus sem.</div>
        </div>
    </div>

    <div class="flex container mx-auto px-10">
        <div class="w-[500px] flex-col justify-start items-start gap-6 inline-flex">
            <form action="{{ route('syllabusPost') }}" method="post">
                <!-- Input untuk Nama Silabus -->
                @csrf

                <div class="mb-4">
                    <label for="name" class="text-gray-900 text-base font-medium font-['Inter'] leading-normal">Nama
                        Syllabus</label>
                    <input type="text" name="name" id="name"
                        class="w-full p-2 border rounded-md mt-[10px] text-gray-400 text-base font-normal font-['Inter'] leading-normal mr-5"
                        placeholder="Nama Silabus" required>
                </div>

                <div class="mb-4">
                    <label for="subject" class="text-gray-900 text-base font-medium font-['Inter'] leading-normal">Mata
                        Pelajaran</label>
                    <input type="text" name="subject" id="subject"
                        class="w-full p-2 border rounded-md mt-[10px] text-gray-400 text-base font-normal font-['Inter'] leading-normal mr-5"
                        placeholder="Nama Mata Pelajaran" required>
                </div>

                <!-- Input untuk Mata Pelajaran -->
                <div class="mb-4">
                    <label for="grade"
                        class="text-gray-900 text-base font-medium font-['Inter'] leading-normal">Kelas</label>
                    <input type="text" id="grade" name="grade"
                        class="w-full p-2 border rounded-md mt-[10px] text-gray-400 text-base font-normal font-['Inter'] leading-normal mr-5"
                        placeholder="Kelas" required>
                </div>

                <div class="mb-4">
                    <label for="notes"
                        class="text-gray-900 text-base font-medium font-['Inter'] leading-normal mb-[10px]">Deskripsi
                        Silabus:</label>
                    <textarea id="notes" name="notes"
                        class="w-full p-2 border rounded-md mt-[10px] text-gray-400 text-base font-normal font-['Inter'] leading-normal mr-5"
                        placeholder="Masukkan deskripsi poin silabus" maxlength="50" oninput="updateCharacterCount(this)" required></textarea>
                </div>
                <div class="flex justify-end -mt-2">
                    <div class="self-stretch justify-start items-end gap-5 inline-flex">
                        <div id="characterCount"
                            class="text-left text-gray-500 text-sm font-normal font-inter leading-snug">0/50</div>
                    </div>
                </div>
                <div class="flex justify-between py-6">
                    <button
                        class="h-12 px-6 bg-white rounded-lg justify-center items-center gap-2.5 inline-flex border border-gray-900">
                        <img src="{{ URL('images/x-circle.svg') }}" alt="" class="w-[20px] h-[20px]">
                        <div class="text-center text-base font-medium font-['Inter'] leading-normal">Hapus
                        </div>
                    </button>
                    <button type="submit"
                        class="h-12 px-6 bg-blue-600 rounded-lg justify-center items-center gap-2.5 inline-flex">
                        <img src="{{ URL('images/glass.svg') }}" alt="" class="w-[20px] h-[20px]">
                        <div class="text-center text-white text-base font-medium font-['Inter'] leading-normal">Buat
                            Syllabus
                        </div>
                    </button>
                </div>


            </form>
        </div>

        <div class="flex-col justify-start items-start ml-[72px] inline-flex">
            <div class="w-full h-full flex-col justify-start items-start gap-4 inline-flex">
                <div class="text-gray-900 text-2xl font-semibold font-['Inter'] leading-[30px]">Hasil</div>
                <div class="h-[91px] flex-col justify-start items-start gap-[3px] flex">
                    <div class="w-[788px] text-gray-500 text-sm font-normal font-['Inter'] leading-snug">
                        @isset($data)


                            <div class="overflow-x-auto">
                                <table class="w-full">
                                    <thead class=" bg-slate-50">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-sm font-bold text-gray-800 uppercase"
                                                colspan="2">Informasi Umum</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200">
                                        @foreach ($data['informasi_umum'] as $key => $value)
                                            <tr class="">
                                                <td
                                                    class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200 font-semibold  bg-slate-50">
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
                                            <th class="px-6 py-3 text-left text-sm font-bold text-gray-800 uppercase"
                                                colspan="2">Sarana dan Prasarana</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200">
                                        @foreach ($data['sarana_dan_prasarana'] as $key => $value)
                                            <tr>
                                                <td
                                                    class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200 font-semibold bg-slate-50">
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
                                            <th class="px-6 py-3 text-left text-sm font-bold text-gray-800 uppercase"
                                                colspan="2">Komponen Pembelajaran</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200">
                                        @foreach ($data['komponen_pembelajaran'] as $key => $value)
                                            <tr>
                                                <td
                                                    class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200 font-semibold bg-slate-50">
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
                                            <th class="px-6 py-3 text-left text-sm font-bold text-gray-800 uppercase"
                                                colspan="2">Tujuan Kegiatan Pembelajaran</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200">
                                        @foreach ($data['tujuan_kegiatan_pembelajaran'] as $key => $value)
                                            <tr>
                                                <td
                                                    class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200 font-semibold bg-slate-50">
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
                                            <th class="px-6 py-3 text-left text-sm font-bold text-gray-800 uppercase"
                                                colspan="2">Pemahaman Bermakna</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200">
                                        @foreach ($data['sarana_dan_prasarana'] as $key => $value)
                                            <tr>
                                                <td
                                                    class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200 font-semibold bg-slate-50">
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
                                            <th class="px-6 py-3 text-left text-sm font-bold text-gray-800 uppercase"
                                                colspan="2">Pertanyaan Pemantik</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200">
                                        @foreach ($data['pertanyaan_pemantik'] as $index => $pertanyaan)
                                            <tr>
                                                <td
                                                    class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200 font-semibold bg-slate-50">
                                                    Pertanyaan {{ $index + 1 }}</td>
                                                <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200">
                                                    {{ $pertanyaan }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <div class="overflow-x-auto">
                                <table class="w-full mt-5">
                                    <thead class="bg-slate-50">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-sm font-bold text-gray-800 uppercase">
                                                Kompetensi Dasar</th>
                                            <th class="px-6 py-3 text-left text-sm font-bold text-gray-800 uppercase">Materi
                                                Pembelajaran</th>
                                            <th class="px-6 py-3 text-left text-sm font-bold text-gray-800 uppercase">Indikator
                                            </th>
                                            <th class="px-6 py-3 text-left text-sm font-bold text-gray-800 uppercase">Nilai
                                                Karakter</th>
                                            <th class="px-6 py-3 text-left text-sm font-bold text-gray-800 uppercase">Kegiatan
                                                Pembelajaran</th>
                                            <th class="px-6 py-3 text-left text-sm font-bold text-gray-800 uppercase">Alokasi
                                                Waktu</th>
                                            <th class="px-6 py-3 text-left text-sm font-bold text-gray-800 uppercase">Penilaian
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200">
                                        @foreach ($data['kompetensi_dasar'] as $kompetensi_dasar)
                                            @foreach ($kompetensi_dasar['materi_pembelajaran'] as $materi_pembelajaran)
                                                <tr>
                                                    <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200">
                                                        {{ $kompetensi_dasar['nama_kompetensi_dasar'] }}</td>
                                                    <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200">
                                                        {{ $materi_pembelajaran['materi'] }}</td>
                                                    <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200">
                                                        {{ $materi_pembelajaran['indikator'] }}</td>
                                                    <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200">
                                                        {{ $materi_pembelajaran['nilai_karakter'] }}</td>
                                                    <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200">
                                                        {{ $materi_pembelajaran['kegiatan_pembelajaran'] }}</td>
                                                    <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200">
                                                        {{ $materi_pembelajaran['alokasi_waktu'] }}</td>
                                                    <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200">
                                                        <ul>
                                                            @foreach ($materi_pembelajaran['penilaian'] as $penilaian)
                                                                <li>{{ $penilaian['jenis'] }} ({{ $penilaian['bobot'] }}%)
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="fixed bottom-0 right-0 mb-8 mr-3">
                                <form action="{{ route('export-word') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="generate_id" value="{{ $generateId }}">
                                    <button type="submit"
                                        class="flex items-center bg-green-600 px-6 py-3 rounded-lg text-white">
                                        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                            fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M14.707 7.793a1 1 0 0 0-1.414 0L11 10.086V1.5a1 1 0 0 0-2 0v8.586L6.707 7.793a1 1 0 1 0-1.414 1.414l4 4a1 1 0 0 0 1.416 0l4-4a1 1 0 0 0-.002-1.414Z" />
                                            <path
                                                d="M18 12h-2.55l-2.975 2.975a3.5 3.5 0 0 1-4.95 0L4.55 12H2a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-4a2 2 0 0 0-2-2Zm-3 5a1 1 0 1 1 0-2 1 1 0 0 1 0 2Z" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        @endisset

                    </div>
                </div>
            </div>



        </div>
    </div>

    <script>
        function updateCharacterCount(textarea) {
            var characterCountElement = document.getElementById('characterCount');
            var currentCount = textarea.value.length;
            characterCountElement.textContent = currentCount + '/50';
        }
    </script>




@endsection
