@extends('layouts.template')

@section('title', 'Templat Latihan - Brainys')

@section('content')
    <x-nav></x-nav>

    <div class="container mx-auto px-4 py-6 sm:px-10 sm:py-9 relative">




        <button onclick="window.location='{{ route('dashboard') }}'" class="mb-6">
            <div class="flex items-cente">
                <img src="{{ URL('images/back.svg') }}" alt="" class="w-6 h-6">
                <div class="text-black text-base font-semibold ml-2">Kembali</div>
            </div>
        </button>



        <div class="w-full">
            <div class="text-gray-900 text-2xl font-semibold font-['Inter']">Template Latihan</div>
            <div class="mt-2 text-gray-500 text-sm leading-snug">Gunakan template Latihan kurikulum merdeka</div>
        </div>

        <div class="mt-2 text-gray-500 text-sm leading-snug font-bold">Kuota yang sudah dipakai
            {{ $userLimit['all']['used'] }} dari {{ $userLimit['all']['limit'] }} </div>

    </div>



    <div class="flex container mx-auto px-3 sm:px-10 flex-col lg:flex-row">
        <div class="w-full lg:w-[500px] flex-col justify-start items-start sm:gap-6 inline-flex">
            <form action="{{ route('essayPost') }}" method="post" class="w-full">
                <!-- Input untuk Nama Silabus -->
                @csrf

                <div class="mb-4">
                    <label for="name" class="text-gray-900 text-base font-['Inter'] leading-normal font-semibold">Nama
                        Latihan</label>
                    <button data-tooltip-target="nameTooltip" data-tooltip-placement="right" data-tooltip-trigger="click"
                        type="button"
                        class="text-gray-600 transition-colors duration-200 focus:outline-none dark:text-gray-200 dark:hover:text-blue-400 hover:text-blue-500">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9 5.25h.008v.008H12v-.008z" />
                        </svg>
                    </button>

                    <div id="nameTooltip" role="tooltip"
                        class="w-36 absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                        Contoh : Draft UTS Semester Genap 2023/2024
                        <div class="tooltip-arrow" data-popper-arrow></div>
                    </div>

                    <input type="text" name="name" id="name"
                        class="w-full p-2 border rounded-md mt-[10px] placeholder:text-gray-400 text-base font-normal font-['Inter'] leading-normal"
                        placeholder="masukan nama latihan" required>
                </div>

                <div class="mb-4">
                    <label for="exerciseType"
                        class="text-gray-900 text-base font-semibold font-['Inter'] leading-normal">Jenis Latihan</label>
                    <select name="exerciseType" id="exerciseType"
                        class="w-full p-2 border rounded-md mt-[10px] placeholder:text-gray-400 text-base font-normal font-['Inter'] leading-normal"
                        required>
                        <option>Pilih Bentuk Soal Latihan</option>
                        <option value="essay">Essay</option>
                        <option value="multiple_choice">Multiple Choice</option>
                    </select>
                </div>


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
                        Contoh : Sejarah Indonesia
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
                    <label for="numberOfQuestion"
                        class="text-gray-900 text-base font-semibold font-['Inter'] leading-normal">Jumlah
                        Pertanyaan</label>
                    <button data-tooltip-target="numberTooltip" data-tooltip-placement="right"
                        data-tooltip-trigger="click" type="button"
                        class="text-gray-600 transition-colors duration-200 focus:outline-none dark:text-gray-200 dark:hover:text-blue-400 hover:text-blue-500">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9 5.25h.008v.008H12v-.008z" />
                        </svg>
                    </button>

                    <div id="numberTooltip" role="tooltip"
                        class="w-36 absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                        Contoh : 10
                        <div class="tooltip-arrow" data-popper-arrow></div>
                    </div>

                    <input type="number" id="numberOfQuestion" name="numberOfQuestion"
                        class="w-full p-2 border rounded-md mt-[10px] placeholder:text-gray-400 text-base font-normal font-['Inter'] leading-normal"
                        placeholder="masukan jumlah pertanyaan" required>

                </div>

                <div class="mb-4">
                    <label for="notes"
                        class="text-gray-900 text-base font-semibold font-['Inter'] leading-normal mb-[10px]">Deskripsi
                        Pertanyaan</label>
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
                        Contoh : Materi Sejarah Indonesia untuk pemahaman menengah ke atas dengan Hot Order Thinking Skill
                        <div class="tooltip-arrow" data-popper-arrow></div>
                    </div>

                    <textarea id="notes" name="notes"
                        class="w-full p-2 border rounded-md mt-[10px] placeholder:text-gray-400 text-base font-normal font-['Inter'] leading-normal"
                        placeholder="Masukkan deskripsi pertanyaan" maxlength="250" oninput="updateCharacterCount(this)" required></textarea>

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
                            Latihan</div>
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


                    @if (isset($data['soal_essay']) && !empty($data['soal_essay']))
                        <div class="overflow-x-auto my-4">
                            <table class="w-full">
                                <thead class="bg-slate-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-sm font-bold text-gray-800 uppercase">No.</th>
                                        <th class="px-6 py-3 text-left text-sm font-bold text-gray-800 uppercase">Pertanyaan
                                        </th>
                                        <th class="px-6 py-3 text-left text-sm font-bold text-gray-800 uppercase">Instruksi
                                        </th>
                                        <th class="px-6 py-3 text-left text-sm font-bold text-gray-800 uppercase">Kriteria
                                            Penilaian</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200">
                                    @foreach ($data['soal_essay'] as $index => $soal)
                                        <tr>
                                            <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200">{{ $index + 1 }}
                                            </td>
                                            <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200">
                                                {{ $soal['question'] }}</td>
                                            <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200">
                                                {{ $soal['instructions'] }}</td>
                                            <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200">
                                                <ul>
                                                    @foreach ($soal['kriteria_penilaian'] as $kriteria => $value)
                                                        <li>{{ $kriteria + 1 }}. {{ $value }}</li>
                                                    @endforeach
                                                </ul>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif

                    @if (isset($data['soal_pilihan_ganda']) && !empty($data['soal_pilihan_ganda']))
                        <div class="w-full overflow-x-auto my-4">
                            @foreach ($data['soal_pilihan_ganda'] as $index => $question)
                                <div class="mt-4 px-6 py-4 bg-slate-50">
                                    <p class="text-gray-800 dark:text-gray-200"><strong>{{ $index + 1 }}.</strong>
                                        {{ $question['question'] }}</p>
                                    <ul>
                                        @foreach ($question['options'] as $key => $option)
                                            <li class="text-gray-800 dark:text-gray-200 ml-4 py-1">
                                                {{ $key }} {{ $option }}
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endforeach
                        </div>
                    @endif


                    <div class="mb-3 px-6 py-4">
                        <form action="{{ route('export-essay') }}" method="post">
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
            document.getElementById("name").focus();
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


        document.addEventListener("DOMContentLoaded", function() {
            var toastSuccess = document.getElementById("toast-warning");
            toastSuccess.classList.add("opacity-100", "translate-x-[-5%]");

            setTimeout(function() {
                toastSuccess.classList.remove("opacity-100", "translate-x-[-5%]");
            }, 3000);
        });
    </script>





@endsection
