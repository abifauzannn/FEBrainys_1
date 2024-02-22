@extends('layouts.template')

@section('title', 'Email Verify - Brainys')

@section('content')


    <div class="w-full container mx-auto px-4 sm:px-10 py-9">





        <div class="justify-center items-center gap-4 inline-flex mb-5">
            <img src="{{ URL('images/Logo.svg') }}" alt="" class="w-[50px] h-[39px]">
            <div class="text-center text-gray-900 text-[18px] font-bold font-['Inter']">Brainys
            </div>
        </div>

        <hr>
        <br>
        <a href="{{ route('login') }}">
            <div class="w-[90px] h-6 justify-start items-end gap-1 inline-flex mb-6">
                <img src="{{ URL('images/back.svg') }}" alt="" class="w-6 h-6">
                <div class="text-black text-base font-semibold font-['Inter']">Kembali</div>
            </div>
        </a>

        <div class="w-full sm:w-[1170px] h-[60px] flex-col justify-start items-start gap-2 inline-flex">
            <div class="text-gray-900 text-2xl font-semibold font-['Inter'] leading-[30px]">Lupa Password</div>
            <div class="w-full sm:w-[549px] text-gray-500 text-sm font-normal font-['Inter'] leading-snug">Lorem ipsum dolor
                sit amet,
                consectetur adipiscing elit. Cras ultrices lectus sem.</div>
        </div>



        <div class="w-full container mx-auto flex items-center justify-center mt-[51px] flex-col">
            <form class="w-dull sm:w-[500px]" action="{{ route('emailVerify') }}" method="post">
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
                @csrf
                <div class="mb-4">
                    <label for="email"
                        class="text-gray-900 text-base font-medium font-['Inter'] leading-normal mb-[30px]">Masukan
                        Email</label>
                    <input type="email" id="email" name="email"
                        class="w-full p-2 border rounded-md mt-[10px] placeholder:text-gray-400 text-base font-normal font-['Inter'] leading-normal mr-5"
                        placeholder="email@contoh.com" required>

                </div>
                <div class="items-center flex justify-center py-4">
                    <button type="submit" id="submitButton"
                        class="w-auto h-12 px-6 py-3 bg-blue-600 rounded-sm justify-center items-center gap-2.5 inline-flex hover:bg-blue-700">
                        <img src="{{ URL('images/check-circle.svg') }}" alt="" class="w-[20px] h-[20px]">
                        <div id="verifikasi"
                            class="text-center text-white text-base font-medium font-['Inter'] leading-normal">Verifikasi
                            Email
                        </div>
                        <div id="terverifikasi"
                            class="text-center text-white text-base font-medium font-['Inter'] leading-normal hidden">
                            Verifikasi Email Terkirim
                        </div>
                    </button>

                    <button id="loadingButton" disabled type="button"
                        class="h-12 px-6 py-3 bg-blue-600 rounded-sm justify-center items-center gap-2.5 inline-flex w-[194px]"
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


                </div>

                @if (session('success'))
                    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 my-4" role="alert">
                        <p class="font-bold">Success!</p>
                        <p>Link untuk proses reset password anda berhasik dikirim ke {{ session('email') }}. Silakan cek
                            inbox atau di bagian spam email.</p>
                    </div>
                @endif




            </form>
        </div>
    </div>

    @if (session('success'))
        <script>
            var submitButton = document.getElementById('submitButton')
            var verifikasi = document.getElementById('verifikasi')
            var verifikasiEmail = document.getElementById('terverifikasi')
            var inputEmail = document.getElementById('email')
            var outputEmail = document.getElementById('outputEmail')

            submitButton.setAttribute('disabled', true);
            submitButton.classList.remove('bg-blue-600', 'hover:bg-blue-700');
            submitButton.classList.add('bg-gray-300');
            verifikasi.classList.add('hidden');
            verifikasiEmail.classList.remove('hidden');
        </script>
    @endif


    <script>
        submitButton.addEventListener("click", function() {
            // Memeriksa apakah email memiliki format yang valid
            const emailValue = document.getElementById('email').value.trim();
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/; // Regex untuk memeriksa format email

            if (!emailRegex.test(emailValue)) {
                return; // Jika format email tidak valid, hentikan proses
            }

            // Jika email valid, lanjutkan dengan proses loading
            submitButton.classList.add("hidden"); // Menyembunyikan tombol saat diklik
            loadingButton.style.display = 'inline-flex';
            setTimeout(() => {
                // Simulasi proses loading selama beberapa waktu (misalnya, 3 detik)
                // Setelah selesai, tampilkan kembali tombol dan sembunyikan indikator loading
                loadingIndicator.classList.add("inline-flex");
                submitButton.classList.remove("hidden");
            }, 3000); // Waktu simulasi loading (dalam milidetik)
        });
    </script>

@endsection
