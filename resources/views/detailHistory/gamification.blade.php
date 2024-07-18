@extends('layouts.template')

@section('title', 'Detail History Gamifikasi - Brainys')


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
            <div class="text-gray-900 text-2xl font-semibold">{{ $gamifikasiHistory['name'] }}</div>
            <div class="mt-2 text-gray-500 text-sm leading-snug">Detail hasil Generate Gamifikasi</div>
            <div class="text-slate-400 text-xs mt-2"> Dibuat pada <span
                    class="text-gray-900 font-bold">{{ date('d F Y | H:i', strtotime($gamifikasiHistory['created_at'])) }}
                </span>
            </div>
        </div>

        <div class="mt-8">
            <div class="text-gray-900 text-lg font-bold bg-gray-100 px-2 py-2">Informasi Umum</div>
            <div class="mt-2">
                <table class="w-full">
                    <tbody>
                        @foreach ($gamifikasiHistory['output_data']['informasi_umum'] as $key => $value)
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

            <div class="text-gray-900 text-lg font-bold bg-gray-100 px-2 py-2 mt-5">Pendahuluan</div>
            <div class="mt-2">
                <table class="w-full">
                    <tbody class="">
                        <tr>
                            <td class="py-1 text-sm w-[200px]">
                                Soal Quiz
                            </td>
                            <td class="px-1 py-1 text-sm text-gray-800 dark:text-gray-200">
                                : {{ $gamifikasiHistory['output_data']['tema'] }}
                            </td>
                        </tr>
                        <tr>
                            <td class="py-1 text-sm w-[200px]">
                                Evaluasi
                            </td>
                            <td class="px-1 py-1 text-sm text-gray-800 dark:text-gray-200">
                                : {{ $gamifikasiHistory['output_data']['konsep_utama'] }}
                            </td>
                        </tr>
                        <tr>
                            <td class="py-1 text-sm w-[200px]">
                                Skema Game
                            </td>
                            <td class="px-1 py-1 text-sm text-gray-800 dark:text-gray-200">
                                : {{ $gamifikasiHistory['output_data']['skema_game'] }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="text-gray-900 text-lg font-bold bg-gray-100 px-2 py-2 mt-5">Elemen Gamifikasi</div>
            <div class="mt-2">
                <table class="w-full">
                    <tbody class="">
                        @foreach ($gamifikasiHistory['output_data']['elemen_gamifikasi'] as $element)
                            <tr>
                                <td class="py-1 text-sm w-[200px]">
                                    {{ $element['judul'] }}
                                </td>
                                <td class="px-1 py-1 text-sm text-gray-800 dark:text-gray-200">
                                    : {{ $element['deskripsi'] }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="text-gray-900 text-lg font-bold bg-gray-100 px-2 py-2 mt-5">Misi dan Tantangan</div>
            <div class="mt-2">
                <table class="w-full divide-y divide-gray-200">
                    <thead>
                        <tr>

                            <th class="px-1 text-left text-sm font-semibold text-gray-800 dark:text-gray-200">Jenis
                            </th>
                            <th class="px-1 text-left text-sm font-semibold text-gray-800 dark:text-gray-200">Deskripsi
                            </th>
                            <th class="px-1 text-left text-sm font-semibold text-gray-800 dark:text-gray-200">Poin</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($gamifikasiHistory['output_data']['misi_dan_tantangan'] as $mission)
                            <tr>
                                <td class="px-1 py-1 text-sm text-gray-800 dark:text-gray-200">
                                    {{ $mission['jenis'] }}
                                </td>
                                <td class="px-1 py-1 text-sm text-gray-800 dark:text-gray-200">
                                    {{ $mission['deskripsi'] }}
                                </td>
                                <td class="px-1 py-1 text-sm text-gray-800 dark:text-gray-200">
                                    {{ $mission['poin'] }} poin
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="text-gray-900 text-lg font-bold bg-gray-100 px-2 py-2 mt-5">Langkah Implementasi</div>
            <div class="mt-2">
                <table class="w-full">
                    <tbody class="divide-y divide-gray-200">
                        @foreach ($gamifikasiHistory['output_data']['langkah_implementasi'] as $step)
                            <tr>
                                <td class="px-1 py-1 text-sm text-gray-800 dark:text-gray-200 font-semibold">
                                    Langkah {{ $step['langkah'] }}
                                </td>
                                <td class="px-1 py-1 text-sm text-gray-800 dark:text-gray-200">
                                    {{ $step['judul'] }}
                                </td>
                                <td class="px-1 py-1 text-sm text-gray-800 dark:text-gray-200 ">
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

            <div class="flex flex-row gap-3 py-7">
                <form action="{{ route('export-gamifikasi-word') }}" method="post">
                    @csrf
                    <input type="hidden" name="generate_id" value="{{ $gamifikasiHistory['id'] }}">
                    <button type="submit" class="flex items-center bg-green-600 px-4 py-3 rounded-lg text-white">
                        <svg class="w-5 h-5 mb-[9px]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M14.707 7.793a1 1 0 0 0-1.414 0L11 10.086V1.5a1 1 0 0 0-2 0v8.586L6.707 7.793a1 1 0 1 0-1.414 1.414l4 4a1 1 0 0 0 1.416 0l4-4a1 1 0 0 0-.002-1.414Z" />
                            <path
                                d="M18 12h-2.55l-2.975 2.975a3.5 3.5 0 0 1-4.95 0L4.55 12H2a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-4a2 2 0 0 0-2-2Zm-3 5a1 1 0 1 1 0-2 1 1 0 0 1 0 2Z" />
                        </svg>
                        <span class="ml-3 font-bold font-['Inter']">Download File Word</span>
                    </button>
                </form>
                <form action="{{ route('export-gamifikasi-ppt') }}" method="post">
                    @csrf
                    <input type="hidden" name="generate_id" value="{{ $gamifikasiHistory['id'] }}">
                    <button type="submit" class="flex items-center bg-blue-600 px-4 py-3 rounded-lg text-white">
                        <svg class="w-5 h-5 mb-[9px]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M14.707 7.793a1 1 0 0 0-1.414 0L11 10.086V1.5a1 1 0 0 0-2 0v8.586L6.707 7.793a1 1 0 1 0-1.414 1.414l4 4a1 1 0 0 0 1.416 0l4-4a1 1 0 0 0-.002-1.414Z" />
                            <path
                                d="M18 12h-2.55l-2.975 2.975a3.5 3.5 0 0 1-4.95 0L4.55 12H2a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-4a2 2 0 0 0-2-2Zm-3 5a1 1 0 1 1 0-2 1 1 0 0 1 0 2Z" />
                        </svg>
                        <span class="ml-3 font-bold font-['Inter']">Download File PPT</span>
                    </button>
                </form>
            </div>


        </div>
    @endsection
