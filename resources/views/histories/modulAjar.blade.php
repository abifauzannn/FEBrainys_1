@extends('layouts.template')

@section('title', 'History Modul Ajar - Brainys')

@section('content')

    <x-nav></x-nav>



    <div class="container mx-auto px-[20px] sm:px-10 py-9">

        <a href="{{ route('syllabus') }}" class="block mb-6">
            <div class="flex items-center">
                <img src="{{ URL('images/back.svg') }}" alt="" class="w-6 h-6">
                <div class="text-black text-base font-semibold ml-2">Kembali</div>
            </div>
        </a>

        <div class="container mx-auto py-3">
            <div class="text-2xl md:text-[32px] font-bold font-inter leading-[49.99px]">Recent History</div>

            <div class="text-gray-500 text-sm font-bold my-2">Total Generated: {{ $history['generated_num'] }}</div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($history['items'] as $item)
                    <div class="bg-white p-6 rounded-lg shadow-md">
                        <div class="text-lg font-bold mb-2">ID {{ $item['id'] }}</div>
                        <div class="text-gray-700 mb-2">Nama: {{ $item['name'] }}</div>
                        <div class="text-gray-700 mb-2">Mata Pelajaran: {{ $item['subject'] }}</div>
                        <div class="text-gray-700 mb-2">Kelas: {{ $item['grade'] }}</div>
                        <div class="text-gray-700 mb-2">Catatan: {{ $item['notes'] }}</div>
                        <div class="text-gray-600 text-sm">Dibuat pada: {{ $item['created_at'] }}</div>
                        <div class="text-gray-600 text-sm">Diperbarui pada: {{ $item['updated_at'] }}</div>
                        <a href="" class="text-blue-500 hover:text-blue-600 mt-2 block font-bold">View Detail</a>
                    </div>
                @endforeach
            </div>
        </div>


    </div>

@endsection
