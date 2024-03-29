@extends('layouts.template')

@section('title', 'User Profile - Brainys')

@section('content')
    <x-nav></x-nav>



    <div class="container mx-auto px-3 sm:px-10 py-6 sm:py-9 font-['Inter']">


        <a href="/dashboard">
            <div class="w-[90px] h-6 justify-start items-end gap-1 inline-flex mb-6">
                <img src="{{ URL('images/back.svg') }}" alt="" class="w-6 h-6">
                <div class="text-black text-base font-semibold font-['Inter']">Kembali</div>
            </div>
        </a>


        <div class="w-full sm:w-[1170px] h-auto sm:h-[60px] flex flex-col justify-start items-start gap-2">
            <div class="text-gray-900 text-2xl font-semibold font-['Inter'] leading-[30px]">Profil Pengguna</div>
            <div class="w-full sm:w-[549px] text-gray-500 text-sm font-normal font-['Inter'] leading-snug">Lorem ipsum dolor
                sit amet, consectetur adipiscing elit. Cras ultrices lectus sem.</div>
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

            <form class="w-full max-w-md" action="{{ route('change-profilePost') }}" method="POST">
                @csrf

                <!-- Popup untuk menampilkan pesan berhasil -->
                <div id="successPopup"
                    class="fixed top-0 left-0 w-full h-full bg-black bg-opacity-50 flex justify-center items-center hidden">
                    <div class="bg-white w-[300px] p-6 rounded-lg shadow-md">
                        <img src="{{ URL('images/success.png') }}" alt="">
                        <div class="text-green-600 font-bold font-['Inter'] mt-4 ">Success!</div>
                        <div class="text-gray-800 font-bold font-['Inter']">{{ session('success') }}</div>
                    </div>
                </div>


                <div class="mb-4">
                    <label for="name" class="text-gray-900 text-base font-semibold leading-normal mb-[30px]">Nama
                        Lengkap</label>
                    <input type="text" id="name" name="name"
                        class="w-full p-2 border rounded-md mt-[10px] placeholder:text-gray-400 text-base font-normal leading-normal"
                        placeholder="Contoh: Budiman" value="{{ session('user')['name'] }}" required>
                </div>

                <!-- Input field for profession -->
                <div class="mb-4">
                    <label for="profession"
                        class="text-gray-900 text-base font-semibold leading-normal mb-[30px]">Profesi</label>
                    <input type="text" id="profession" name="profession"
                        class="w-full p-2 border rounded-md mt-[10px] placeholder:text-gray-400 text-base font-normal leading-normal"
                        placeholder="Guru" value="{{ session('user')['profession'] }}" required>
                </div>

                <!-- Input field for school name -->
                <div class="mb-4">
                    <label for="school_name"
                        class="text-gray-900 text-base font-semibold leading-normal mb-[30px]">Sekolah</label>
                    <input type="text" id="school_name" name="school_name"
                        class="w-full p-2 border rounded-md mt-[10px] placeholder:text-gray-400 text-base font-normal leading-normal"
                        placeholder="SMPN 1 Bandung" value="{{ session('user')['school_name'] }}" required>
                </div>

                <div class="mb-4">
                    <label for="email"
                        class="text-gray-900 text-base font-semibold font-['Inter'] leading-normal mb-[30px]">Email</label>
                    <input type="email" id="email" name="email" disabled
                        class="w-full p-2 border rounded-md mt-[10px] placeholder:text-gray-400 text-base font-normal font-['Inter'] leading-normal"
                        placeholder="email@contoh.com" value="{{ session('user')['email'] }}" required>
                </div>

                <div class="flex justify-end items-end mb-4">
                    <a href="{{ route('emailVerifyChange') }}"
                        class="text-blue-600 hover:text-blue-700 font-semibold hover:font-bold">Ganti Password</a>
                </div>

                <div class="flex justify-center">
                    <button class="w-full h-12 px-6 bg-blue-600 rounded-sm justify-center items-center gap-2.5 inline-flex"
                        type="submit">
                        <img src="{{ URL('images/check-circle.svg') }}" alt="" class="w-[20px] h-[20px]">
                        <span class="text-center text-white text-base font-medium font-['Inter'] leading-normal">Simpan
                            Profil</span>
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
        document.getElementById('togglePassword').addEventListener('click', function() {
            var passwordInput = document.getElementById('password');
            var type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
        });
    </script>



@endsection
