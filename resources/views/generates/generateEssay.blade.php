@extends('layouts.template')

@section('title', 'Templat Latihan - Brainys')

@section('meta')
    <meta name="robots" content="noindex, nofollow">
@endsection

@section('content')
    @php
        $type = [
            ['value' => 'essay', 'label' => 'Essay'],
            ['value' => 'multiple_choice', 'label' => 'Multiple Choice'],
        ];
    @endphp
    @php
        $options = [];

        $schoolLevel = session('user')['school_level'] ?? '';

        if ($schoolLevel == 'sd' || $schoolLevel == 'paketa') {
            for ($i = 1; $i <= 6; $i++) {
                $options[] = ['value' => $i, 'label' => "$i SD"];
            }
        } elseif ($schoolLevel == 'smp' || $schoolLevel == 'paketb') {
            for ($i = 7; $i <= 9; $i++) {
                $options[] = ['value' => $i, 'label' => "$i SMP"];
            }
        } elseif ($schoolLevel == 'sma' || $schoolLevel == 'paketc') {
            for ($i = 10; $i <= 12; $i++) {
                $options[] = ['value' => $i, 'label' => "$i SMA"];
            }
        } else {
            for ($i = 1; $i <= 12; $i++) {
                if ($i <= 6) {
                    $options[] = ['value' => $i, 'label' => "$i SD"];
                } elseif ($i <= 9) {
                    $options[] = ['value' => $i, 'label' => "$i SMP"];
                } else {
                    $options[] = ['value' => $i, 'label' => "$i SMA"];
                }
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
        <x-banner-page-generate title="Templat Latihan" description="Gunakan template Latihan kurikulum merdeka" />
        @if (session('user')['school_level'] == '')
            <x-alert-jenjang />
        @endif
    </div>



    <div class="flex container mx-auto px-3 sm:px-10 flex-col lg:flex-row">
        <div class="w-full lg:w-[500px] flex-col justify-start items-start sm:gap-6 inline-flex">
            <form action="{{ route('essayPost') }}" method="post" class="w-full" id="exerciseForm">
                <!-- Input untuk Nama Silabus -->
                @csrf

                <x-generate-field type="text" id="name" name="name" label="Nama Latihan"
                    placeholder="masukan nama latihan" tooltipId="nameTooltip"
                    tooltipText="Contoh : Draft UTS Semester Genap 2023/2024" required />

                <x-select-field id="exerciseType" label="Jenis Latihan" name="exerciseType" :options="$type"
                    defaultOption="Pilih Bentuk Soal Latihan" />


                <x-generate-field type="text" id="subject" name="subject" label="Mata Pelajaran"
                    placeholder="masukan nama mata pelajaran" tooltipId="subjectTooltip" tooltipText="Contoh : Geografi"
                    required />

                @if (session('user')['school_level'] == '')
                    <x-disable-select id="grade" label="Kelas" :options="$options" defaultOption="Pilih Kelas" />
                @elseif (session('user')['school_level'] != '')
                    <x-select-field id="grade" label="Kelas" name="grade" :options="$options"
                        defaultOption="Pilih Kelas" />
                @endif

                <x-generate-field type="number" id="numberOfQuestion" name="numberOfQuestion" label="Jumlah Pertanyaan"
                    placeholder="masukan jumlah pertanyaan" tooltipId="questuinTooltip" tooltipText=" Contoh : 10" required
                    :min="1" />

                <x-textarea-field id="notes" name="notes" label="Deskripsi Pertanyaan"
                    placeholder="masukan deskripsi pertanyaan" tooltipId="descriptionTooltip"
                    tooltipText=" Contoh : Materi Sejarah Indonesia untuk pemahaman menengah ke atas dengan Hot Order Thinking Skill"
                    required />

                <!-- Input untuk Mata Pelajaran -->
                <div class="flex justify-end -mt-2">
                    <div class="self-stretch justify-start items-end gap-5 inline-flex">
                        <div id="characterCount"
                            class="text-left text-gray-500 text-sm font-normal font-inter leading-snug">0/250</div>
                    </div>
                </div>
                <div class="flex justify-between py-6 border-b">
                    <x-delete-button />
                    @if (session('user')['school_level'] == '')
                        <button id="submitButton" type="submit" disabled
                            class="h-12 px-3 bg-blue-600 rounded-lg justify-center items-center gap-2.5 inline-flex">
                            <img src="{{ URL('images/glass.svg') }}" alt="" class="w-[20px] h-[20px]">
                            <div class="text-center text-white text-base font-medium font-['Inter'] leading-normal">Buat
                                Latihan</div>
                        </button>
                    @elseif (session('user')['school_level'] != '')
                        <button id="submitButton" type="submit"
                            class="h-12 px-3 bg-blue-600 rounded-lg justify-center items-center gap-2.5 inline-flex">
                            <img src="{{ URL('images/glass.svg') }}" alt="" class="w-[20px] h-[20px]">
                            <div class="text-center text-white text-base font-medium font-['Inter'] leading-normal">Buat
                                Latihan</div>
                        </button>
                    @endif

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
                        <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="currentColor" viewBox="0 0 20 20">
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
            document.getElementById("name   ").focus();
        });

        function clearInputs() {
            document.getElementById('name').value = '';
            document.getElementById('subject').value = '';
            document.getElementById('grade').value = '';
            document.getElementById('notes').value = '';
            document.getElementById('numberOfQuestion').value = '';
            document.getElementById('exerciseType').value = '';
        }

        document.getElementById('notes').addEventListener('input', function() {
            var characterCountElement = document.getElementById('characterCount');
            var currentCount = this.value.length;
            characterCountElement.textContent = currentCount + '/250';
        });

        document.getElementById('exerciseForm').addEventListener('submit', function(event) {
            event.preventDefault();

            const submitButton = document.getElementById('submitButton');
            const loadingButton = document.getElementById('loadingButton');

            submitButton.style.display = 'none';
            loadingButton.style.display = 'inline-flex';

            this.submit();
        });
    </script>





@endsection
