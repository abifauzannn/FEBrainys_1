@extends('layouts.template')

@section('title', 'Log In Page - Brainys')

@section('content')
    <div class="container mx-auto flex items-center justify-around mt-10 sm:h-screen sm:mt-0">
        <div class="hidden lg:block">
            <img class="w-[500px] h-[515px] object-cover" src="{{ URL('images/onboarding.png') }}" alt="onBoarding" />
        </div>
        <div class="w-full px-6 sm:w-[352px] h-[500px] flex flex-col">
            <div class="justify-center items-center gap-2 inline-flex mb-12">
                <img src="{{ URL('images/newlogo.png') }}" alt="logo" class="w-[140px] h-[39px]">
            </div>
            <div>
                <form action="{{ route('login') }}" method="post">
                    @csrf
                    <div class="mb-4">
                        <label for="email"
                            class="text-gray-900 text-base font-['Inter'] leading-normal mb-[30px] font-semibold">Email</label>
                        <input type="email" id="email" name="email"
                            class="w-full p-2 border rounded-md mt-[10px] placeholder:text-gray-400 text-base font-normal font-['Inter'] leading-normal"
                            placeholder="email@contoh.com" required>
                    </div>

                    <div class="relative mb-4">
                        <label for="password"
                            class="text-gray-900 text-base font-['Inter'] leading-normal mb-[30px] font-semibold">Password</label>
                        <input type="password" id="password" name="password"
                            class="w-full p-2 border rounded-md mt-[10px] placeholder:text-gray-400 text-base font-normal font-['Inter'] leading-normal"
                            placeholder="masukan password anda" required>
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


                    <button id="submitButton" type="submit"
                        class="w-full h-12 px-6 py-3 bg-blue-600 rounded-[50px] justify-center items-center gap-2.5 inline-flex hover:bg-blue-700 duration-300 ease-in-out transition">
                        <img src="{{ URL('images/arrow.svg') }}" alt="" class="w-[20px] h-[20px]">
                        <div id="buttonText"
                            class="text-center text-white text-base font-semibold font-['Inter'] leading-normal">Login</div>
                    </button>

                    <button id="loadingButton" disabled type="button"
                        class="h-12 px-6 py-3 bg-blue-600 rounded-[50px] justify-center items-center gap-2.5 inline-flex w-full"
                        style="display: none;">
                        <svg aria-hidden="true" role="status" class="inline w-4 h-4 me-3 text-white animate-spin"
                            viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                fill="#E5E7EB" />
                            <path
                                d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                fill="currentColor" />
                        </svg>
                    </button>

                    <div class="flex justify-center mt-5 font-['Inter']">
                        <a href="{{ route('emailForget') }}" class="font-bold text-blue-500 hover:text-blue-700">Lupa
                            Password ?</a>
                    </div>
                </form>
            </div>
            <div class="relative flex py-7 items-center">
                <div class="flex-grow border-t border-gray-400"></div>
                <span class="flex-shrink mx-2 text-gray-400">ATAU</span>
                <div class="flex-grow border-t border-gray-400"></div>
            </div>

            <button type="submit"
                class="w-full h-12 inline-flex gap-[80px] pt-3 pb-[11px] bg-white rounded-[50px] shadow border border-neutral-200 mb-8 hover:bg-slate-50 duration-300 ease-in-out transition">
                <img src="{{ URL('images/google.svg') }}" alt="" class="w-[18px] h-[18px] ml-6">
                <a href="{{ url('/login/google') }}"
                    class="text-black text-opacity-50 text-base font-medium font-['Roboto']">Sign in with Google</a>
            </button>


            <div class="h-6 justify-center items-center gap-2 inline-flex">
                <div class="text-center text-gray-900 text-base font-medium font-['Inter'] leading-normal">Belum punya
                    akun?</div>
                <div
                    class="text-center text-blue-600 text-base font-medium font-['Inter'] leading-normal hover:text-blue-700 hover:font-bold">
                    <a href="{{ route('showSignupForm') }}">Register</a>
                </div>
            </div>
        </div>
    </div>

    {{-- <div id="otpModal"
        class="fixed inset-0 z-50 overflow-auto bg-black bg-opacity-50 flex justify-center items-center hidden">
        <div class="bg-white rounded-lg p-8 max-w-md relative">
            <span id="closeOtpModal" class="absolute top-0 right-0 p-4 cursor-pointer">&times;</span>
            <p class="text-gray-900 text-base font-['Inter'] leading-normal font-semibold mt-[30px]">Masukkan
                Invitation
                Code Anda</p>
            <div class="flex justify-center mt-4 space-x-2">
                <input type="text" id="otp1"
                    class="w-10 p-2 font-bold rounded-md text-center text-sky-600 text-xl placeholder:font-medium font-['Inter'] leading-normal focus:outline-none focus:border-none"
                    maxlength="1" autofocus>
                <input type="text" id="otp2"
                    class="w-10 p-2 font-bold rounded-md text-center text-sky-600 text-xl placeholder:font-medium font-['Inter'] leading-normal focus:outline-none focus:border-none"
                    maxlength="1">
                <input type="text" id="otp3"
                    class="w-10 p-2 font-bold rounded-md text-center text-sky-600 text-xl placeholder:font-medium font-['Inter'] leading-normal focus:outline-none focus:border-none"
                    maxlength="1">
                <input type="text" id="otp4"
                    class="w-10 p-2 font-bold rounded-md text-center text-sky-600 text-xl placeholder:font-medium font-['Inter'] leading-normal focus:outline-none focus:border-none"
                    maxlength="1">
                <input type="text" id="otp5"
                    class="w-10 p-2 font-bold rounded-md text-center text-sky-600 text-xl placeholder:font-medium font-['Inter'] leading-normal focus:outline-none focus:border-none"
                    maxlength="1">
            </div>
            <button id="submitOtpButton"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-4 font-['Inter']">Submit</button>
        </div>
    </div> --}}





    <script>
        // document.addEventListener("DOMContentLoaded", function() {
        //     const otpModal = document.getElementById("otpModal");
        //     const emailInput = document.getElementById("email");

        //     // Tampilkan modal saat dokumen dimuat dan fokuskan pada input OTP
        //     otpModal.classList.remove("hidden");
        //     document.getElementById("otp1").focus();

        //     // Event listener untuk menutup modal saat tombol close di klik
        //     document.getElementById("closeOtpModal").addEventListener("click", function() {
        //         otpModal.classList.add("hidden");
        //         emailInput.focus();
        //     });

        //     // Event listener untuk tombol submit modal
        //     document.getElementById("submitOtpButton").addEventListener("click", function() {
        //         otpModal.classList.add("hidden");
        //         emailInput.focus();
        //         // Tambahkan logika submit OTP di sini, jika diperlukan
        //     });

        //     // Logika untuk mengotomatisasi perpindahan fokus antar input field
        //     const otpInputs = document.querySelectorAll('#otpModal input[type="text"]');
        //     otpInputs.forEach((input, index) => {
        //         input.addEventListener('input', () => {
        //             if (input.value.length === 1 && index < otpInputs.length - 1) {
        //                 otpInputs[index + 1].focus();
        //             }
        //         });

        //         input.addEventListener('keydown', (e) => {
        //             if (e.key === 'Backspace' && input.value === '' && index > 0) {
        //                 otpInputs[index - 1].focus();
        //             }
        //         });
        //     });
        // });



        document.addEventListener("DOMContentLoaded", function() {
            // Memfokuskan ke input email
            document.getElementById("email").focus();
        });

        document.getElementById('togglePassword').addEventListener('click', function() {
            var passwordInput = document.getElementById('password');
            var type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
        });

        const submitButton = document.getElementById("submitButton");
        const loadingIndicator = document.getElementById("loadingButton");
        const buttonText = document.getElementById("buttonText");

        submitButton.addEventListener("click", function() {
            // Memeriksa apakah semua input sudah diisi
            const emailValue = document.getElementById('email').value.trim();
            const passwordValue = document.getElementById('password').value.trim();

            if (emailValue === '' || passwordValue === '') {
                return; // Jika ada input yang masih kosong, hentikan proses
            }

            // Jika semua input telah diisi, maka lanjutkan dengan proses loading
            submitButton.classList.add("hidden"); // Menyembunyikan tombol saat diklik
            loadingButton.style.display = 'inline-flex';
            setTimeout(() => {
                // Simulasi proses loading selama beberapa waktu (misalnya, 3 detik)
                // Setelah selesai, tampilkan kembali tombol dan sembunyikan indikator loading
                loadingIndicator.classList.add("inline-flex");
                submitButton.classList.remove("hidden");
            }, 12000); // Waktu simulasi loading (dalam milidetik)
        });
    </script>
@endsection
