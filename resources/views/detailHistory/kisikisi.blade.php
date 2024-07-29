@extends('layouts.template')

@section('title', 'Detail History Kisi Kisi - Brainys')


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
            <div class="text-gray-900 text-2xl font-semibold">{{ $data['name'] }}</div>
            <div class="mt-2 text-gray-500 text-sm leading-snug">Detail hasil Generate Kisi Kisi</div>
            <div class="text-slate-400 text-xs mt-2"> Dibuat pada <span
                    class="text-gray-900 font-bold">{{ date('d F Y | H:i', strtotime($data['created_at'])) }}
                </span>
            </div>
        </div>

        <div class="mt-8">
            <div class="text-gray-900 text-lg font-bold bg-gray-100 px-2 py-2">Informasi Umum</div>
            <div class="mt-2">
                <table class="w-full">
                    <tbody>
                        @foreach ($data['generate_output']['informasi_umum'] as $key => $value)
                            <tr>
                                <td class="py-1 text-sm w-[200px]">{{ ucwords(str_replace('_', ' ', $key)) }}</td>
                                <td class="px-1 py-1 text-sm text-gray-800 dark:text-gray-200">
                                    @if (is_array($value))
                                        <ul class="list-disc pl-5">
                                            @foreach ($value as $item)
                                                <li>: {{ $item }}</li>
                                            @endforeach
                                        </ul>
                                    @else
                                        : {{ $value }}
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="text-gray-900 text-lg font-bold bg-gray-100 px-2 py-2 mt-5">Kisi - Kisi</div>
            <div class="mt-2">
                <table class="w-full">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-6 py-3 text-left text-sm font-bold text-gray-800 uppercase">
                                Nomor
                            </th>
                            <th class="px-6 py-3 text-left text-sm font-bold text-gray-800 uppercase">
                                Indikator Soal
                            </th>
                            <th class="px-6 py-3 text-left text-sm font-bold text-gray-800 uppercase">
                                No Soal
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach ($data['generate_output']['kisi_kisi'] as $mission)
                            <tr>
                                <td
                                    class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200 font-semibold bg-gray-100 text-center">
                                    {{ $mission['nomor'] }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200">
                                    {{ $mission['indikator_soal'] }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200 text-center">
                                    {{ $mission['no_soal'] }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="flex flex-row gap-3 py-7">
                <x-export-word generateId="{{ $data['id'] }}" export="{{ route('export-kisi-kisi-word') }}" />
                <x-export-excel generateId="{{ $data['id'] }}" export="{{ route('export-kisi-kisi-excel') }}" />
            </div>
        </div>
    @endsection
