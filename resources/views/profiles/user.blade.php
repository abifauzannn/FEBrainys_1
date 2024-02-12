@extends('layouts.template')

@section('title', 'User Profile')

@section('content')
    <x-nav></x-nav>



    <div class="container mx-auto px-3 sm:px-10 py-6 sm:py-9">
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


        <div class="w-full sm:w-[1170px] h-auto sm:h-[60px] flex flex-col justify-start items-start gap-2">
            <div class="text-gray-900 text-2xl font-semibold font-['Inter'] leading-[30px]">Profil Pengguna</div>
            <div class="w-full sm:w-[549px] text-gray-500 text-sm font-normal font-['Inter'] leading-snug">Lorem ipsum dolor
                sit amet, consectetur adipiscing elit. Cras ultrices lectus sem.</div>
        </div>


        <div class="container mx-auto flex flex-col items-center justify-center mt-[51px]">
            <img src="{{ URL('images/ta.png') }}" alt="" class="mb-[48px]">

            <form class="w-full max-w-md">
                <div class="mb-4">
                    <label for="nama_lengkap" class="text-gray-900 text-base font-medium font-['Inter'] leading-normal mb-[30px]">Nama Lengkap</label>
                    <input type="text" id="nama_lengkap" name="nama_lengkap" class="w-full p-2 border rounded-md mt-[10px] text-gray-400 text-base font-normal font-['Inter'] leading-normal" placeholder="Contoh: Budiman" value="{{ session('user')['name'] }}" required>
                </div>

                <div class="mb-4">
                    <label for="profesi" class="text-gray-900 text-base font-medium font-['Inter'] leading-normal mb-[30px]">Profesi</label>
                    <input type="text" id="profesi" name="profesi" class="w-full p-2 border rounded-md mt-[10px] text-gray-400 text-base font-normal font-['Inter'] leading-normal" placeholder="Guru" value="{{ session('user')['profession'] }}" required>
                </div>

                <div class="mb-4">
                    <label for="sekolah" class="text-gray-900 text-base font-medium font-['Inter'] leading-normal mb-[30px]">Sekolah</label>
                    <input type="text" id="sekolah" name="sekolah" class="w-full p-2 border rounded-md mt-[10px] text-gray-400 text-base font-normal font-['Inter'] leading-normal" placeholder="SMPN 1 Bandung" value="{{ session('user')['school_name'] }}" required>
                </div>

                <div class="mb-4">
                    <label for="email" class="text-gray-900 text-base font-medium font-['Inter'] leading-normal mb-[30px]">Email</label>
                    <input type="email" id="email" name="email" class="w-full p-2 border rounded-md mt-[10px] text-gray-400 text-base font-normal font-['Inter'] leading-normal" placeholder="email@contoh.com" value="{{ session('user')['email'] }}" required>
                </div>

                <div class="relative mb-4">
                    <label for="password" class="text-gray-900 text-base font-medium font-['Inter'] leading-normal mb-[30px]">Password:</label>
                    <input type="password" id="password" name="password" class="w-full p-2 border rounded-md mt-[10px] text-gray-400 text-base font-normal font-['Inter'] leading-normal" placeholder="Masukkan Password Anda">
                    <button id="togglePassword" type="button" class="absolute right-0 top-[48px] flex items-center mr-3 focus:outline-none">
                        <img src="{{ URL('images/group.svg') }}" alt="">
                    </button>
                </div>

                <div class="flex justify-end items-end mb-4">
                    <a href="{{ route('emailVerifyChange') }}" class="text-blue-600">Ganti Password</a>
                </div>

                <div class="flex justify-center">
                    <button class="w-full h-12 px-6 bg-blue-600 rounded-sm justify-center items-center gap-2.5 inline-flex">
                        <img src="{{ URL('images/check-circle.svg') }}" alt="" class="w-[20px] h-[20px]">
                        <span class="text-center text-white text-base font-medium font-['Inter'] leading-normal">Simpan Profil</span>
                    </button>
                </div>
            </form>
        </div>

    </div>

    <script>
        document.getElementById('togglePassword').addEventListener('click', function() {
            var passwordInput = document.getElementById('password');
            var type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
        });
    </script>



@endsection
