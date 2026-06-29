@extends('layouts.template')

@section('title', 'Detail History Simulasi - Brainys')

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
            <div class="text-gray-900 text-2xl font-semibold">{{ $simulasiHistory['name'] }}</div>
            <div class="mt-2 text-gray-500 text-sm leading-snug">Detail hasil Generate Simulasi</div>
            <div class="text-slate-400 text-xs mt-2"> Dibuat pada <span
                    class="text-gray-900 font-bold">{{ date('d F Y | H:i', strtotime($simulasiHistory['created_at'])) }}
                </span>
            </div>
        </div>

        <div class="mt-8">

            {{-- Informasi Umum --}}
            @if (!empty($simulasiHistory['output_data']['informasi_umum']))
                <div class="text-gray-900 text-lg font-bold bg-gray-100 px-2 py-2">Informasi Umum</div>
                <div class="mt-2">
                    <table class="w-full">
                        <tbody>
                            @foreach ($simulasiHistory['output_data']['informasi_umum'] as $key => $value)
                                <tr>
                                    <td class="py-1 text-sm w-[200px]">{{ ucwords(str_replace('_', ' ', $key)) }}</td>
                                    <td class="px-1 py-1 text-sm text-gray-800">
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
            @endif

            {{-- Informasi Simulasi --}}
            @if (
                !empty($simulasiHistory['output_data']['tema']) ||
                    !empty($simulasiHistory['output_data']['konsep_utama']) ||
                    !empty($simulasiHistory['output_data']['skema_game']))
                <div class="text-gray-900 text-lg font-bold bg-gray-100 px-2 py-2 mt-5">Informasi Simulasi</div>
                <div class="mt-2">
                    <table class="w-full">
                        <tbody>
                            @if (!empty($simulasiHistory['output_data']['tema']))
                                <tr>
                                    <td class="py-1 text-sm w-[200px]">Tema</td>
                                    <td class="px-1 py-1 text-sm text-gray-800">
                                        : {{ $simulasiHistory['output_data']['tema'] }}
                                    </td>
                                </tr>
                            @endif
                            @if (!empty($simulasiHistory['output_data']['konsep_utama']))
                                <tr>
                                    <td class="py-1 text-sm w-[200px]">Konsep Utama</td>
                                    <td class="px-1 py-1 text-sm text-gray-800">
                                        : {{ $simulasiHistory['output_data']['konsep_utama'] }}
                                    </td>
                                </tr>
                            @endif
                            @if (!empty($simulasiHistory['output_data']['skema_game']))
                                <tr>
                                    <td class="py-1 text-sm w-[200px]">Skema Game</td>
                                    <td class="px-1 py-1 text-sm text-gray-800">
                                        : {{ ucfirst($simulasiHistory['output_data']['skema_game']) }}
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            @endif

            {{-- Elemen Simulasi --}}
            @if (!empty($simulasiHistory['output_data']['elemen_simulasi']))
                <div class="text-gray-900 text-lg font-bold bg-gray-100 px-2 py-2 mt-5">Elemen Simulasi</div>
                <div class="mt-2">
                    <table class="w-full">
                        <tbody>
                            @foreach ($simulasiHistory['output_data']['elemen_simulasi'] as $element)
                                <tr>
                                    <td class="py-1 text-sm w-[200px]">
                                        {{ $element['judul'] }}
                                    </td>
                                    <td class="px-1 py-1 text-sm text-gray-800">
                                        : {{ $element['deskripsi'] }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif

            {{-- Misi dan Tantangan --}}
            @if (!empty($simulasiHistory['output_data']['misi_dan_tantangan']))
                <div class="text-gray-900 text-lg font-bold bg-gray-100 px-2 py-2 mt-5">Misi dan Tantangan</div>
                <div class="mt-2">
                    <table class="w-full divide-y divide-gray-200">
                        <thead>
                            <tr>
                                <th class="px-1 text-left text-sm font-semibold text-gray-800">Jenis</th>
                                <th class="px-1 text-left text-sm font-semibold text-gray-800">Deskripsi</th>
                                <th class="px-1 text-left text-sm font-semibold text-gray-800">Poin</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($simulasiHistory['output_data']['misi_dan_tantangan'] as $mission)
                                <tr>
                                    <td class="px-1 py-1 text-sm text-gray-800">
                                        {{ $mission['jenis'] }}
                                    </td>
                                    <td class="px-1 py-1 text-sm text-gray-800">
                                        {{ $mission['deskripsi'] }}
                                    </td>
                                    <td class="px-1 py-1 text-sm text-gray-800">
                                        {{ $mission['poin'] ?? 100 }} poin
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif

            {{-- Langkah Implementasi --}}
            @if (!empty($simulasiHistory['output_data']['langkah_implementasi']))
                <div class="text-gray-900 text-lg font-bold bg-gray-100 px-2 py-2 mt-5">Langkah Implementasi</div>
                <div class="mt-2">
                    <table class="w-full">
                        <tbody class="divide-y divide-gray-200">
                            @foreach ($simulasiHistory['output_data']['langkah_implementasi'] as $step)
                                <tr>
                                    <td class="px-1 py-1 text-sm text-gray-800 font-semibold whitespace-nowrap">
                                        Langkah {{ $step['langkah'] }}
                                    </td>
                                    <td class="px-1 py-1 text-sm text-gray-800 font-semibold w-[200px]">
                                        {{ $step['judul'] }}
                                    </td>
                                    <td class="px-1 py-1 text-sm text-gray-800">
                                        <ul class="list-disc pl-5">
                                            @foreach ($step['deskripsi'] as $description)
                                                <li>{{ $description }}</li>
                                            @endforeach
                                        </ul>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif

            {{-- Export Buttons --}}
            <div class="flex flex-row gap-3 py-7">
                <x-export-word generateId="{{ $simulasiHistory['id'] }}" export="{{ route('export-simulasi-word') }}" />
                <x-export-ppt generateId="{{ $simulasiHistory['id'] }}" export="{{ route('export-simulasi-ppt') }}" />
            </div>

        </div>
    </div>

@endsection
