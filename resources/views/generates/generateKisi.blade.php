@extends('layouts.template')

@section('title', 'Templat Kisi Kisi - Brainys')

@section('meta')
    <meta name="robots" content="noindex, nofollow">
@endsection

@section('content')
    @php
        $options = [];
        for ($i = 1; $i <= 12; $i++) {
            if ($i <= 6) {
                $options[] = ['value' => $i, 'label' => "$i SD"];
            } elseif ($i <= 9) {
                $options[] = ['value' => $i, 'label' => "$i SMP"];
            } else {
                $options[] = ['value' => $i, 'label' => "$i SMA"];
            }
        }
    @endphp
    <x-nav></x-nav>

    @if (session('user')['is_active'] == 0)
        <script>
            window.location.href = "{{ route('dashboard') }}";
        </script>
    @endif

    <div class="container mx-auto px-4 py-6 sm:px-10 sm:py-9 relative">
        <x-back-button url="{{ route('dashboard') }}" />
        <x-banner-page-generate title="Templat Kisi Kisi Soal"
            description="Gunakan template kisi kisi soal dari capaian belajar" />
        {{-- <div class="mt-2 text-gray-500 text-sm leading-snug font-bold">Kuota yang sudah dipakai
        {{ $userLimit['all']['used'] }} dari {{ $userLimit['all']['limit'] }} </div> --}}
    </div>

    <div class="flex container mx-auto px-3 sm:px-10 flex-col lg:flex-row">
        <div class="w-full lg:w-[500px] flex-col justify-start items-start sm:gap-6 inline-flex h-auto">
            <form action="{{ route('modulAjarPost') }}" method="post" class="w-full">
                <!-- Input untuk Nama Silabus -->
                @csrf

                <x-generate-field type="text" id="name" name="name" label="Nama Kisi Kisi"
                    placeholder="masukan nama Kisi Kisi" tooltipId="nameTooltip"
                    tooltipText="Contoh : SOLUSI MENGATASI PEMANASAN GLOBAL" />

                <x-select-field id="grade" label="Kelas" :options="$options" defaultOption="Pilih Kelas" />

                <x-generate-field type="text" id="subject" name="subject" label="Mata Pelajaran"
                    placeholder="masukan nama mata pelajaran" tooltipId="subjectTooltip" tooltipText="Contoh : Geografi" />

                <x-generate-field type="text" id="elemen" name="elemen" label="Elemen"
                    placeholder="masukan kategori elemen" tooltipId="elementTooltip" tooltipText="Contoh : Element A" />

                <x-textarea-field id="notes" name="notes" label="Deskripsi Pembelajaran"
                    tooltipId="descriptionTooltip" placeholder="masukan deskripsi kisi - kisi"
                    tooltipText="Contoh : Untuk memperkenalkan ke siswa tentang bagaimana solusi mengatasi pemanasan global, penyebab
               pemanasan global dan langkah-langkah mengatasinya" />


                <div class="flex justify-between items-center -mt-2">
                    <a href="{{ route('emailVerifyChange') }}"
                        class="text-blue-500 hover:text-blue-700 font-semibold text-sm">Lihat
                        panduan capaian belajar</a>
                    <div class="self-stretch justify-start items-end gap-5 inline-flex">
                        <div id="characterCount"
                            class="text-left text-gray-500 text-sm font-normal font-inter leading-snug">0/250</div>
                    </div>
                </div>


                <div class="flex justify-between py-6 border-b">
                    <button type="button" onclick="clearInputs()"
                        class="group h-12 px-6 bg-white rounded-lg justify-center items-center gap-2.5 inline-flex border border-gray-900 hover:bg-gray-900 hover:border-white hover:text-white transition duration-300 ease-in-out">
                        <svg width="20" height="20" viewBox="0 0 20 20"
                            class=" group-hover:fill-white transition duration-300 ease-in-out"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M10 18C14.4183 18 18 14.4183 18 10C18 5.58172 14.4183 2 10 2C5.58172 2 2 5.58172 2 10C2 14.4183 5.58172 18 10 18ZM8.28033 7.21967C7.98744 6.92678 7.51256 6.92678 7.21967 7.21967C6.92678 7.51256 6.92678 7.98744 7.21967 8.28033L8.93934 10L7.21967 11.7197C6.92678 12.0126 6.92678 12.4874 7.21967 12.7803C7.51256 13.0732 7.98744 13.0732 8.28033 12.7803L10 11.0607L11.7197 12.7803C12.0126 13.0732 12.4874 13.0732 12.7803 12.7803C13.0732 12.4874 13.0732 12.0126 12.7803 11.7197L11.0607 10L12.7803 8.28033C13.0732 7.98744 13.0732 7.51256 12.7803 7.21967C12.4874 6.92678 12.0126 6.92678 11.7197 7.21967L10 8.93934L8.28033 7.21967Z" />
                        </svg>
                        <div class="text-center text-base font-medium font-['Inter'] leading-normal">Hapus</div>
                    </button>


                    <button id="submitButton" type="submit"
                        class="h-12 px-3 bg-blue-600 rounded-lg justify-center items-center gap-2.5 inline-flex">
                        <img src="{{ URL('images/glass.svg') }}" alt="" class="w-[20px] h-[20px]">
                        <div class="text-center text-white text-base font-medium font-['Inter'] leading-normal">Buat Kisi
                            Kisi</div>
                    </button>

                    <button id="loadingButton" disabled type="button"
                        class="h-12 px-6 bg-blue-600 rounded-lg justify-center items-center gap-2.5 inline-flex"
                        style="display: none;">
                        <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stro/>ke="currentColor"
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
    </script>

@endsection
