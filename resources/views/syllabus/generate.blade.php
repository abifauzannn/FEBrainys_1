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
                        <svg aria-hidden="true" role="status" class="animate-spin w-5 h-5 mr-3 text-white"
                            viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                fill="#E5E7EB" />
                            <path
                                d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                fill="currentColor" />
                        </svg>
                        <span class="text-white">Loading...</span>
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
                            <div class="fixed bottom-0 right-0 mb-8 mr-2">
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
        function clearInputs() {
            document.getElementById('name').value = ''; // Menghapus nilai input nama
            document.getElementById('subject').value = ''; // Menghapus nilai input subject
            document.getElementById('grade').value = ''; // Menghapus nilai input grade
            document.getElementById('notes').value = ''; // Menghapus nilai input notes
        }

        function updateCharacterCount(textarea) {
            var characterCountElement = document.getElementById('characterCount');
            var currentCount = textarea.value.length;
            characterCountElement.textContent = currentCount + '/50';
        }
        document.addEventListener('DOMContentLoaded', function() {
            const submitButton = document.getElementById('submitButton');
            const loadingButton = document.getElementById('loadingButton');

            submitButton.addEventListener('click', function() {
                submitButton.style.display = 'none';
                loadingButton.style.display = 'inline-flex';

                // Optional: Set a timeout to simulate form submission
                setTimeout(function() {
                    // Your form submission code here...
                    // For example:
                    // form.submit();
                }, 3000); // Adjust the timeout as needed (in milliseconds)
            });
        });
    </script>





@endsection
