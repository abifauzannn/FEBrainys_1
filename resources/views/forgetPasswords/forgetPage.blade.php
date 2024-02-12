@extends('layouts.template')

@section('title', 'Change Password')

@section('content')




    <div class="w-full container mx-auto px-4 sm:px-10 py-9">

        <div class="justify-center items-center gap-4 inline-flex mb-5">
            <img src="{{ URL('images/Logo.svg') }}" alt="" class="w-[50px] h-[39px]">
            <div class="text-center text-gray-900 text-[18px] font-bold font-['Inter']">Brainys
            </div>
        </div>

        <hr>
        <br>

        <a href="{{ route('emailVerify') }}">
            <div class="w-[90px] h-6 justify-start items-end gap-1 inline-flex mb-6">
                <img src="{{ URL('images/back.svg') }}" alt="" class="w-6 h-6">
                <div class="text-black text-base font-semibold font-['Inter']">Kembali</div>
            </div>
        </a>


        <div class="w-full sm:w-[1170px] h-[60px] flex-col justify-start items-start gap-2 inline-flex">
            <div class="text-gray-900 text-2xl font-semibold font-['Inter'] leading-[30px]">Change Password</div>
            <div class="w-full sm:w-[549px] text-gray-500 text-sm font-normal font-['Inter'] leading-snug">Lorem ipsum dolor
                sit amet,
                consectetur adipiscing elit. Cras ultrices lectus sem.</div>
            @if ($errors->has('error'))
                <div class="flex items-center p-4 mb-4 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 dark:border-red-800"
                    role="alert">
                    <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                    </svg>
                    <span class="sr-only">Info</span>
                    <div>
                        <span class="font-medium">{{ $errors->first('error') }}</span>
                    </div>
                </div>
            @endif
        </div>

        <div class="container mx-auto flex items-center justify-center mt-[51px] flex-col">

            @if (session('success'))
                <div class="flex items-center p-4 mb-4 text-sm text-green-800 border border-green-300 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400 dark:border-green-800"
                    role="alert">
                    <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                    </svg>
                    <span class="sr-only">Info</span>
                    <div>
                        <span class="font-medium">{{ session('success') }} !</span>
                    </div>
                </div>
            @endif

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

            <form class="w-full sm:w-[500px]" action="{{ route('resetPassword') }}" method="post">
                @csrf

                <div class="relative mb-4">
                    <label for="new_password"
                        class="text-gray-900 text-base font-medium font-['Inter'] leading-normal mb-[30px]">Password
                        Baru:</label>
                    <input type="password" id="new_password" name="new_password"
                        class="w-full p-2 border rounded-md mt-[10px] text-gray-400 text-base font-normal font-['Inter'] leading-normal mr-5"
                        placeholder="Masukan Password Anda">
                    <button id="togglePassword" type="button"
                        class="absolute right-0 top-[48px] flex items-center mr-3 focus:outline-none">
                        <img src="{{ URL('images/group.svg') }}" alt="">
                    </button>
                </div>

                <div class="relative mb-4">
                    <label for="new_password_confirmation"
                        class="text-gray-900 text-base font-medium font-['Inter'] leading-normal mb-[30px]">Konfirmasi
                        Password Baru</label>
                    <input type="password" id="new_password_confirmation" name="new_password_confirmation"
                        class="w-full p-2 border rounded-md mt-[10px] text-gray-400 text-base font-normal font-['Inter'] leading-normal mr-5"
                        placeholder="Masukan Konfirmasi Password Anda">
                    <button id="seePassword" type="button"
                        class="absolute right-0 top-[48px] flex items-center mr-3 focus:outline-none">
                        <img src="{{ URL('images/group.svg') }}" alt="">
                    </button>
                </div>

                <div class="items-center flex justify-center py-4">
                    <button type="submit"
                        class="w-auto sm:w-[179px] h-12 px-6 py-3 bg-blue-600 rounded-sm justify-center    items-center gap-2.5 inline-flex">
                        <img src="{{ URL('images/check-circle.svg') }}" alt="" class="w-[20px] h-[20px]">
                        <div class="text-center text-white text-base font-medium font-['Inter'] leading-normal">Simpan Perubahan
                        </div>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('togglePassword').addEventListener('click', function() {
            var passwordInput = document.getElementById('new_password');
            var type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
        });
        document.getElementById('seePassword').addEventListener('click', function() {
            var passwordInput = document.getElementById('new_password_confirmation');
            var type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
        });
    </script>



@endsection