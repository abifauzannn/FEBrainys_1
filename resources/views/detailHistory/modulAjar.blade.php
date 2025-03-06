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
                <div class="text-black text-base font-semibold ml-2">Kembali</div>
            </div>
        </button>

        <div class="w-full">
            <div class="text-gray-900 text-2xl font-semibold">{{ $materialHistory['name'] }}</div>
            <div class="mt-2 text-gray-500 text-sm leading-snug">Detail hasil generate Modul Ajar</div>
            <div class="text-slate-400 text-xs mt-2"> Dibuat pada <span
                    class="text-gray-900 font-bold">{{ date('d F Y | H:i', strtotime($materialHistory['created_at'])) }}
                </span>
            </div>
        </div>

        @foreach (['informasi_umum', 'sarana_dan_prasarana', 'tujuan_kegiatan_pembelajaran', 'pemahaman_bermakna'] as $section)
            <div class="text-gray-900 text-lg font-bold bg-gray-100 px-2 py-2 mt-5">
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

        <div class="text-gray-900 text-lg font-bold bg-gray-100 px-2 py-2 mt-5">Pertanyaan Pemantik</div>
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

        <div class="text-gray-900 text-lg font-bold mt-5 bg-gray-100 px-2 py-2">Kegiatan Pembelajaran</div>
        @foreach ($materialHistory['output_data']['kompetensi_dasar'] as $kompetensi)
            <div>
                <ol class="border-t border-gray-200">
                    <li class="px-6 pt-3 text-left text-sm font-bold text-gray-800 uppercase">
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

        @foreach (['glosarium_materi' => 'Glosarium', 'daftar_pustaka' => 'Daftar Pustaka'] as $key => $title)
            <div class="text-gray-900 text-lg font-bold mt-5 bg-gray-100 px-2 py-2">{{ $title }}</div>
            <ol class="list-decimal pl-8">
                @foreach ($materialHistory['output_data']['lampiran'][$key] as $item)
                    <li class="text-sm text-gray-800 mb-2">{{ $item }}</li>
                @endforeach
            </ol>
        @endforeach

        <div class="mb-7 px-4 sm:px-10 container mx-auto flex flex-row gap-3">
            <x-export-word generateId="{{ $materialHistory['id'] }}" export="{{ route('export-word') }}" />
            <x-export-excel generateId="{{ $materialHistory['id'] }}" export="{{ route('export-modul-excel') }}" />
        </div>
    </div>
@endsection
