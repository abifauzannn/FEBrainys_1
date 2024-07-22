@extends('layouts.template')

@section('title', 'Sign Up - Brainys')

@section('meta')
    <meta name="description"
        value="Brainys is an application that can help teachers / teaching staff to obtain creative ideas within the scope of administration and academic activities">
    <meta name="keyword" value="brainys, oasys, brainys oasys, register brainys, register oasys" />
    <meta property="og:title" content="Register" />
@endsection

@section('content')
    <div class="container mx-auto flex items-center justify-center mt-6 sm:h-screen sm:mt-0">
        <div class="w-[340px] sm:w-[352px] h-[675px] flex-col inline-flex">
            <a href="{{ route('login') }}">
                <img src="{{ URL('images/newicon.png') }}" alt="" class="w-[50px] h-[39px] mt-3">
                <div class="text-gray-900 text-[40px] font-bold font-['Inter'] leading-[48px] mb-7 sm:mb-12 mt-4">Registrasi
            </a>
        </div>
        @if ($errors->has('email'))
            <div class="flex items-center p-4 mb-4 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50"
                role="alert">
                <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                </svg>
                <span class="sr-only">Error!</span>
                <div>
                    <span class="font-medium">{{ $errors->first('email') }}</span>
                </div>
            </div>
        @endif

        @if ($errors->has('password'))
            <div class="flex items-center p-4 mb-4 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50"
                role="alert">
                <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 1 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                </svg>
                <span class="sr-only">Error!</span>
                <div>
                    <span class="font-medium">{{ $errors->first('password') }}</span>
                </div>
            </div>
        @endif
        <form id="registerForm" action="{{ route('registerPost') }}" method="post">
            @csrf
            <div class="mb-4">
                <label for="email"
                    class="text-gray-900 text-base font-semibold font-['Inter'] leading-normal mb-[30px]">Email</label>
                <input type="email" id="email" name="email"
                    class="w-full p-2 border rounded-md mt-[10px] placeholder:text-gray-400 text-base font-normal font-['Inter'] leading-normal"
                    placeholder="email@contoh.com" required>
                <div class="font-['Inter'] text-sm mt-2 text-gray-500">Direkomendasikan menggunakan email <b
                        class="text-black">belajar.id</b>
                </div>
            </div>
            <div class="relative mb-4">
                <label for="password"
                    class="text-gray-900 text-base font-semibold font-['Inter'] leading-normal mb-[30px]">Password</label>
                <input type="password" id="password" name="password"
                    class="w-full p-2 border rounded-md mt-[10px] placeholder:text-gray-400 text-base font-normal font-['Inter'] leading-normal"
                    placeholder="Masukan Password Anda">
                <button id="togglePassword" type="button"
                    class="absolute right-0 top-[48px] flex items-center mr-3 focus:outline-none">
                    <img src="{{ URL('images/group.svg') }}" alt="">
                </button>
                <div class="flex items-center gap-2 justify-items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" id="trueCheck"
                        class="hidden" viewBox="0 0 24 24">
                        <path fill="#4CAF50"
                            d="M9.75 19.75a.75.75 0 01-.53-.22l-5-5a.75.75 0 111.06-1.06l4.47 4.47 9.47-9.47a.75.75 0 111.06 1.06l-10 10a.75.75 0 01-.53.22z" />
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" class="mt-1 hidden"
                        id="falseCheck" viewBox="0 0 24 24">
                        <path fill="#F44336"
                            d="M12 10.586L16.95 5.636a1 1 0 111.414 1.414L13.414 12l4.95 4.95a1 1 0 01-1.414 1.414L12 13.414l-4.95 4.95a1 1 0 01-1.414-1.414L10.586 12 5.636 7.05a1 1 0 011.414-1.414L12 10.586z" />
                    </svg>


                    <div id="passwordLengthError" class="font-['Inter'] text-sm mt-1 text-gray-500">
                        Minimal password 8 karakter
                    </div>
                </div>


            </div>

            <div class="relative">
                <label for="password_confirmation"
                    class="text-gray-900 text-base font-semibold font-['Inter'] leading-normal mb-[30px]">Konfirmasi
                    Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation"
                    class="w-full p-2 border rounded-md mt-[10px] placeholder:text-gray-400 text-base font-normal font-['Inter'] leading-normal"
                    placeholder="Masukan Konfirmasi Password Anda">
                <button id="seePassword" type="button"
                    class="absolute right-0 top-[48px] flex items-center mr-3 focus:outline-none">
                    <img src="{{ URL('images/group.svg') }}" alt="">
                </button>
            </div>

            <div id="passwordMatchError" class="text-red-500 py-2 text-sm font-['Inter']"></div>

            <button type="submit" id="submitButton"
                class="w-full h-12 px-6 bg-blue-600 rounded-[50px] justify-center items-center gap-2.5 inline-flex">
                <img src="{{ URL('images/arrow.svg') }}" alt="" class="w-[20px] h-[20px]">
                <div class="text-center text-white text-base font-medium font-['Inter'] leading-normal">Sign up
                </div>
            </button>

            <button id="loadingButton" disabled type="button"
                class="h-12 px-6 py-3 bg-blue-600 rounded-[50px] justify-center items-center gap-2.5 inline-flex w-full hidden">
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
        <div class="relative flex py-7 items-center">
            <div class="flex-grow border-t border-gray-400"></div>
            <span class="flex-shrink mx-2 text-gray-400">ATAU</span>
            <div class="flex-grow border-t border-gray-400"></div>
        </div>

        <button
            class="w-full h-12 gap-[80px] pt-3 pb-[11px] bg-white rounded-[50px] shadow border border-neutral-200 flex hover:bg-slate-50 duration-300 ease-in-out transition">
            <img src="{{ URL('images/google.svg') }}" alt="" class="w-[18px] h-[18px] ml-6">
            <a href="{{ url('/login/google') }}"
                class="text-black text-opacity-50 text-base font-medium font-['Roboto']">Sign up with Google</a>
        </button>

        <div class="justify-center items-center gap-2 inline-flex py-5">
            <div class="text-center text-gray-900 text-base font-medium font-['Inter'] leading-normal">Sudah Punya
                Akun?</div>
            <div
                class="text-center text-blue-600 text-base font-medium font-['Inter'] leading-normals hover:text-blue-700 hover:font-bold">
                <a href="/">Sign In</a>
            </div>
        </div>
    </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Memfokuskan ke input email
            document.getElementById("email").focus();
        });

        document.getElementById('togglePassword').addEventListener('click', function() {
            var passwordInput = document.getElementById('password');
            var type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
        });

        document.getElementById('seePassword').addEventListener('click', function() {
            var passwordInput = document.getElementById('password_confirmation');
            var type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
        });

        document.getElementById('registerForm').addEventListener('submit', function() {
            // Show loading spinner
            document.getElementById('submitButton').classList.add('hidden');
            document.getElementById('loadingButton').classList.remove('hidden');
        });

        function checkPasswordMatch() {
            var passwordInput = document.getElementById('password');
            var confirmPasswordInput = document.getElementById('password_confirmation');
            var errorDiv = document.getElementById('passwordMatchError');
            var lengthErrorDiv = document.getElementById('passwordLengthError');
            var submitButton = document.getElementById('submitButton');
            var trueCheck = document.getElementById('trueCheck');
            var falseCheck = document.getElementById('falseCheck');

            // Periksa panjang password
            if (passwordInput.value.length < 8) {
                lengthErrorDiv.classList.remove('text-green-500');
                lengthErrorDiv.classList.add('text-red-500');
                falseCheck.classList.remove('hidden');
                trueCheck.classList.add('hidden');
            } else {
                lengthErrorDiv.classList.remove('text-red-500');
                lengthErrorDiv.classList.add('text-green-500');
                trueCheck.classList.remove('hidden');
                falseCheck.classList.add('hidden');
            }

            // Periksa kesamaan password
            if (confirmPasswordInput.value !== passwordInput.value) {
                errorDiv.textContent = 'Password tidak sesuai.';
                submitButton.disabled = true; // Nonaktifkan tombol jika password tidak sesuai
            } else if (passwordInput.value.length >= 8) {
                errorDiv.textContent = '';
                submitButton.disabled = false; // Aktifkan tombol jika password sesuai dan panjangnya cukup
            }
        }

        // Event listener untuk memanggil fungsi di atas saat input berubah
        document.getElementById('password').addEventListener('input', checkPasswordMatch);
        document.getElementById('password_confirmation').addEventListener('input', checkPasswordMatch);
    </script>
@endsection
