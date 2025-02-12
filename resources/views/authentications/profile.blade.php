@extends('layouts.template')

@section('title', 'Profile - Brainys')

@section('meta')
    <meta name="robots" content="noindex, nofollow">
@endsection

@section('content')

    @php
        $jenjang = [
            ['value' => 'sd', 'label' => ' SD/MI Sederajat'],
            ['value' => 'smp', 'label' => ' SMP/MTs Sederajat'],
            ['value' => 'sma', 'label' => ' SMA/SMK/MA Sederajat'],
            ['value' => 'paketa', 'label' => ' Pendidikan Kesetaraan Paket A'],
            ['value' => 'paketb', 'label' => ' Pendidikan Kesetaraan Paket B'],
            ['value' => 'paketc', 'label' => ' Pendidikan Kesetaraan Paket C'],
        ];
    @endphp

    <div class="container mx-auto flex items-center justify-center flex-col mt-10">
        <img src="{{ URL('images/Steps1.png') }}" alt="" class="w-[206px] h-[84px]">
        <div class="w-full p-3 h-[420px] flex items-center justify-center flex-col mt-24 sm:mt-[100px]">
            <img src="{{ URL('images/user.svg') }}" alt="">
            <div class="text-gray-900 text-4xl font-bold font-['Inter'] leading-[48px] mt-4 mb-4">Lengkapi Profile</div>
            <div class="text-center text-gray-900 text-base font-medium font-['Inter'] leading-normal mb-12">Silakan
                lengkapi profile anda terlebih dahulu</div>
            <form action="{{ route('complete.profile') }}" method="post" id="profileForm">
                @csrf
                <div class="mb-4">
                    <label for="name"
                        class="text-gray-900 text-base font-semibold font-['Inter'] leading-normal mb-[30px]">Nama
                        Lengkap</label>
                    <input type="text" id="name" name="name"
                        class="w-full p-3 border rounded-md mt-[10px] placeholder:text-gray-400 text-[16px] font-normal font-['Inter'] leading-normal"
                        placeholder="Contoh: Budiman" required>
                </div>

                <div class="mb-4">
                    <label for="school_level"
                        class="text-gray-900 text-base font-semibold font-['Inter'] leading-normal mb-[30px]">Jenjang</label>
                    <select id="school_level" name="school_level"
                        class="w-full p-3 border rounded-md mt-[10px] placeholder:text-gray-400 text-[16px] font-normal font-['Inter'] leading-normal"
                        required>
                        <option value="" disabled selected>Pilih Jenjang</option>
                        @foreach ($jenjang as $item)
                            <option value="{{ $item['value'] }}">{{ $item['label'] }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label for="school_name"
                        class="text-gray-900 text-base font-semibold font-['Inter'] leading-normal mb-[30px]">Sekolah</label>
                    <input type="text" id="school_name" name="school_name"
                        class="w-full p-3 border rounded-md mt-[10px] placeholder:text-gray-400 text-[16px] font-normal font-['Inter'] leading-normal"
                        placeholder="Contoh: SMP 1 Bandung" required>
                </div>

                <div class="mb-4">
                    <label for="profession"
                        class="text-gray-900 text-base font-semibold font-['Inter'] leading-normal mb-[30px]">Profesi</label>
                    <input type="text" id="profession" name="profession"
                        class="w-full p-2 border rounded-md mt-[10px] placeholder:text-gray-400 text-base font-normal font-['Inter'] leading-normal"
                        placeholder="Contoh: Guru Biologi" required>
                </div>

                <button type="submit" id="submitButton"
                    class="w-full h-12 px-6 my-5 bg-blue-600 rounded-[50px] justify-center items-center gap-2.5 inline-flex">
                    <img src="{{ URL('images/arrow.svg') }}" alt="" class="w-[20px] h-[20px]">
                    <div class="text-center text-white text-base font-medium font-['Inter'] leading-normal">Konfirmasi
                    </div>
                </button>

                <button id="loadingButton" disabled type="button"
                    class="h-12 px-6 my-5 bg-blue-600 rounded-[50px] justify-center items-center gap-2.5 inline-flex w-full hidden">
                    <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                            stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor"
                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                        </path>
                    </svg>
                </button>

            </form>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.getElementById("name").focus();
        });

        const submitButton = document.getElementById("konfirmasiButton");
        const loadingIndicator = document.getElementById("loadingButton");

        document.getElementById('profileForm').addEventListener('submit', function() {
            // Show loading spinner
            document.getElementById('submitButton').classList.add('hidden');
            document.getElementById('loadingButton').classList.remove('hidden');
        });
    </script>

@endsection
