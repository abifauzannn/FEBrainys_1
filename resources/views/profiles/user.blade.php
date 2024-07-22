@extends('layouts.template')

@section('title', 'User Profile - Brainys')

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

    @php
        $isDisabled = true; // Replace this with your actual condition
    @endphp

    <x-nav></x-nav>

    @if (session('user')['is_active'] == 0)
        <script>
            window.location.href = "{{ route('dashboard') }}";
        </script>
    @endif

    <div class="container mx-auto px-3 sm:px-10 py-6 sm:py-9 font-['Inter']">


        <a href="/dashboard">
            <div class="w-[90px] h-6 justify-start items-end gap-1 inline-flex mb-6">
                <img src="{{ URL('images/back.svg') }}" alt="" class="w-6 h-6">
                <div class="text-black text-base font-semibold font-['Inter']">Kembali</div>
            </div>
        </a>


        <div class="w-full sm:w-[1170px] h-auto sm:h-[60px] flex flex-col justify-start items-start gap-2">
            <div class="text-gray-900 text-2xl font-semibold font-['Inter'] leading-[30px]">Profil Pengguna</div>
        </div>


        <div class="container mx-auto flex flex-col items-center justify-center mt-[51px]">
            @php
                $fullName = session('user')['name'];
                $initials = '';
                $names = explode(' ', $fullName);
                foreach ($names as $name) {
                    $initials .= strtoupper(substr($name, 0, 1));
                }

                // URL to DiceBear Avatars API with initials as parameter
                $avatarUrl =
                    'https://api.dicebear.com/7.x/initials/svg?scale=75&backgroundColor=b6e3f4&seed=' . $initials;
            @endphp

            <!-- Display avatar image -->
            <img src="{{ $avatarUrl }}" alt="Profile Picture" class="w-20 h-20 rounded-full mb-4">

            <form class="w-full max-w-md" action="{{ route('change-profilePost') }}" method="POST" id="profileForm">
                @csrf

                <!-- Popup untuk menampilkan pesan berhasil -->
                <div id="successPopup"
                    class="fixed top-0 left-0 w-full h-full bg-black bg-opacity-50 flex justify-center items-center hidden z-10">
                    <div class="bg-white w-[300px] p-6 rounded-lg shadow-md">
                        <img src="{{ URL('images/success.png') }}" alt="">
                        <div class="text-green-600 font-bold font-['Inter'] mt-4 ">Success!</div>
                        <div class="text-gray-800 font-bold font-['Inter']">{{ session('success') }}</div>
                    </div>
                </div>


                <x-form-input id="name" name="name" type="text" label="Nama Lengkap"
                    placeholder="email@contoh.com" value="{{ session('user')['name'] }}" required />
                <!-- Input field for profession -->

                <x-form-input id="profession" name="profession" type="text" label="Profesi" placeholder="Guru"
                    value="{{ session('user')['profession'] }}" required />


                <!-- Input field for school name -->

                <x-form-input id="school_name" name="school_name" type="text" label="Asal Sekolah"
                    placeholder="Asal Sekolah" value="{{ session('user')['school_name'] }}" required />

                @if (session('user')['school_level'] == '')
                    <x-select-field id="school_level" name="school_level" label="Jenjang" :options="$jenjang"
                        defaultOption="Pilih Jenjang" required />
                @elseif (session('user')['school_level'] == 'smp')
                    <x-select-field id="school_level" name="school_level" label="Jenjang" :options="$jenjang"
                        defaultOption="{{ strtoupper(session('user')['school_level']) }}" required />
                @elseif (session('user')['school_level'] == 'sd')
                    <x-select-field id="school_level" name="school_level" label="Jenjang" :options="$jenjang"
                        defaultOption="{{ strtoupper(session('user')['school_level']) }}" required />
                @elseif (session('user')['school_level'] == 'sma')
                    <x-select-field id="school_level" name="school_level" label="Jenjang" :options="$jenjang"
                        defaultOption="{{ strtoupper(session('user')['school_level']) }}" required />
                @elseif (session('user')['school_level'] == 'paketa')
                    <x-select-field id="school_level" name="school_level" label="Jenjang" :options="$jenjang"
                        defaultOption="{{ strtoupper(session('user')['school_level']) }}" required />
                @elseif (session('user')['school_level'] == 'paketb')
                    <x-select-field id="school_level" name="school_level" label="Jenjang" :options="$jenjang"
                        defaultOption="{{ strtoupper(session('user')['school_level']) }}t" required />
                @elseif (session('user')['school_level'] == 'paketc')
                    <x-select-field id="school_level" name="school_level" label="Jenjang" :options="$jenjang"
                        defaultOption="{{ strtoupper(session('user')['school_level']) }}" required />
                @endif

                <x-form-input id="email" name="email" type="email" label="Email" placeholder="email@contoh.com"
                    value="{{ session('user')['email'] }}" required :disabled="$isDisabled" />


                <div class="flex justify-end items-end mb-4">
                    <a href="{{ route('emailVerifyChange') }}"
                        class="text-blue-600 hover:text-blue-700 font-semibold hover:font-bold">Ganti Password</a>
                </div>

                <div class="flex justify-center">
                    <button id="submitButton"
                        class="w-full h-12 px-6 bg-blue-600 rounded-sm justify-center items-center gap-2.5 inline-flex"
                        type="submit">
                        <img id="checkIcon" src="{{ URL('images/check-circle.svg') }}" alt=""
                            class="w-[20px] h-[20px]">
                        <span id="submitButtonText"
                            class="text-center text-white text-base font-medium font-['Inter'] leading-normal">Simpan
                            Profil</span>
                        <div id="loadingSpinner" class="hidden ml-2">
                            <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                    stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor"
                                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                </path>
                            </svg>
                        </div>
                    </button>
                </div>
            </form>
        </div>

    </div>

    @if (session('success'))
        <script>
            // Tampilkan popup ketika halaman dimuat
            window.addEventListener('DOMContentLoaded', (event) => {
                // Tampilkan popup
                document.getElementById('successPopup').classList.remove('hidden');

                // Sembunyikan popup setelah 3 detik
                setTimeout(function() {
                    document.getElementById('successPopup').classList.add('hidden');
                }, 3000);
            });
        </script>
    @endif

    <script>
        document.getElementById('profileForm').addEventListener('submit', function() {
            // Show loading spinner
            document.getElementById('submitButtonText').classList.add('hidden');
            document.getElementById('checkIcon').classList.add('hidden');
            document.getElementById('loadingSpinner').classList.remove('hidden');
        });
    </script>

@endsection
