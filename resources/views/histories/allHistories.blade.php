@extends('layouts.template')

@section('title', 'History Modul Ajar - Brainys')

@section('content')



    <x-nav></x-nav>

    <div class="container mx-auto px-4 sm:px-10 py-9 font-['Inter']">

        <a href="{{ route('modulAjar') }}" class="block mb-6">
            <div class="flex items-center">
                <img src="{{ URL('images/back.svg') }}" alt="" class="w-6 h-6">
                <div class="text-black text-base font-semibold ml-2">Kembali</div>
            </div>
        </a>

        <div class="w-full flex justify-between">
            <div>
                <div class="text-gray-900 text-2xl font-semibold font-['Inter']">Riwayat Generasi</div>
                <div class="mt-2 text-gray-500 text-sm leading-snug">Semua hasil pembuatan templat di tampilkan disini</div>
            </div>

            <div class="inline-flex justify-center items-center gap-[16px] mt-[14px]">
                <div class="text-gray-900 text-md font-semibold font-['Inter']">Filter</div>
                <div x-data="{ isOpen: false, selectedOption: 'Semua' }" class="">
                    <button @click="isOpen = !isOpen"
                        class="py-2 px-4 bg-white rounded-md shadow-md flex items-center w-48">
                        <span x-text="selectedOption" class=""></span>

                    </button>

                    <ul x-show="isOpen" @click.away="isOpen = false"
                        class="absolute bg-white border rounded-md shadow-md w-48">
                        <li @click="selectedOption = 'Semua'; isOpen = false"
                            class="px-4 py-2 cursor-pointer hover:bg-gray-100 inline-flex justify-start items-center w-full">
                            <span class="flex w-3 h-3 me-3 bg-gray-700 rounded-full"></span> Semua
                        </li>
                        <li @click="selectedOption = 'Modul Ajar'; isOpen = false"
                            class="px-4 py-2 cursor-pointer hover:bg-gray-100  inline-flex justify-start items-center w-full">
                            <span class="flex w-3 h-3 me-3 bg-green-600 rounded-full"></span> Modul Ajar
                        </li>
                        <li @click="selectedOption = 'Silabus'; isOpen = false"
                            class="px-4 py-2 cursor-pointer hover:bg-gray-100  inline-flex justify-start items-center w-full">
                            <span class="flex w-3 h-3 me-3 bg-orange-600 rounded-full"></span> Silabus
                        </li>
                        <li @click="selectedOption = 'Soal'; isOpen = false"
                            class="px-4 py-2 cursor-pointer hover:bg-gray-100  inline-flex justify-start items-center w-full">
                            <span class="flex w-3 h-3 me-3 bg-blue-700 rounded-full"></span> Soal
                        </li>
                    </ul>
                </div>
            </div>



        </div>

        <div class="container mx-auto py-3">

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

                @foreach ($historyExercise['items'] as $item)
                    <div class="p-6 rounded-lg shadow-md">
                        <img src="{{ URL('images/historySoal.png') }}" alt="" class="mb-3">
                        <div class="text-gray-900 text-xl font-semibold font-inter">{{ $item['name'] }}</div>
                        <div class="text-gray-600 text-xs font-semibold font-inter py-3">Dibuat pada
                            {{ $item['created_at'] }}</div>
                        <div class="text-gray-700 mb-2">{{ $item['notes'] }}</div>
                        <div class="inline-flex gap-5 justify-center items-center">
                            <a href="#">
                                <button type="submit"
                                    class="flex items-center bg-blue-600 px-5 py-2 rounded-lg text-white mt-3 gap-2 hover:bg-blue-800 transition duration-300 ease-in-out">
                                    <svg class="w-4 h-4 mb-[4px]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 20 20">
                                        <path stroke="currentColor" stroke-width="2"
                                            d="M21 12c0 1.2-4 6-9 6s-9-4.8-9-6c0-1.2 4-6 9-6s9 4.8 9 6Z" />
                                        <path stroke="currentColor" stroke-width="2"
                                            d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                    </svg>
                                    <span class="font-bold font-inter text-sm">View Detail</span>
                                </button>
                            </a>
                        </div>
                    </div>
                @endforeach


                @foreach ($historyModulAjar['items'] as $item)
                    <div class="bg-white p-6 rounded-lg shadow-md">

                        <img src="{{ URL('images/historyModulAjar.png') }}" alt="">
                        <div class="text-lg font-bold mb-2">ID {{ $item['id'] }}</div>
                        <div class="text-gray-700 mb-2">Nama: {{ $item['name'] }}</div>
                        <div class="text-gray-700 mb-2">Mata Pelajaran: {{ $item['subject'] }}</div>
                        <div class="text-gray-700 mb-2">Kelas: {{ $item['grade'] }}</div>
                        <div class="text-gray-700 mb-2">Catatan: {{ $item['notes'] }}</div>
                        <div class="text-gray-600 text-sm">Dibuat pada: {{ $item['created_at'] }}</div>
                        <div class="text-gray-600 text-sm">Diperbarui pada: {{ $item['updated_at'] }}</div>
                        <div class="inline-flex gap-5 justify-center items-center">
                            <a href="#" class="">
                                <button type="submit"
                                    class="flex items-center bg-blue-600 px-5 py-2 rounded-lg text-white mt-3 gap-2 hover:bg-blue-800 transition duration-300 ease-in-out">
                                    <svg class="w-4 h-4 mb-[4px]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 20 20">
                                        <path stroke="currentColor" stroke-width="2"
                                            d="M21 12c0 1.2-4 6-9 6s-9-4.8-9-6c0-1.2 4-6 9-6s9 4.8 9 6Z" />
                                        <path stroke="currentColor" stroke-width="2"
                                            d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                    </svg>
                                    <span class="font-bold font-['Inter'] text-sm">View Detail</span>

                                </button>

                            </a>



                            <form action="{{ route('export-word') }}" method="post">
                                @csrf
                                <input type="hidden" name="generate_id" value="{{ $item['id'] }}">
                                <button type="submit"
                                    class="flex items-center bg-green-600 px-5 py-2 rounded-lg text-white mt-3 gap-2 hover:bg-green-800 transition duration-300 ease-in-out">
                                    <svg class="w-4 h-4 mb-[4px] " aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M14.707 7.793a1 1 0 0 0-1.414 0L11 10.086V1.5a1 1 0 0 0-2 0v8.586L6.707 7.793a1 1 0 1 0-1.414 1.414l4 4a1 1 0 0 0 1.416 0l4-4a1 1 0 0 0-.002-1.414Z" />
                                        <path
                                            d="M18 12h-2.55l-2.975 2.975a3.5 3.5 0 0 1-4.95 0L4.55 12H2a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-4a2 2 0 0 0-2-2Zm-3 5a1 1 0 1 1 0-2 1 1 0 0 1 0 2Z" />
                                    </svg>
                                    <span class="font-bold font-['Inter'] text-sm">Download File</span>

                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach

                @foreach ($historySyllabus['items'] as $item)
                    <div class="bg-white p-6 rounded-lg shadow-md">

                        <img src="{{ URL('images/historySyllabus.png') }}" alt="">
                        <div class="text-lg font-bold mb-2">ID {{ $item['id'] }}</div>
                        <div class="text-gray-700 mb-2">Subject: {{ $item['subject'] }}</div>
                        <div class="text-gray-700 mb-2">Grade: {{ $item['grade'] }}</div>
                        <div class="text-gray-700 mb-2">NIP: {{ $item['nip'] }}</div>
                        <div class="text-gray-700 mb-2">Notes: {{ $item['notes'] }}</div>
                        <div class="text-gray-700 mb-2">User ID: {{ $item['user_id'] }}</div>
                        <div class="text-gray-600 text-sm">Dibuat pada: {{ $item['created_at'] }}</div>
                        <div class="text-gray-600 text-sm">Diperbarui pada: {{ $item['updated_at'] }}</div>
                        <div class="inline-flex gap-5 justify-center items-center">
                            <a href="#" class="">
                                <button type="submit"
                                    class="flex items-center bg-blue-600 px-5 py-2 rounded-lg text-white mt-3 gap-2 hover:bg-blue-800 transition duration-300 ease-in-out">
                                    <svg class="w-4 h-4 mb-[4px]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 20 20">
                                        <path stroke="currentColor" stroke-width="2"
                                            d="M21 12c0 1.2-4 6-9 6s-9-4.8-9-6c0-1.2 4-6 9-6s9 4.8 9 6Z" />
                                        <path stroke="currentColor" stroke-width="2"
                                            d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                    </svg>
                                    <span class="font-bold font-['Inter'] text-sm">View Detail</span>

                                </button>

                            </a>

                            <form action="{{ route('export-word-syllabus') }}" method="post">
                                @csrf
                                <input type="hidden" name="generate_id" value="{{ $item['id'] }}">
                                <button type="submit"
                                    class="flex items-center bg-green-600 px-5 py-2 rounded-lg text-white mt-3 gap-2 hover:bg-green-700 transition duration-300 ease-in-out">
                                    <svg class="w-4 h-4 mb-[5px]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M14.707 7.793a1 1 0 0 0-1.414 0L11 10.086V1.5a1 1 0 0 0-2 0v8.586L6.707 7.793a1 1 0 1 0-1.414 1.414l4 4a1 1 0 0 0 1.416 0l4-4a1 1 0 0 0-.002-1.414Z" />
                                        <path
                                            d="M18 12h-2.55l-2.975 2.975a3.5 3.5 0 0 1-4.95 0L4.55 12H2a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-4a2 2 0 0 0-2-2Zm-3 5a1 1 0 1 1 0-2 1 1 0 0 1 0 2Z" />
                                    </svg>
                                    <span class="font-bold font-['Inter'] text-sm">Download File</span>

                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

    </div>

@endsection
