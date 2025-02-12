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
                    <img src="{{ URL('images/newicon.png') }}" alt="" class="w-[50px] h-[39px] mt-3" loading="lazy">
                    <div class="text-gray-900 text-[40px] font-bold font-['Inter'] leading-[48px] mb-7 sm:mb-12 mt-4">
                        Registrasi
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
                        class="focus:border-blue-600 focus:border-2 focus:outline-none w-full p-3 border rounded-md mt-[10px] placeholder:text-gray-400 text-[16px] font-normal font-['Inter'] leading-normal"
                        placeholder="email@contoh.com" required>
                    <small class="font-['Inter'] mt-2 text-gray-500">Direkomendasikan menggunakan email <b
                            class="text-black">belajar.id</b>
                    </small>
                </div>
                <div class="relative mb-4">
                    <label for="password"
                        class="text-gray-900 text-base font-semibold font-['Inter'] leading-normal mb-[30px]">Password</label>
                    <input type="password" id="password" name="password"
                        class="focus:border-blue-600 focus:border-2 focus:outline-none w-full p-3 border rounded-md mt-[10px] placeholder:text-gray-400 text-[16px] font-normal font-['Inter'] leading-normal"
                        placeholder="Masukan Password Anda">
                    <div class="flex items-center gap-2 justify-items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" id="trueCheck"
                            class="hidden" viewBox="0 0 24 24">
                            <path fill="#4CAF50"
                                d="M9.75 19.75a.75.75 0 01-.53-.22l-5-5a.75.75 0 111.06-1.06l4.47 4.47 9.47-9.47a.75.75 0 111.06 1.06l-10 10a.75.75 0 01-.53.22z" />
                        </svg>
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none"
                            class="mt-1 hidden" id="falseCheck" viewBox="0 0 24 24">
                            <path fill="#F44336"
                                d="M12 10.586L16.95 5.636a1 1 0 111.414 1.414L13.414 12l4.95 4.95a1 1 0 01-1.414 1.414L12 13.414l-4.95 4.95a1 1 0 01-1.414-1.414L10.586 12 5.636 7.05a1 1 0 011.414-1.414L12 10.586z" />
                        </svg>

                        <svg xmlns="http://www.w3.org/2000/svg" id="hidePassword"
                            class="hidden w-5 h-4 mb-2 absolute right-0 top-[48px] flex items-center mr-3 focus:outline-none cursor-pointer"
                            viewBox="0 0 576 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                            <path
                                d="M288 80c-65.2 0-118.8 29.6-159.9 67.7C89.6 183.5 63 226 49.4 256c13.6 30 40.2 72.5 78.6 108.3C169.2 402.4 222.8 432 288 432s118.8-29.6 159.9-67.7C486.4 328.5 513 286 526.6 256c-13.6-30-40.2-72.5-78.6-108.3C406.8 109.6 353.2 80 288 80zM95.4 112.6C142.5 68.8 207.2 32 288 32s145.5 36.8 192.6 80.6c46.8 43.5 78.1 95.4 93 131.1c3.3 7.9 3.3 16.7 0 24.6c-14.9 35.7-46.2 87.7-93 131.1C433.5 443.2 368.8 480 288 480s-145.5-36.8-192.6-80.6C48.6 356 17.3 304 2.5 268.3c-3.3-7.9-3.3-16.7 0-24.6C17.3 208 48.6 156 95.4 112.6zM288 336c44.2 0 80-35.8 80-80s-35.8-80-80-80c-.7 0-1.3 0-2 0c1.3 5.1 2 10.5 2 16c0 35.3-28.7 64-64 64c-5.5 0-10.9-.7-16-2c0 .7 0 1.3 0 2c0 44.2 35.8 80 80 80zm0-208a128 128 0 1 1 0 256 128 128 0 1 1 0-256z" />
                        </svg>

                        <svg xmlns="http://www.w3.org/2000/svg"
                            class=" w-5 h-4 mb-2 absolute right-0 top-[48px] flex items-center mr-3 focus:outline-none cursor-pointer"
                            id="seePassword"
                            viewBox="0 0 640 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                            <path
                                d="M38.8 5.1C28.4-3.1 13.3-1.2 5.1 9.2S-1.2 34.7 9.2 42.9l592 464c10.4 8.2 25.5 6.3 33.7-4.1s6.3-25.5-4.1-33.7L525.6 386.7c39.6-40.6 66.4-86.1 79.9-118.4c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C465.5 68.8 400.8 32 320 32c-68.2 0-125 26.3-169.3 60.8L38.8 5.1zM223.1 149.5C248.6 126.2 282.7 112 320 112c79.5 0 144 64.5 144 144c0 24.9-6.3 48.3-17.4 68.7L408 294.5c8.4-19.3 10.6-41.4 4.8-63.3c-11.1-41.5-47.8-69.4-88.6-71.1c-5.8-.2-9.2 6.1-7.4 11.7c2.1 6.4 3.3 13.2 3.3 20.3c0 10.2-2.4 19.8-6.6 28.3l-90.3-70.8zM373 389.9c-16.4 6.5-34.3 10.1-53 10.1c-79.5 0-144-64.5-144-144c0-6.9 .5-13.6 1.4-20.2L83.1 161.5C60.3 191.2 44 220.8 34.5 243.7c-3.3 7.9-3.3 16.7 0 24.6c14.9 35.7 46.2 87.7 93 131.1C174.5 443.2 239.2 480 320 480c47.8 0 89.9-12.9 126.2-32.5L373 389.9z" />
                        </svg>


                        <small id="passwordLengthError" class="font-['Inter'] mt-1 text-gray-500">
                            Minimal password 8 karakter
                        </small>
                    </div>
                </div>

                <div class="relative">
                    <label for="password_confirmation"
                        class="text-gray-900 text-base font-semibold font-['Inter'] leading-normal mb-[30px]">Konfirmasi
                        Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation"
                        class="focus:border-blue-600 focus:border-2 focus:outline-none w-full p-3 border rounded-md mt-[10px] placeholder:text-gray-400 text-[16px] font-normal font-['Inter'] leading-normal"
                        placeholder="Masukan Konfirmasi Password Anda">
                    {{-- <button id="seePassword" type="button"
                        class="absolute right-0 top-[48px] flex items-center mr-3 focus:outline-none">
                        <img src="{{ URL('images/group.svg') }}" alt="" loading="lazy">
                    </button> --}}

                    <svg xmlns="http://www.w3.org/2000/svg" id="hideConfirm"
                        class="hidden w-5 h-4 mb-2 absolute right-0 top-[48px] flex items-center mr-3 focus:outline-none cursor-pointer"
                        viewBox="0 0 576 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                        <path
                            d="M288 80c-65.2 0-118.8 29.6-159.9 67.7C89.6 183.5 63 226 49.4 256c13.6 30 40.2 72.5 78.6 108.3C169.2 402.4 222.8 432 288 432s118.8-29.6 159.9-67.7C486.4 328.5 513 286 526.6 256c-13.6-30-40.2-72.5-78.6-108.3C406.8 109.6 353.2 80 288 80zM95.4 112.6C142.5 68.8 207.2 32 288 32s145.5 36.8 192.6 80.6c46.8 43.5 78.1 95.4 93 131.1c3.3 7.9 3.3 16.7 0 24.6c-14.9 35.7-46.2 87.7-93 131.1C433.5 443.2 368.8 480 288 480s-145.5-36.8-192.6-80.6C48.6 356 17.3 304 2.5 268.3c-3.3-7.9-3.3-16.7 0-24.6C17.3 208 48.6 156 95.4 112.6zM288 336c44.2 0 80-35.8 80-80s-35.8-80-80-80c-.7 0-1.3 0-2 0c1.3 5.1 2 10.5 2 16c0 35.3-28.7 64-64 64c-5.5 0-10.9-.7-16-2c0 .7 0 1.3 0 2c0 44.2 35.8 80 80 80zm0-208a128 128 0 1 1 0 256 128 128 0 1 1 0-256z" />
                    </svg>

                    <svg xmlns="http://www.w3.org/2000/svg"
                        class=" w-5 h-4 mb-2 absolute right-0 top-[48px] flex items-center mr-3 focus:outline-none cursor-pointer"
                        id="seeConfirm"
                        viewBox="0 0 640 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                        <path
                            d="M38.8 5.1C28.4-3.1 13.3-1.2 5.1 9.2S-1.2 34.7 9.2 42.9l592 464c10.4 8.2 25.5 6.3 33.7-4.1s6.3-25.5-4.1-33.7L525.6 386.7c39.6-40.6 66.4-86.1 79.9-118.4c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C465.5 68.8 400.8 32 320 32c-68.2 0-125 26.3-169.3 60.8L38.8 5.1zM223.1 149.5C248.6 126.2 282.7 112 320 112c79.5 0 144 64.5 144 144c0 24.9-6.3 48.3-17.4 68.7L408 294.5c8.4-19.3 10.6-41.4 4.8-63.3c-11.1-41.5-47.8-69.4-88.6-71.1c-5.8-.2-9.2 6.1-7.4 11.7c2.1 6.4 3.3 13.2 3.3 20.3c0 10.2-2.4 19.8-6.6 28.3l-90.3-70.8zM373 389.9c-16.4 6.5-34.3 10.1-53 10.1c-79.5 0-144-64.5-144-144c0-6.9 .5-13.6 1.4-20.2L83.1 161.5C60.3 191.2 44 220.8 34.5 243.7c-3.3 7.9-3.3 16.7 0 24.6c14.9 35.7 46.2 87.7 93 131.1C174.5 443.2 239.2 480 320 480c47.8 0 89.9-12.9 126.2-32.5L373 389.9z" />
                    </svg>



                </div>

                <div id="passwordMatchError" class="text-red-500 py-2 text-sm font-['Inter']"></div>

                <button type="submit" id="submitButton"
                    class="w-full h-12 px-6 bg-blue-600 rounded-[50px] justify-center items-center gap-2.5 inline-flex">
                    <img src="{{ URL('images/arrow.svg') }}" alt="" class="w-[20px] h-[20px]" loading="lazy">
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
                <img src="{{ URL('images/google.svg') }}" alt="" class="w-[18px] h-[18px] ml-6" loading="lazy">
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


            document.getElementById('seePassword').addEventListener('click', function() {
                var passwordInput = document.getElementById('password');
                var type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);
                document.getElementById('seePassword').classList.add('hidden');
                document.getElementById('hidePassword').classList.remove('hidden');
            });

            document.getElementById('hidePassword').addEventListener('click', function() {
                var passwordInput = document.getElementById('password');
                var type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);
                document.getElementById('hidePassword').classList.add('hidden');
                document.getElementById('seePassword').classList.remove('hidden');
            });

            document.getElementById('seeConfirm').addEventListener('click', function() {
                var passwordInput = document.getElementById('password_confirmation');
                var type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);
                document.getElementById('seeConfirm').classList.add('hidden');
                document.getElementById('hideConfirm').classList.remove('hidden');
            });

            document.getElementById('hideConfirm').addEventListener('click', function() {
                var passwordInput = document.getElementById('password_confirmation');
                var type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);
                document.getElementById('hideConfirm').classList.add('hidden');
                document.getElementById('seeConfirm').classList.remove('hidden');
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
