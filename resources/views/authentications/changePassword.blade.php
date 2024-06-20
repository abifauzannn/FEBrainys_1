@extends('layouts.template')

@section('title', 'Change Password - Brainys')

@section('meta')
    <meta name="robots" content="noindex, nofollow">
@endsection

@section('content')
    <x-nav></x-nav>

    @if (session('user')['is_active'] == 0)
        <script>
            window.location.href = "{{ route('dashboard') }}";
        </script>
    @endif

    <div class="w-full container mx-auto px-4 sm:px-10 py-9">


        <a href="/dashboard">
            <div class="w-[90px] h-6 justify-start items-end gap-1 inline-flex mb-6">
                <img src="{{ URL('images/back.svg') }}" alt="" class="w-6 h-6">
                <div class="text-black text-base font-semibold font-['Inter']">Kembali</div>
            </div>
        </a>

        <div id="successPopup"
            class="fixed top-0 left-0 w-full h-full bg-black bg-opacity-50 flex justify-center items-center hidden z-50">
            <div class="bg-white w-[300px] p-6 rounded-lg shadow-md">
                <img src="{{ URL('images/success.png') }}" alt="">
                <div class="text-green-600 font-bold font-['Inter'] mt-4 ">Success!</div>
                <div class="text-gray-800 font-bold font-['Inter']">{{ session('success') }}</div>
            </div>
        </div>


        <div class="w-full sm:w-[1170px] h-[60px] flex-col justify-start items-start gap-2 inline-flex">
            <div class="text-gray-900 text-2xl font-semibold font-['Inter'] leading-[30px]">Change Password</div>

        </div>

        <div class="container mx-auto flex items-center justify-center mt-[51px] flex-col">

            <form class="w-full sm:w-[500px]" action="{{ route('change-passwordPost') }}" method="post">



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
                @csrf
                <div class="relative mb-4">
                    <label for="current_password"
                        class="text-gray-900 text-base font-medium font-['Inter'] leading-normal mb-[30px]">Password
                        Lama:</label>
                    <input type="password" id="current_password" name="current_password"
                        class="w-full p-2 border rounded-md mt-[10px] placeholder:text-gray-400 text-base font-normal font-['Inter'] leading-normal mr-5"
                        placeholder="Masukan Password Anda">
                    <button id="togglePassword" type="button"
                        class="absolute right-0 top-[48px] flex items-center mr-3 focus:outline-none">
                        <img src="{{ URL('images/group.svg') }}" alt="">
                    </button>
                </div>

                <div class="relative mb-4">
                    <label for="new_password"
                        class="text-gray-900 text-base font-medium font-['Inter'] leading-normal mb-[30px]">Password
                        Baru:</label>
                    <input type="password" id="new_password" name="new_password"
                        class="w-full p-2 border rounded-md mt-[10px] placeholder:text-gray-400 text-base font-normal font-['Inter'] leading-normal mr-5"
                        placeholder="Masukan Password Anda">
                    <button id="seePassword" type="button"
                        class="absolute right-0 top-[48px] flex items-center mr-3 focus:outline-none">
                        <img src="{{ URL('images/group.svg') }}" alt="">
                    </button>
                </div>

                <div class="relative mb-4">
                    <label for="new_password_confirmation"
                        class="text-gray-900 text-base font-medium font-['Inter'] leading-normal mb-[30px]">Konfirmasi
                        Password Baru</label>
                    <input type="password" id="new_password_confirmation" name="new_password_confirmation"
                        class="w-full p-2 border rounded-md mt-[10px] placeholder:text-gray-400 text-base font-normal font-['Inter'] leading-normal mr-5"
                        placeholder="Masukan Konfirmasi Password Anda">
                    <button id="lihatPassword" type="button"
                        class="absolute right-0 top-[48px] flex items-center mr-3 focus:outline-none">
                        <img src="{{ URL('images/group.svg') }}" alt="">
                    </button>
                </div>

                <div class="items-center flex justify-center py-4">
                    <button type="submit" id="submitButton"
                        class="w-auto  h-12 px-6 py-3 bg-blue-600 rounded-sm justify-center items-center gap-2.5 inline-flex">
                        <img src="{{ URL('images/check-circle.svg') }}" alt="" class="w-[20px] h-[20px]">
                        <div class="text-center text-white text-base font-medium font-['Inter'] leading-normal">Simpan
                            Perubahan
                        </div>
                    </button>

                    <button id="loadingButton" disabled type="button"
                        class="h-12 px-6 py-3 bg-blue-600 rounded-sm justify-center items-center gap-2.5 inline-flex w-a"
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
                        <div class="text-center text-white text-base font-medium font-['Inter'] leading-normal">Menyimpan
                            Perubahan
                        </div>
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
            var passwordInput = document.getElementById('current_password');
            var type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
        });
        document.getElementById('seePassword').addEventListener('click', function() {
            var passwordInput = document.getElementById('new_password');
            var type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
        });
        document.getElementById('lihatPassword').addEventListener('click', function() {
            var passwordInput = document.getElementById('new_password_confirmation');
            var type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
        });

        const submitButton = document.getElementById("submitButton");
        const loadingIndicator = document.getElementById("loadingButton");
        const buttonText = document.getElementById("buttonText");

        submitButton.addEventListener("click", function() {
            // Memeriksa apakah semua input sudah diisi
            const passwordValue = document.getElementById('new_password').value.trim();
            const newPasswordValue = document.getElementById('new_password_confirmation').value.trim();
            const currentPasswordValue = document.getElementById('current_password').value.trim();

            if (passwordValue === '' || newPasswordValue === '' || currentPasswordValue === '') {
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
            }, 6000); // Waktu simulasi loading (dalam milidetik)
        });
    </script>



@endsection
