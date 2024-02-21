@extends('layouts.template')

@section('title', 'Profile - Brainys')

@section('content')

    <div class="container mx-auto flex items-center justify-center flex-col mt-10">
        <img src="{{ URL('images/Steps1.png') }}" alt="" class="w-[206px] h-[84px]">
        <div class="w-[360px] sm:w-[412px] h-[358px] flex items-center justify-center flex-col mt-24 sm:mt-[100px]">
            <img src="{{ URL('images/user.svg') }}" alt="" class="">
            <div class="text-gray-900 text-4xl font-bold font-['Inter'] leading-[48px] mt-4 mb-4 sm">Lengkapi Profile</div>
            <div class="text-center text-gray-900 text-base font-medium font-['Inter'] leading-normal mb-12">Silakan
                lengkapi profile anda terlebih dahulu </div>
            <form action="{{ route('complete.profile') }}" method="post">
                @csrf
                <div class="mb-4">
                    <label for="name"
                        class="text-gray-900 text-base font-medium font-['Inter'] leading-normal mb-[30px]">Nama
                        Lengkap</label>
                    <input type="text" id="name" name="name"
                        class="w-full p-2 border rounded-md mt-[10px] placeholder:text-gray-400 text-base font-normal font-['Inter'] leading-normal mr-5"
                        placeholder="Contoh: Budiman" required>
                </div>

                <div class="mb-4">
                    <label for="school_name"
                        class="text-gray-900 text-base font-medium font-['Inter'] leading-normal mb-[30px]">Sekolah</label>
                    <input type="text" id="school_name" name="school_name"
                        class="w-full p-2 border rounded-md mt-[10px] placeholder:text-gray-400 text-base font-normal font-['Inter'] leading-normal mr-5"
                        placeholder="Contoh: SMP 1 Bandung" required>
                </div>

                <div class="mb-4">
                    <label for="profession"
                        class="text-gray-900 text-base font-medium font-['Inter'] leading-normal mb-[30px]">Profesi</label>
                    <input type="text" id="profession" name="profession"
                        class="w-full p-2 border rounded-md mt-[10px] placeholder:text-gray-400 text-base font-normal font-['Inter'] leading-normal mr-5"
                        placeholder="Contoh: Guru Biologi" required>
                </div>

                <button id="konfirmasiButton" type="submit"
                    class="w-full h-12 px-6 py-3 bg-blue-600 rounded-[50px] justify-center items-center">
                    <div class="text-center text-white text-base font-medium font-['Inter'] leading-normal">Konfirmasi
                    </div>
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


            </form>
        </div>
    </div>

    <script>
        const submitButton = document.getElementById("konfirmasiButton");
        const loadingIndicator = document.getElementById("loadingButton");
        const buttonText = document.getElementById("buttonText");

        submitButton.addEventListener("click", function() {
            // Memeriksa apakah semua input sudah diisi
            const namaLengkapValue = document.getElementById('name').value.trim();
            const sekolahValue = document.getElementById('school_name').value.trim();
            const profesiValue = document.getElementById('profession').value.trim();

            if (namaLengkapValue === '' || sekolahValue === '' || profesiValue === '') {
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
            }, 3000); // Waktu simulasi loading (dalam milidetik)
        });
    </script>

@endsection
