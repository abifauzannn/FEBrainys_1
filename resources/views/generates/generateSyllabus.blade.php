@extends('layouts.template')

@section('title', 'Templat Syllabus - Brainys')

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
            <div class="text-gray-900 text-2xl font-semibold font-['Inter']">Template Syllabus</div>
            <div class="mt-2 text-gray-500 text-sm leading-snug">Gunakan template Syllabus kurikulum merdeka</div>
        </div>

        <div class="mt-2 text-gray-500 text-sm leading-snug font-bold">Kuota yang sudah dipakai
            {{ $userLimit['syllabus']['used'] }} dari {{ $userLimit['syllabus']['limit'] }} </div>
        <a href="{{ route('historySyllabus') }}"
            class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-lg inline-block transition duration-300 ease-in-out mt-3">View
            History</a>
    </div>



    <div class="flex container mx-auto px-3 sm:px-10 flex-col lg:flex-row">
        <div class="w-full lg:w-[500px] flex-col justify-start items-start sm:gap-6 inline-flex">
            <form action="{{ route('syllabusPost') }}" method="post" class="w-full">
                <!-- Input untuk Nama Silabus -->
                @csrf

                <div class="mb-4">
                    <label for="subject"
                        class="text-gray-900 text-base font-['Inter'] leading-normal font-semibold">Subject</label>
                    <button data-tooltip-target="subjectTooltip" data-tooltip-placement="right" data-tooltip-trigger="click"
                        type="button"
                        class="text-gray-600 transition-colors duration-200 focus:outline-none dark:text-gray-200 dark:hover:text-blue-400 hover:text-blue-500">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9 5.25h.008v.008H12v-.008z" />
                        </svg>
                    </button>

                    <div id="subjectTooltip" role="tooltip"
                        class="w-36 absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                        Contoh : Geografi
                        <div class="tooltip-arrow" data-popper-arrow></div>
                    </div>

                    <input type="text" name="subject" id="subject"
                        class="w-full p-2 border rounded-md mt-[10px] placeholder:text-gray-400 text-base font-normal font-['Inter'] leading-normal"
                        placeholder="masukan nama mata pelajaran" required>
                </div>

                <div class="mb-4">
                    <label for="grade"
                        class="text-gray-900 text-base font-['Inter'] leading-normal font-semibold">Kelas</label>
                    <button data-tooltip-target="gradeTooltip" data-tooltip-placement="right" data-tooltip-trigger="click"
                        type="button"
                        class="text-gray-600 transition-colors duration-200 focus:outline-none dark:text-gray-200 dark:hover:text-blue-400 hover:text-blue-500">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9 5.25h.008v.008H12v-.008z" />
                        </svg>
                    </button>

                    <div id="gradeTooltip" role="tooltip"
                        class="w-36 absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                        Contoh : 11
                        <div class="tooltip-arrow" data-popper-arrow></div>
                    </div>

                    <input type="number" name="grade" id="grade"
                        class="w-full p-2 border rounded-md mt-[10px] placeholder:text-gray-400 text-base font-normal font-['Inter'] leading-normal"
                        placeholder="masukan tingkat kelas" required>
                </div>

                <!-- Input untuk Mata Pelajaran -->
                <div class="mb-4">
                    <label for="nip"
                        class="text-gray-900 text-base font-semibold font-['Inter'] leading-normal">NIP</label>
                    <button data-tooltip-target="nipTooltip" data-tooltip-placement="right" data-tooltip-trigger="click"
                        type="button"
                        class="text-gray-600 transition-colors duration-200 focus:outline-none dark:text-gray-200 dark:hover:text-blue-400 hover:text-blue-500">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9 5.25h.008v.008H12v-.008z" />
                        </svg>
                    </button>

                    <div id="nipTooltip" role="tooltip"
                        class="w-38 absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                        Contoh : 199703242016022001
                        <div class="tooltip-arrow" data-popper-arrow></div>
                    </div>

                    <input type="text" id="nip" name="nip"
                        class="w-full p-2 border rounded-md mt-[10px] placeholder:text-gray-400 text-base font-normal font-['Inter'] leading-normal"
                        placeholder="masukan nip" minlength="21" maxlength="25" required>

                </div>

                <div class="mb-4">
                    <label for="notes"
                        class="text-gray-900 text-base font-semibold font-['Inter'] leading-normal mb-[10px]">Deskripsi
                        Syllabus</label>
                    <button data-tooltip-target="notesTooltip" data-tooltip-placement="right"
                        data-tooltip-trigger="click" type="button"
                        class="text-gray-600 transition-colors duration-200 focus:outline-none dark:text-gray-200 dark:hover:text-blue-400 hover:text-blue-500">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9 5.25h.008v.008H12v-.008z" />
                        </svg>
                    </button>

                    <div id="notesTooltip" role="tooltip"
                        class="w-36 absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                        Contoh : Buatkan silabus untuk mata pelajaran Geografi kelas 11
                        <div class="tooltip-arrow" data-popper-arrow></div>
                    </div>

                    <textarea id="notes" name="notes"
                        class="w-full p-2 border rounded-md mt-[10px] placeholder:text-gray-400 text-base font-normal font-['Inter'] leading-normal"
                        placeholder="Masukkan deskripsi syllabus" maxlength="250" oninput="updateCharacterCount(this)" required></textarea>

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
                            Syllabus</div>
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


                    <div class="overflow-x-auto my-3">
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
                        <table class="w-full">
                            <thead class=" bg-slate-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-sm font-bold text-gray-800 uppercase" colspan="2">
                                        Silabus Pembelajaran</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                <tr class="">
                                    <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200 font-semibold bg-slate-50">
                                        Mata Pelajaran</td>
                                    <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200">
                                        {{ $data['silabus_pembelajaran']['mata_pelajaran'] }}
                                    </td>
                                </tr>
                                <tr class="">
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
                                </tr>
                            </tbody>
                        </table>
                    </div>


                    <div class="overflow-x-auto mt-4">
                        <table class="w-full">
                            <tbody class="divide-y divide-gray-200">
                                <tr>
                                    <td class="px-3 py-4 text-sm text-gray-800 dark:text-gray-200 font-semibold bg-slate-50">
                                        Kompetensi Dasar</td>
                                    <td class="px-3 py-4 text-sm text-gray-800 dark:text-gray-200 font-semibold bg-slate-50">
                                        Materi Pembelajaran</td>
                                    <td class="px-3 py-4 text-sm text-gray-800 dark:text-gray-200 font-semibold bg-slate-50">
                                        Kegiatan Pembelajaran</td>
                                </tr>
                                @foreach ($data['silabus_pembelajaran']['inti_silabus'] as $silabus)
                                    <tr class="">
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
                    <div class="mb-3 px-6 py-4">
                        <form action="{{ route('export-word-syllabus') }}" method="post">
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
        document.addEventListener("DOMContentLoaded", function() {
            // Memfokuskan ke input email
            document.getElementById("subject").focus();
        });

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
                var nip = document.getElementById('nip').value;
                var subject = document.getElementById('subject').value;
                var grade = document.getElementById('grade').value;
                var notes = document.getElementById('notes').value;
                var isValid = nip.trim() !== '' && subject.trim() !== '' && grade.trim() !== '' && notes
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
