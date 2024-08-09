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
            <div class="mt-2 text-gray-500 text-sm leading-snug">Detail hasil Generate Alur Tujuan Pembelajaran (ATP)</div>
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
                        @foreach ($data['output_data']['informasi_umum'] as $key => $value)
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
            <div class="text-gray-900 text-lg font-bold bg-gray-100 px-2 py-2 mt-5">Alur</div>
            <div class="mt-2 overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-6 py-3 text-left text-sm font-bold text-gray-800 uppercase">No</th>
                            <th class="px-6 py-3 text-left text-sm font-bold text-gray-800 uppercase">Tujuan Pembelajaran
                            </th>
                            <th class="px-6 py-3 text-left text-sm font-bold text-gray-800 uppercase">Kata/Frase Kunci</th>
                            <th class="px-6 py-3 text-left text-sm font-bold text-gray-800 uppercase">Profil Pelajar
                                Pancasila
                            </th>
                            <th class="px-6 py-3 text-left text-sm font-bold text-gray-800 uppercase">Glorasium</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach ($data['output_data']['alur'] as $item)
                            <tr>
                                <td
                                    class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200 font-semibold bg-gray-100 text-center">
                                    {{ $item['no'] }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200">
                                    {{ $item['tujuan_pembelajaran'] }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200">
                                    <ul class="list-disc pl-5">
                                        @foreach ($item['kata_frase_kunci'] as $kata_frase)
                                            <li>{{ $kata_frase }}</li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200">
                                    <ul class="list-disc pl-5">
                                        @foreach ($item['profil_pelajar_pancasila'] as $profil)
                                            <li>{{ $profil }}</li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200">
                                    {{ $item['glosarium'] }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="flex flex-row gap-3 py-7">
                <x-export-word generateId="{{ $data['id'] }}" export="{{ route('export-atp-word') }}" />
                <x-export-excel generateId="{{ $data['id'] }}" export="{{ route('export-atp-excel') }}" />
            </div>


        </div>
    @endsection
