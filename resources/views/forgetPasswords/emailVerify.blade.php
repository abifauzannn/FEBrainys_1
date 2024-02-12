@extends('layouts.template')

@section('title', 'Change Password')

@section('content')


    <div class="w-full container mx-auto px-4 sm:px-10 py-9">

        @if (session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 my-4" role="alert">
                <p class="font-bold">Success!</p>
                <p>{{ session('success') }}</p>
            </div>
        @endif

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
                @csrf
                <div class="mb-4">
                    <label for="email"
                        class="text-gray-900 text-base font-medium font-['Inter'] leading-normal mb-[30px]">Masukan
                        Email</label>
                    <input type="email" id="email" name="email"
                        class="w-full p-2 border rounded-md mt-[10px] text-gray-400 text-base font-normal font-['Inter'] leading-normal mr-5"
                        placeholder="email@contoh.com" required>
                </div>
                <div class="items-center flex justify-center py-4">
                    <button type="submit"
                        class="w-[194px] h-12 px-6 py-3 bg-blue-600 rounded-sm justify-center items-center gap-2.5 inline-flex hover:bg-blue-700">
                        <img src="{{ URL('images/check-circle.svg') }}" alt="" class="w-[20px] h-[20px]">
                        <div class="text-center text-white text-base font-medium font-['Inter'] leading-normal">Verifikasi
                            Email
                        </div>
                    </button>
                </div>
            </form>
        </div>
    </div>

@endsection
