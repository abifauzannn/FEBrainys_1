@extends('layouts.template')

@section('title', 'Sign Up')

@section('content')

    <div class="container mx-auto flex items-center justify-center mt-6 sm:h-screen sm:mt-0">
        <div class="w-[340px] sm:w-[352px] h-[675px] flex-col inline-flex">
            <a href="{{ route('login') }}">
                <img src="{{ URL('images/Logo.svg') }}" alt="" class="w-[50px] h-[39px]">
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
                            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                    </svg>
                    <span class="sr-only">Error!</span>
                    <div>
                        <span class="font-medium">{{ $errors->first('password') }}</span>
                    </div>
                </div>
            @endif
            <form action="{{ route('registerPost') }}" method="post">
                @csrf
                <div class="mb-4">
                    <label for="email"
                        class="text-gray-900 text-base font-medium font-['Inter'] leading-normal mb-[30px]">Email</label>
                    <input type="email" id="email" name="email"
                        class="w-full p-2 border rounded-md mt-[10px] text-gray-400 text-base font-normal font-['Inter'] leading-normal"
                        placeholder="email@contoh.com" required>
                </div>
                <div class="relative mb-4">
                    <label for="password"
                        class="text-gray-900 text-base font-medium font-['Inter'] leading-normal mb-[30px]">Password:</label>
                    <input type="password" id="password" name="password"
                        class="w-full p-2 border rounded-md mt-[10px] text-gray-400 text-base font-normal font-['Inter'] leading-normal"
                        placeholder="Masukan Password Anda">
                    <button id="togglePassword" type="button"
                        class="absolute right-0 top-[48px] flex items-center mr-3 focus:outline-none">
                        <img src="{{ URL('images/group.svg') }}" alt="">
                    </button>
                </div>

                <div class="relative mb-4">
                    <label for="password_confirmation"
                        class="text-gray-900 text-base font-medium font-['Inter'] leading-normal mb-[30px]">Konfirmasi
                        Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation"
                        class="w-full p-2 border rounded-md mt-[10px] text-gray-400 text-base font-normal font-['Inter'] leading-normal"
                        placeholder="Masukan Konfirmasi Password Anda">
                    <button id="seePassword" type="button"
                        class="absolute right-0 top-[48px] flex items-center mr-3 focus:outline-none">
                        <img src="{{ URL('images/group.svg') }}" alt="">
                    </button>
                </div>
                <div id="passwordMatchError" class="text-red-700"></div>

                <button type="submit" id="submitBtn"
                    class="w-full h-12 px-6 py-3 bg-blue-600 rounded-[50px] justify-center items-center gap-2.5 inline-flex">
                    <img src="{{ URL('images/arrow.svg') }}" alt="" class="w-[20px] h-[20px]">
                    <div class="text-center text-white text-base font-medium font-['Inter'] leading-normal">Sign up
                    </div>
                </button>

                <div class="flex justify-center mt-5 font-['Inter']">
                    <a href="{{ route('emailForget') }}" class="font-bold text-blue-500 hover:text-blue-700">Lupa Password ?</a>
                </div>
            </form>
            <div class="relative flex py-[44px] items-center">
                <div class="flex-grow border-t border-gray-400"></div>
                <span class="flex-shrink mx-4 text-gray-400">Atau</span>
                <div class="flex-grow border-t border-gray-400"></div>
            </div>
            <button
                class="w-full h-12 inline-flex gap-[92px] pt-3 pb-[11px] bg-white rounded-[50px] shadow border border-neutral-200 mb-8">
                <img src="{{ URL('images/google.svg') }}" alt="" class="w-[18px] h-[18px] ml-6">
                <div class="text-black text-opacity-50 text-base font-medium font-['Roboto']">Sign in with Google</div>
            </button>

            <div class="h-6 justify-center items-center gap-2 inline-flex">
                <div class="text-center text-gray-900 text-base font-medium font-['Inter'] leading-normal">Sudah Punya
                    Akun?</div>
                <div class="text-center text-blue-600 text-base font-medium font-['Inter'] leading-normal"><a
                        href="/">Sign In</a>
                </div>
            </div>
        </div>
    </div>

    <script>
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

        function checkPasswordMatch() {
            var passwordInput = document.getElementById('password');
            var confirmPasswordInput = document.getElementById('password_confirmation');
            var errorDiv = document.getElementById('passwordMatchError');
            var submitButton = document.getElementById('submitBtn'); // Gantilah 'submitBtn' dengan ID tombol submit Anda

            // Periksa kesamaan password
            if (confirmPasswordInput.value !== passwordInput.value) {
                errorDiv.textContent = 'Password tidak sesuai.';
                submitButton.disabled = true; // Nonaktifkan tombol jika password tidak sesuai
            } else {
                errorDiv.textContent = '';
                submitButton.disabled = false; // Aktifkan tombol jika password sesuai
            }
        }

        // Event listener untuk memanggil fungsi di atas saat input berubah
        document.getElementById('password').addEventListener('input', checkPasswordMatch);
        document.getElementById('password_confirmation').addEventListener('input', checkPasswordMatch);
    </script>
@endsection
