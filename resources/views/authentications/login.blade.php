@extends('layouts.login')



@section('title', 'Log In Page - Brainys')

@section('content')
    @if (session('user'))
        <script></script>
        window.location.href = "{{ route('dashboard') }}";
        </script>
    @endif
    <div class="container mx-auto flex items-center justify-around mt-10 sm:h-screen sm:mt-0">
        <div class="hidden lg:block">
            <img class="w-[500px] h-[515px] object-cover" src="{{ URL('images/newonboarding.png') }}" alt="onBoarding" />
        </div>
        <div class="w-full px-5 sm:w-[50%] lg:w-[28%] flex flex-col">
            <div class="justify-center items-center gap-2 inline-flex mb-9">
                <img src="{{ URL('images/newlogo.png') }}" alt="logo" class="w-[180px] object-cover">
            </div>
            <div>
                <form action="{{ route('login') }}" method="post" id="loginForm">

                    @csrf
                    <x-form-input id="email" name="email" type="email" label="Email"
                        placeholder="email@contoh.com" />


                    <div class="relative mb-4">
                        <label for="password"
                            class="text-gray-900 text-base font-semibold font-['Inter'] leading-normal mb-[30px]">Password</label>
                        <input type="password" id="password" name="password"
                            class="w-full p-3 border rounded-md mt-[10px] border-gray-300 placeholder:text-gray-400 text-base font-normal font-['Inter'] leading-normal focus:border-blue-600 focus:border-2 focus:outline-none"
                            placeholder="masukan password anda">
                        <div class="flex items-center gap-2 justify-items-center">

                            <svg xmlns="http://www.w3.org/2000/svg" id="hidePassword" fill="outline"
                                class="hidden w-5 h-4 mb-2 absolute right-0 top-[50px] flex items-center mr-3 focus:outline-none cursor-pointer"
                                viewBox="0 0 576 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                <path
                                    d="M288 80c-65.2 0-118.8 29.6-159.9 67.7C89.6 183.5 63 226 49.4 256c13.6 30 40.2 72.5 78.6 108.3C169.2 402.4 222.8 432 288 432s118.8-29.6 159.9-67.7C486.4 328.5 513 286 526.6 256c-13.6-30-40.2-72.5-78.6-108.3C406.8 109.6 353.2 80 288 80zM95.4 112.6C142.5 68.8 207.2 32 288 32s145.5 36.8 192.6 80.6c46.8 43.5 78.1 95.4 93 131.1c3.3 7.9 3.3 16.7 0 24.6c-14.9 35.7-46.2 87.7-93 131.1C433.5 443.2 368.8 480 288 480s-145.5-36.8-192.6-80.6C48.6 356 17.3 304 2.5 268.3c-3.3-7.9-3.3-16.7 0-24.6C17.3 208 48.6 156 95.4 112.6zM288 336c44.2 0 80-35.8 80-80s-35.8-80-80-80c-.7 0-1.3 0-2 0c1.3 5.1 2 10.5 2 16c0 35.3-28.7 64-64 64c-5.5 0-10.9-.7-16-2c0 .7 0 1.3 0 2c0 44.2 35.8 80 80 80zm0-208a128 128 0 1 1 0 256 128 128 0 1 1 0-256z" />
                            </svg>

                            <svg xmlns="http://www.w3.org/2000/svg" fill="outline"
                                class=" w-5 h-4  absolute right-0 top-[50px] flex items-center mr-3 focus:outline-none cursor-pointer"
                                id="seePassword"
                                viewBox="0 0 640 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                <path
                                    d="M38.8 5.1C28.4-3.1 13.3-1.2 5.1 9.2S-1.2 34.7 9.2 42.9l592 464c10.4 8.2 25.5 6.3 33.7-4.1s6.3-25.5-4.1-33.7L525.6 386.7c39.6-40.6 66.4-86.1 79.9-118.4c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C465.5 68.8 400.8 32 320 32c-68.2 0-125 26.3-169.3 60.8L38.8 5.1zM223.1 149.5C248.6 126.2 282.7 112 320 112c79.5 0 144 64.5 144 144c0 24.9-6.3 48.3-17.4 68.7L408 294.5c8.4-19.3 10.6-41.4 4.8-63.3c-11.1-41.5-47.8-69.4-88.6-71.1c-5.8-.2-9.2 6.1-7.4 11.7c2.1 6.4 3.3 13.2 3.3 20.3c0 10.2-2.4 19.8-6.6 28.3l-90.3-70.8zM373 389.9c-16.4 6.5-34.3 10.1-53 10.1c-79.5 0-144-64.5-144-144c0-6.9 .5-13.6 1.4-20.2L83.1 161.5C60.3 191.2 44 220.8 34.5 243.7c-3.3 7.9-3.3 16.7 0 24.6c14.9 35.7 46.2 87.7 93 131.1C174.5 443.2 239.2 480 320 480c47.8 0 89.9-12.9 126.2-32.5L373 389.9z" />
                            </svg>
                        </div>
                    </div>


                    @if ($errors->has('email'))
                        <div class="flex items-center p-2 mb-2 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50"
                            role="alert">
                            <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                            </svg>
                            <span class="sr-only">Error!</span>
                            <div>
                                <span class="font-medium">{{ $errors->first('email') }}</span>
                            </div>
                        </div>
                    @endif

                    @if (session('success'))
                        <div class="flex items-center p-4 mb-4 text-sm text-green-800 border border-green-300 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400 dark:border-green-800"
                            role="alert">
                            <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                            </svg>
                            <span class="sr-only">Info</span>
                            <div>
                                <span class="font-medium">{{ session('success') }} !</span> Silahkan Login
                            </div>
                        </div>
                    @endif
                    <div class="flex justify-center">
                        <button id="submitButton"
                            class="w-full h-12 px-6 bg-blue-600 rounded-[50px] justify-center items-center gap-2.5 inline-flex"
                            type="submit">
                            <img src="{{ URL('images/arrow.svg') }}" alt="" class="w-[20px] h-[20px]"
                                id="checkIcon">
                            <span id="submitButtonText"
                                class="text-center text-white text-base font-['Inter'] leading-normal font-semibold">Login</span>
                            <div id="loadingSpinner" class="hidden ml-2">
                                <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                        stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor"
                                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                    </path>
                                </svg>
                            </div>
                        </button>
                    </div>

                    <div class="flex justify-center mt-5 font-['Inter']">
                        <a href="{{ route('emailForget') }}" class="font-bold text-blue-500 hover:text-blue-700">Lupa
                            Password ?</a>
                    </div>
                </form>
            </div>
            <div class="relative flex py-5 lg:py-4 items-center">
                <div class="flex-grow border-t border-gray-400"></div>
                <span class="flex-shrink mx-2 text-gray-400">ATAU</span>
                <div class="flex-grow border-t border-gray-400"></div>
            </div>

            <button type="submit"
                class="w-full h-12 inline-flex gap-[80px] pt-3 pb-[11px] bg-white rounded-[50px] shadow border border-neutral-200 mb-8 hover:bg-slate-50 duration-300 ease-in-out transition">
                <img src="{{ URL('images/google.svg') }}" alt="" class="w-[18px] h-[18px] ml-6">
                <a href="{{ url('/login/google') }}"
                    class="text-black text-opacity-50 text-base font-medium font-['Roboto']">Sign
                    in with Google</a>
            </button>


            <div class="h-6 justify-center items-center gap-2 inline-flex">
                <div class="text-center text-gray-900 text-base font-medium font-['Inter'] leading-normal">Belum punya
                    akun?</div>
                <div
                    class="text-center text-blue-600 text-base font-medium font-['Inter'] leading-normal hover:text-blue-700 hover:font-bold flex flex-col">
                    <a href="{{ route('showSignupForm') }}">Register</a>
                </div>
            </div>

            <div class=" justify-center items-center inline-flex pt-4">
                <div>
                    <img src="{{ URL('images/whatsapp.png') }}" alt="logo" class="w-5 h-5 object-cover mr-2">
                </div>
                <div
                    class="text-center text-blue-600 text-base font-medium font-['Inter'] leading-normal hover:text-blue-700 hover:font-bold flex flex-col">
                    <a href="https://wa.link/z2edgq" target="_blank">Butuh Bantuan ?</a>
                </div>
            </div>
        </div>
    </div>








    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Memfokuskan ke input email
            document.getElementById("email").focus();
            document.getElementById("loadingSpinner").classList.add('hidden');
        });

        const submitButton = document.getElementById("submitButton");
        const loadingIndicator = document.getElementById("loadingButton");
        const buttonText = document.getElementById("buttonText");

        document.getElementById('loginForm').addEventListener('submit', function() {
            // Show loading spinner
            document.getElementById('submitButtonText').classList.add('hidden');
            document.getElementById('checkIcon').classList.add('hidden');
            document.getElementById('loadingSpinner').classList.remove('hidden');
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
    </script>
@endsection
