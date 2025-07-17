@extends('layouts.template')

@section('title', 'Detail History Modul Ajar - Brainys')

@section('meta')
    <meta name="robots" content="noindex, nofollow">
@endsection

@section('content')
    <x-nav></x-nav>

    <div class="container mx-auto px-4 sm:px-10 py-9 font-['Inter']">
        <button onclick="window.location='{{ route('history') }}'" class="mb-6">
            <div class="flex items-center">
                <img src="{{ URL('images/back.svg') }}" alt="" class="w-6 h-6">
                <div class="ml-2 text-base font-semibold text-black">Kembali</div>
            </div>
        </button>

        <div class="w-full">
            <div class="text-2xl font-semibold text-gray-900">{{ $materialHistory['name'] }}</div>
            <div class="mt-2 text-sm leading-snug text-gray-500">Detail hasil generate Modul Ajar</div>
            <div class="mt-2 text-xs text-slate-400"> Dibuat pada <span
                    class="font-bold text-gray-900">{{ date('d F Y | H:i', strtotime($materialHistory['created_at'])) }}
                </span>
            </div>
        </div>

        @foreach (['informasi_umum', 'sarana_dan_prasarana', 'tujuan_kegiatan_pembelajaran', 'pemahaman_bermakna'] as $section)
            <div class="px-2 py-2 mt-5 text-lg font-bold text-gray-900 bg-gray-100">
                {{ ucwords(str_replace('_', ' ', $section)) }}</div>
            <div class="mt-2">
                <table class="w-full">
                    <tbody>
                        @foreach ($materialHistory['output_data'][$section] as $key => $value)
                            <tr>
                                <td class="py-1 text-sm w-[200px]">{{ ucwords(str_replace('_', ' ', $key)) }}</td>
                                <td class="py-1 text-sm">
                                    @if (is_array($value))
                                        <ul>
                                            @foreach ($value as $item)
                                                <li>{{ $loop->iteration }}. {{ $item }}</li>
                                            @endforeach
                                        </ul>
                                    @else
                                        {{ $value }}
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endforeach

        <div class="px-2 py-2 mt-5 text-lg font-bold text-gray-900 bg-gray-100">Pertanyaan Pemantik</div>
        <div class="mt-2">
            <table class="w-full">
                <tbody class="divide-y divide-gray-200">
                    @foreach ($materialHistory['output_data']['pertanyaan_pemantik'] as $index => $pertanyaan)
                        <tr>
                            <td class="py-2 text-sm">{{ $index + 1 }}. {{ $pertanyaan }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="px-2 py-2 mt-5 text-lg font-bold text-gray-900 bg-gray-100">Kegiatan Pembelajaran</div>
        @foreach ($materialHistory['output_data']['kompetensi_dasar'] as $kompetensi)
            <div>
                <ol class="border-t border-gray-200">
                    <li class="px-6 pt-3 text-sm font-bold text-left text-gray-800 uppercase">
                        {{ $loop->iteration }}. {{ $kompetensi['nama_kompetensi_dasar'] }}
                    </li>
                </ol>
                <div class="">
                    @foreach ($kompetensi['materi_pembelajaran'] as $materi_pembelajaran)
                        <div class="px-6 py-3">
                            <ul class="pl-5 list-disc">
                                @foreach ($materi_pembelajaran as $key => $value)
                                    <li class="text-sm text-gray-800">
                                        <span class="font-bold">{{ ucwords(str_replace('_', ' ', $key)) }}:</span>
                                        @if (is_array($value))
                                            <ul class="pl-5 list-circle">
                                                @foreach ($value as $subitem)
                                                    <li>
                                                        @if (is_array($subitem))
                                                            <ul class="pl-5 list-disc">
                                                                @foreach ($subitem as $subKey => $subValue)
                                                                    <li><span
                                                                            class="font-bold">{{ ucwords(str_replace('_', ' ', $subKey)) }}:</span>
                                                                        {{ $subValue }}</li>
                                                                @endforeach
                                                            </ul>
                                                        @else
                                                            {{ $subitem }}
                                                        @endif
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @else
                                            {{ $value }}
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach

        <div class="px-2 py-2 mt-5 text-lg font-bold text-gray-900 bg-gray-100">Langkah Pembelajaran</div>
        <div class="mt-2 space-y-4">
            @foreach ($materialHistory['output_data']['langkah_pembelajaran'] as $key => $items)
                <div>
                    <div class="mb-1 font-semibold text-gray-800">
                        {{ ucwords(str_replace('_', ' ', $key)) }}
                    </div>
                    <ol class="pl-6 space-y-1 text-sm text-gray-700 list-decimal">
                        @foreach ($items as $item)
                            <li>{{ $item }}</li>
                        @endforeach
                    </ol>
                </div>
            @endforeach
        </div>


        @foreach (['glosarium_materi' => 'Glosarium', 'daftar_pustaka' => 'Daftar Pustaka'] as $key => $title)
            <div class="px-2 py-2 mt-5 text-lg font-bold text-gray-900 bg-gray-100">{{ $title }}</div>
            <ol class="pl-8 list-decimal">
                @foreach ($materialHistory['output_data']['lampiran'][$key] as $item)
                    <li class="mb-2 text-sm text-gray-800">{{ $item }}</li>
                @endforeach
            </ol>
        @endforeach

        <div class="container flex flex-row gap-3 px-4 mx-auto mb-7 sm:px-10">
            <x-export-word generateId="{{ $materialHistory['id'] }}" export="{{ route('export-word') }}" />
            <x-export-excel generateId="{{ $materialHistory['id'] }}" export="{{ route('export-modul-excel') }}" />
        </div>
    </div>
@endsection
