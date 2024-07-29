@extends('layouts.login')



@section('title', 'Log In Page - Brainys')

@section('content')


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


                    <x-form-input id="password" name="password" type="password" label="Password"
                        placeholder="masukan password anda" />


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
    </script>
@endsection
