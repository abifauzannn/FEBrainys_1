@extends('layouts.template')

@section('title', 'Profile')

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
                    class="w-full p-2 border rounded-md mt-[10px] text-gray-400 text-base font-normal font-['Inter'] leading-normal mr-5"
                    placeholder="Contoh: Budiman" required>
            </div>

            <div class="mb-4">
                <label for="school_name"
                    class="text-gray-900 text-base font-medium font-['Inter'] leading-normal mb-[30px]">Sekolah</label>
                <input type="text" id="school_name" name="school_name"
                    class="w-full p-2 border rounded-md mt-[10px] text-gray-400 text-base font-normal font-['Inter'] leading-normal mr-5"
                    placeholder="Contoh: SMP 1 Bandung" required>
            </div>

            <div class="mb-4">
                <label for="profession"
                    class="text-gray-900 text-base font-medium font-['Inter'] leading-normal mb-[30px]">Profesi</label>
                <input type="text" id="profession" name="profession"
                    class="w-full p-2 border rounded-md mt-[10px] text-gray-400 text-base font-normal font-['Inter'] leading-normal mr-5"
                    placeholder="Contoh: Guru Biologi" required>
            </div>

            <button id="konfirmasiButton" type="submit"
                class="w-full h-12 px-6 py-3 bg-gray-200 rounded-[50px] justify-center items-center" disabled>
                <div class="text-center text-white text-base font-medium font-['Inter'] leading-normal">Konfirmasi
                </div>
            </button>
        </form>
    </div>
</div>

<script>
    const namaLengkapInput = document.getElementById('name');
    const sekolahInput = document.getElementById('school_name');
    const profesiInput = document.getElementById('profession');
    const konfirmasiButton = document.getElementById('konfirmasiButton');

    // Fungsi untuk memeriksa apakah semua input sudah diisi
    function checkInputs() {
        const namaLengkapValue = namaLengkapInput.value.trim();
        const sekolahValue = sekolahInput.value.trim();
        const profesiValue = profesiInput.value.trim();

        // Set button menjadi enabled jika semua input terisi
        konfirmasiButton.disabled = !(namaLengkapValue && sekolahValue && profesiValue);

        // Ubah warna latar belakang tombol menjadi biru jika semua input terisi
        konfirmasiButton.style.backgroundColor = (namaLengkapValue && sekolahValue && profesiValue) ? '#3498db' : '#ccc';
    }

    // Event listener untuk memeriksa setiap kali input berubah
    namaLengkapInput.addEventListener('input', checkInputs);
    sekolahInput.addEventListener('input', checkInputs);
    profesiInput.addEventListener('input', checkInputs);
</script>

@endsection
