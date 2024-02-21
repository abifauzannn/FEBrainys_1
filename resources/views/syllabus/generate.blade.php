@extends('layouts.template')

@section('title', 'Templat Modul Ajar - Brainys')

@section('content')
    <x-nav></x-nav>

    <div class="container mx-auto px-4 py-6 sm:px-10 sm:py-9">
        @if (session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 my-4" role="alert">
                <p class="font-bold">Success!</p>
                <p>{{ session('success') }}</p>
            </div>
        @endif

        <a href="/dashboard" class="block mb-6">
            <div class="flex items-center">
                <img src="{{ URL('images/back.svg') }}" alt="" class="w-6 h-6">
                <div class="text-black text-base font-semibold ml-2">Kembali</div>
            </div>
        </a>

        <div class="w-full">
            <div class="text-gray-900 text-2xl font-semibold font-['Inter']">Template Modul Ajar</div>
            <div class="mt-2 text-gray-500 text-sm leading-snug">Gunakan templat modul ajar kurikulum merdeka</div>
        </div>
    </div>


    <div class="flex container mx-auto px-3 sm:px-10 flex-col lg:flex-row">
        <div class="w-full lg:w-[500px] flex-col justify-start items-start sm:gap-6 inline-flex">
            <form action="{{ route('syllabusPost') }}" method="post" class="w-full">
                <!-- Input untuk Nama Silabus -->
                @csrf

                <div class="mb-4">
                    <label for="name" class="text-gray-900 text-base font-['Inter'] leading-normal font-semibold">Nama
                        Modul Ajar</label>
                    <input type="text" name="name" id="name" data-tooltip-target="tooltip-light"
                        data-tooltip-trigger="click" data-tooltip-placement="right"
                        class="w-full p-2 border rounded-md mt-[10px] placeholder:text-gray-400 text-base font-normal font-['Inter'] leading-normal"
                        placeholder="masukan nama modul ajar" required>
                    <div id="tooltip-light" role="tooltip"
                        class="mb-7 absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 tooltip">
                        Contoh : Modul Ajar Bahasa Indonesia
                        <div class="tooltip-arrow" data-popper-arrow></div>
                    </div>
                </div>

                <div class="mb-4">
                    <label for="subject" class="text-gray-900 text-base font-['Inter'] leading-normal font-semibold">Mata
                        Pelajaran</label>
                    <input type="text" name="subject" id="subject" data-tooltip-target="tooltip-subject"
                        data-tooltip-trigger="click" data-tooltip-placement="right"
                        class="w-full p-2 border rounded-md mt-[10px] placeholder:text-gray-400 text-base font-normal font-['Inter'] leading-normal"
                        placeholder="masukan nama mata pelajaran" required>
                    <div id="tooltip-subject" role="tooltip"
                        class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 tooltip">
                        Contoh : Bahasa Indonesia
                        <div class="tooltip-arrow" data-popper-arrow></div>
                    </div>
                </div>

                <!-- Input untuk Mata Pelajaran -->
                <div class="mb-4">
                    <label for="grade"
                        class="text-gray-900 text-base font-semibold font-['Inter'] leading-normal">Kelas</label>
                    <input type="number" id="grade" name="grade" data-tooltip-target="tooltip-grade"
                        data-tooltip-trigger="click" data-tooltip-placement="right"
                        class="w-full p-2 border rounded-md mt-[10px] placeholder:text-gray-400 text-base font-normal font-['Inter'] leading-normal"
                        placeholder="masukan tingkat kelas" required>
                    <div id="tooltip-grade" role="tooltip"
                        class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 tooltip">
                        Contoh : 10
                        <div class="tooltip-arrow" data-popper-arrow></div>
                    </div>
                </div>

                <div class="mb-4">
                    <label for="notes"
                        class="text-gray-900 text-base font-semibold font-['Inter'] leading-normal mb-[10px]">Deskripsi
                        Modul Ajar</label>
                    <textarea id="notes" name="notes" data-tooltip-target="tooltip-notes" data-tooltip-placement="right"
                        data-tooltip-trigger="click"
                        class="w-full p-2 border rounded-md mt-[10px] placeholder:text-gray-400 text-base font-normal font-['Inter'] leading-normal"
                        placeholder="Masukkan deskripsi poin Modul Ajar" maxlength="250" oninput="updateCharacterCount(this)" required></textarea>
                    <div id="tooltip-notes" role="tooltip"
                        class="max-w-xs absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 tooltip">
                        Contoh : untuk memperkenalkan siswa kelas X pada keberagaman kebudayaan dan karya sastra Indonesia.
                        Modul ini bertujuan untuk membantu siswa memahami nilai-nilai budaya, tradisi, dan kekayaan sastra
                        Indonesia yang merupakan bagian integral dari identitas bangsa.
                        <div class="tooltip-arrow" data-popper-arrow></div>
                    </div>
                </div>
                <div class="flex justify-end -mt-2">
                    <div class="self-stretch justify-start items-end gap-5 inline-flex">
                        <div id="characterCount"
                            class="text-left text-gray-500 text-sm font-normal font-inter leading-snug">0/250</div>
                    </div>
                </div>
                <div class="flex justify-between py-6 border-b">
                    <button type="button" onclick="clearInputs()"
                        class="h-12 px-6 bg-white rounded-lg justify-center items-center gap-2.5 inline-flex border border-gray-900">
                        <img src="{{ URL('images/x-circle.svg') }}" alt="" class="w-[20px] h-[20px]">
                        <div class="text-center text-base font-medium font-['Inter'] leading-normal">Hapus</div>
                    </button>
                    <button id="submitButton" type="submit"
                        class="h-12 px-6 bg-blue-600 rounded-lg justify-center items-center gap-2.5 inline-flex">
                        <img src="{{ URL('images/glass.svg') }}" alt="" class="w-[20px] h-[20px]">
                        <div class="text-center text-white text-base font-medium font-['Inter'] leading-normal">Buat
                            Modul</div>
                    </button>

                    <button id="loadingButton" disabled type="button"
                        class="h-12 px-6 bg-blue-600 rounded-lg justify-center items-center gap-2.5 inline-flex"
                        style="display: none;">
                        <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor"
                                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 4.418 3.582 8 8 8v-4zm10-1.874A6 6 0 1012 2.83v4.587a.944.944 0 00-.944.943h4.587A7.966 7.966 0 0114 12h4c0-3.313-2.54-6.036-5.786-6.371L14 5.415v-2.11l6.1 1.706">
                            </path>
                        </svg>
                        <span class="text-white">Sedang Proses</span>
                    </button>
                </div>
            </form>
        </div>


        <div class="flex-col justify-start items-start lg:ml-[72px] inline-flex mt-3 lg:mt-0">
            <div class="text-gray-900 text-2xl font-semibold font-['Inter'] leading-[30px]">Hasil</div>
            <div class="w-full lg:w-[788px] text-gray-500 text-sm font-normal font-['Inter'] leading-snug mt-3">
                @if (session('error'))
                    <div class="flex items-center p-4 mb-4 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50"
                        role="alert">
                        <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                        </svg>
                        <span class="sr-only">Error!</span>
                        <div>
                            <span class="font-medium">{{ session('error') }}</span>
                        </div>
                    </div>
                @endif
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
                                    <th class="px-6 py-3 text-left text-sm font-bold text-gray-800 uppercase" colspan="2">
                                        Sarana dan Prasarana</th>
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
                                    <th class="px-6 py-3 text-left text-sm font-bold text-gray-800 uppercase" colspan="2">
                                        Komponen Pembelajaran</th>
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
                                    <th class="px-6 py-3 text-left text-sm font-bold text-gray-800 uppercase" colspan="2">
                                        Tujuan Kegiatan Pembelajaran</th>
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
                                    <th class="px-6 py-3 text-left text-sm font-bold text-gray-800 uppercase" colspan="2">
                                        Pemahaman Bermakna</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @foreach ($data['pemahaman_bermakna'] as $key => $value)
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
                @endisset
            </div>





        </div>
    </div>

    <script>
        function clearInputs() {
            document.getElementById('name').value = ''; // Menghapus nilai input nama
            document.getElementById('subject').value = ''; // Menghapus nilai input subject
            document.getElementById('grade').value = ''; // Menghapus nilai input grade
            document.getElementById('notes').value = ''; // Menghapus nilai input notes
        }

        function updateCharacterCount(textarea) {
            var characterCountElement = document.getElementById('characterCount');
            var currentCount = textarea.value.length;
            characterCountElement.textContent = currentCount + '/250';
        }
        document.addEventListener('DOMContentLoaded', function() {
            const submitButton = document.getElementById('submitButton');
            const loadingButton = document.getElementById('loadingButton');

            submitButton.addEventListener('click', function() {
                // Validasi input
                var name = document.getElementById('name').value;
                var subject = document.getElementById('subject').value;
                var grade = document.getElementById('grade').value;
                var notes = document.getElementById('notes').value;
                var isValid = name.trim() !== '' && subject.trim() !== '' && grade.trim() !== '' && notes
                    .trim() !== '';

                if (isValid) {
                    submitButton.style.display = 'none';
                    loadingButton.style.display = 'inline-flex';

                    // Optional: Set a timeout to simulate form submission
                    setTimeout(function() {
                        // Your form submission code here...
                        // For example:
                        // form.submit();
                    }, 3000); // Adjust the timeout as needed (in milliseconds)
                } else {
                    // Tampilkan pesan bahwa ada kolom yang kosong
                    alert('Silahkan lengkapi semua kolom sebelum melanjutkan.');
                }
            });
        });
    </script>





@endsection
