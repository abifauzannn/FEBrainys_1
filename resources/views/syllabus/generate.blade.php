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
            <div class="text-gray-900 text-2xl font-semibold font-['Inter'] leading-[30px]">Template Silabus</div>
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
                            <!-- Display the generated syllabus -->
                            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                    <thead class="text-xs text-gray-700 uppercase dark:text-gray-400">
                                        <tr>
                                            <th scope="col" class="px-6 py-3 bg-gray-50 dark:bg-gray-800 text-lg"
                                                colspan="2">
                                                Informasi Umum
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="border-b border-gray-200 dark:border-gray-700">
                                            <th scope="row"
                                                class="px-6 py-4 text-gray-900 whitespace-nowrap bg-gray-50 dark:text-white dark:bg-gray-800 font-bold">
                                                Penyusun
                                            </th>
                                            <td class="px-6 py-4">
                                                {{ $data['informasi_umum']['penyusun'] }}
                                            </td>
                                        </tr>
                                        <tr class="border-b border-gray-200 dark:border-gray-700">
                                            <th scope="row"
                                                class="px-6 py-4 font-bold text-gray-900 whitespace-nowrap bg-gray-50 dark:text-white dark:bg-gray-800">
                                                Instansi
                                            </th>
                                            <td class="px-6 py-4">
                                                {{ $data['informasi_umum']['instansi'] }}
                                            </td>
                                        </tr>
                                        <tr class="border-b border-gray-200 dark:border-gray-700">
                                            <th scope="row"
                                                class="px-6 py-4 font-bold text-gray-900 whitespace-nowrap bg-gray-50 dark:text-white dark:bg-gray-800">
                                                Tahun Penyusunan
                                            </th>
                                            <td class="px-6 py-4">
                                                {{ $data['informasi_umum']['tahun_penyusunan'] }}
                                            </td>
                                        </tr>
                                        <tr class="border-b border-gray-200 dark:border-gray-700">
                                            <th scope="row"
                                                class="px-6 py-4 font-bold text-gray-900 whitespace-nowrap bg-gray-50 dark:text-white dark:bg-gray-800">
                                                Jenjang Sekolah
                                            </th>
                                            <td class="px-6 py-4">
                                                {{ $data['informasi_umum']['jenjang_sekolah'] }}
                                            </td>
                                        </tr>
                                        <tr class="border-b border-gray-200 dark:border-gray-700">
                                            <th scope="row"
                                                class="px-6 py-4 font-bold text-gray-900 whitespace-nowrap bg-gray-50 dark:text-white dark:bg-gray-800">
                                                Mata Pelajaran
                                            </th>
                                            <td class="px-6 py-4">
                                                {{ $data['informasi_umum']['mata_pelajaran'] }}
                                            </td>
                                        </tr>
                                        <tr class="border-b border-gray-200 dark:border-gray-700">
                                            <th scope="row"
                                                class="px-6 py-4 font-bold text-gray-900 whitespace-nowrap bg-gray-50 dark:text-white dark:bg-gray-800">
                                                Fase Kelas
                                            </th>
                                            <td class="px-6 py-4">
                                                {{ $data['informasi_umum']['fase_kelas'] }}
                                            </td>
                                        </tr>
                                        <tr class="border-b border-gray-200 dark:border-gray-700">
                                            <th scope="row"
                                                class="px-6 py-4 font-bold text-gray-900 whitespace-nowrap bg-gray-50 dark:text-white dark:bg-gray-800">
                                                Topik
                                            </th>
                                            <td class="px-6 py-4">
                                                {{ $data['informasi_umum']['topik'] }}
                                            </td>
                                        </tr>
                                        <tr class="border-b border-gray-200 dark:border-gray-700">
                                            <th scope="row"
                                                class="px-6 py-4 font-bold text-gray-900 whitespace-nowrap bg-gray-50 dark:text-white dark:bg-gray-800">
                                                Alokasi Waktu
                                            </th>
                                            <td class="px-6 py-4">
                                                {{ $data['informasi_umum']['alokasi_waktu'] }}
                                            </td>
                                        </tr>
                                        <tr class="border-b border-gray-200 dark:border-gray-700">
                                            <th scope="row"
                                                class="px-6 py-4 font-bold text-gray-900 whitespace-nowrap bg-gray-50 dark:text-white dark:bg-gray-800">
                                                Kompetensi Awal
                                            </th>
                                            <td class="px-6 py-4">
                                                {{ $data['informasi_umum']['kompetensi_awal'] }}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-5">
                                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                    <thead class="text-xs text-gray-700 uppercase dark:text-gray-400">
                                        <tr>
                                            <th scope="col" class="px-6 py-3 bg-gray-50 dark:bg-gray-800 text-lg"
                                                colspan="2">
                                                Sarana dan Prasarana
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="border-b border-gray-200 dark:border-gray-700">
                                            <th scope="row"
                                                class="px-6 py-4 text-gray-900 whitespace-nowrap bg-gray-50 dark:text-white dark:bg-gray-800 font-bold">
                                                Sumber Belajar
                                            </th>
                                            <td class="px-6 py-4">
                                                {{ $data['sarana_dan_prasarana']['sumber_belajar'] }}
                                            </td>
                                        </tr>
                                        <tr class="border-b border-gray-200 dark:border-gray-700">
                                            <th scope="row"
                                                class="px-6 py-4 font-bold text-gray-900 whitespace-nowrap bg-gray-50 dark:text-white dark:bg-gray-800">
                                                Lembar Kerja Peserta Didik
                                            </th>
                                            <td class="px-6 py-4">
                                                {{ $data['sarana_dan_prasarana']['lembar_kerja_peserta_didik'] }}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-5">
                                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                    <thead class="text-xs text-gray-700 uppercase dark:text-gray-400">
                                        <tr>
                                            <th scope="col" class="px-6 py-3 bg-gray-50 dark:bg-gray-800 text-lg"
                                                colspan="2">
                                                Komponen Pembelajaran
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="border-b border-gray-200 dark:border-gray-700">
                                            <th scope="row"
                                                class="px-6 py-4 text-gray-900 whitespace-nowrap bg-gray-50 dark:text-white dark:bg-gray-800 font-bold">
                                                Perlengkapan Peserta Didik
                                            </th>
                                            <td class="px-6 py-4">
                                                @foreach ($data['komponen_pembelajaran']['perlengkapan_peserta_didik'] as $key => $item)
                                                    <ul>{{ $key + 1 }}. {{ $item }}</ul>
                                                @endforeach
                                            </td>
                                        </tr>
                                        <tr class="border-b border-gray-200 dark:border-gray-700">
                                            <th scope="row"
                                                class="px-6 py-4 font-bold text-gray-900 whitespace-nowrap bg-gray-50 dark:text-white dark:bg-gray-800">
                                                Perlengkapan Guru
                                            </th>
                                            <td class="px-6 py-4">
                                                @foreach ($data['komponen_pembelajaran']['perlengkapan_guru'] as $key => $item)
                                                    <ul>{{ $key + 1 }}. {{ $item }}</ul>
                                                @endforeach
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-5">
                                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                    <thead class="text-xs text-gray-700 uppercase dark:text-gray-400">
                                        <tr>
                                            <th scope="col" class="px-6 py-3 bg-gray-50 dark:bg-gray-800 text-lg"
                                                colspan="2">
                                                Tujuan Kegiatan Pembelajaran
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="border-b border-gray-200 dark:border-gray-700">
                                            <th scope="row"
                                                class="px-6 py-4 text-gray-900 whitespace-nowrap bg-gray-50 dark:text-white dark:bg-gray-800 font-bold">
                                                Pembelajaran Bab
                                            </th>
                                            <td class="px-6 py-4">
                                                {{ $data['tujuan_kegiatan_pembelajaran']['tujuan_pembelajaran_bab'] }}
                                            </td>
                                        </tr>
                                        <tr class="border-b border-gray-200 dark:border-gray-700">
                                            <th scope="row"
                                                class="px-6 py-4 font-bold text-gray-900 whitespace-nowrap bg-gray-50 dark:text-white dark:bg-gray-800">
                                                Tujuan Pembelajaran Topik
                                            </th>
                                            <td class="px-6 py-4">
                                                @foreach ($data['tujuan_kegiatan_pembelajaran']['tujuan_pembelajaran_topik'] as $key => $item)
                                                    <ul>{{ $key + 1 }}. {{ $item }}</ul>
                                                @endforeach
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-5">
                                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                    <thead class="text-xs text-gray-700 uppercase dark:text-gray-400">
                                        <tr>
                                            <th scope="col" class="px-6 py-3 bg-gray-50 dark:bg-gray-800 text-lg"
                                                colspan="2">
                                                Pemahaman Bermakna
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="border-b border-gray-200 dark:border-gray-700">
                                            <th scope="row"
                                                class="px-6 py-4 text-gray-900 whitespace-nowrap bg-gray-50 dark:text-white dark:bg-gray-800 font-bold">
                                                Topik
                                            </th>
                                            <td class="px-6 py-4">
                                                {{ $data['pemahaman_bermakna']['topik'] }}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-5">
                                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                    <thead class="text-xs text-gray-700 uppercase dark:text-gray-400">
                                        <tr>
                                            <th scope="col" class="px-6 py-3 bg-gray-50 dark:bg-gray-800 text-lg" colspan="7">
                                                Kompetensi Dasar
                                            </th>
                                        </tr>
                                        <tr>
                                            <th scope="col" class="px-6 py-3 bg-gray-50 dark:bg-gray-800 text-sm">
                                                Nama Kompetensi Dasar
                                            </th>
                                            <th scope="col" class="px-6 py-3 bg-gray-50 dark:bg-gray-800 text-sm">
                                                Materi
                                            </th>
                                            <th scope="col" class="px-6 py-3 bg-gray-50 dark:bg-gray-800 text-sm">
                                                Indikator
                                            </th>
                                            <th scope="col" class="px-6 py-3 bg-gray-50 dark:bg-gray-800 text-sm">
                                                Nilai Karakter
                                            </th>
                                            <th scope="col" class="px-6 py-3 bg-gray-50 dark:bg-gray-800 text-sm">
                                                Kegiatan Pembelajaran
                                            </th>
                                            <th scope="col" class="px-6 py-3 bg-gray-50 dark:bg-gray-800 text-sm">
                                                Alokasi Waktu
                                            </th>
                                            <th scope="col" class="px-6 py-3 bg-gray-50 dark:bg-gray-800 text-sm">
                                                Penilaian
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data['kompetensi_dasar'] as $kompetensi)
                                            @foreach ($kompetensi['materi_pembelajaran'] as $materi)
                                                <tr class="border-b border-gray-200 dark:border-gray-700">
                                                    <td class="px-6 py-4">
                                                        {{ $kompetensi['nama_kompetensi_dasar'] }}
                                                    </td>
                                                    <td class="px-6 py-4">
                                                        {{ $materi['materi'] }}
                                                    </td>
                                                    <td class="px-6 py-4">
                                                        {{ $materi['indikator'] }}
                                                    </td>
                                                    <td class="px-6 py-4">
                                                        {{ $materi['nilai_karakter'] }}
                                                    </td>
                                                    <td class="px-6 py-4">
                                                        {{ $materi['kegiatan_pembelajaran'] }}
                                                    </td>
                                                    <td class="px-6 py-4">
                                                        {{ $materi['alokasi_waktu'] }}
                                                    </td>
                                                    <td class="px-6 py-4">
                                                        @foreach ($materi['penilaian'] as $penilaian)
                                                            <div>
                                                                Jenis: {{ $penilaian['jenis'] }} - Bobot: {{ $penilaian['bobot'] }}
                                                            </div>
                                                        @endforeach
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endforeach
                                    </tbody>
                                </table>
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
