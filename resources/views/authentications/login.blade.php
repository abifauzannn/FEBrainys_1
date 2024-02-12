@extends('layouts.template')

@section('title', 'Log In Page')

@section('content')
    <div class="container mx-auto flex items-center justify-center mt-10 sm:h-screen sm:mt-0 xl:gap-48 lg:gap-20">
        <div class="hidden lg:block">
            <img class="w-[612px] h-[612px] object-cover" src="{{ URL('images/onboarding.png') }}" />
        </div>
        <div class="w-full px-3 sm:w-[352px] h-[515px] flex flex-col">
            <div class="justify-center items-center gap-4 inline-flex mb-12">
                <img src="{{ URL('images/Logo.svg') }}" alt="" class="w-[50px] h-[39px]">
                <div class="text-center text-gray-900 text-2xl font-bold font-['Inter'] leading-normal">Brainys
                </div>
            </div>
            <div>
                <form action="{{ route('login') }}" method="post">
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
                            placeholder="masukan password anda">
                        <button id="togglePassword" type="button"
                            class="absolute right-0 top-[48px] flex items-center mr-3 focus:outline-none">
                            <img src="{{ URL('images/group.svg') }}" alt="">
                        </button>
                    </div>


                    @if ($errors->has('email'))
                        <div class="flex items-center p-4 mb-4 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50"
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

                    <button type="submit"
                        class="w-full h-12 px-6 py-3 bg-blue-600 rounded-[50px] justify-center items-center gap-2.5 inline-flex">
                        <img src="{{ URL('images/arrow.svg') }}" alt="" class="w-[20px] h-[20px]">
                        <div class="text-center text-white text-base font-medium font-['Inter'] leading-normal">Login
                        </div>
                    </button>

                    <div class="flex justify-center mt-5 font-['Inter']">
                        <a href="{{ route('emailForget') }}" class="font-bold text-blue-500">Lupa Password ?</a>
                    </div>
                </form>
            </div>
            <div class="relative flex py-[44px] items-center">
                <div class="flex-grow border-t border-gray-400"></div>
                <span class="flex-shrink mx-4 text-gray-400">Atau</span>
                <div class="flex-grow border-t border-gray-400"></div>
            </div>

            <button type="submit"
                class="w-full h-12 inline-flex gap-[92px] pt-3 pb-[11px] bg-white rounded-[50px] shadow border border-neutral-200 mb-8">
                <img src="{{ URL('images/google.svg') }}" alt="" class="w-[18px] h-[18px] ml-6">
                <a href="{{ url('/login/google') }}"
                    class="text-black text-opacity-50 text-base font-medium font-['Roboto']">Sign in with Google</a>
            </button>

            <div class="h-6 justify-center items-center gap-2 inline-flex">
                <div class="text-center text-gray-900 text-base font-medium font-['Inter'] leading-normal">Belum punya
                    akun?</div>
                <div class="text-center text-blue-600 text-base font-medium font-['Inter'] leading-normal"><a
                        href="{{ route('showSignupForm') }}">Register</a>
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
    </script>
@endsection
