@extends('layouts.template')

@section('title', 'Detail History Bahan Ajar - Brainys')


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
            <div class="text-gray-900 text-2xl font-semibold">{{ $bahanAjarHistory['name'] }}</div>
            <div class="mt-2 text-gray-500 text-sm leading-snug">Detail hasil Generate Bahan Ajar</div>
            <div class="text-slate-400 text-xs mt-2"> Dibuat pada <span
                    class="text-gray-900 font-bold">{{ date('d F Y | H:i', strtotime($bahanAjarHistory['created_at'])) }}
                </span>
            </div>
        </div>

        <div class="mt-8">
            <div class="text-gray-900 text-lg font-bold bg-gray-100 px-2 py-2">Informasi Umum</div>
            <div class="mt-2">
                <table class="w-full">
                    <tbody>
                        @foreach ($bahanAjarHistory['generate_output']['informasi_umum'] as $key => $value)
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
                    <tbody>
                        @foreach ($bahanAjarHistory['generate_output']['pendahuluan'] as $key => $value)
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

            <div class="text-gray-900 text-lg font-bold bg-gray-100 px-2 py-2 mt-5">Materi</div>
            <div class="mt-2">
                <table class="w-full">
                    <tbody>
                        @foreach ($bahanAjarHistory['generate_output']['konten'] as $konten)
                            <tr>
                                <td class="py-1 text-sm w-[200px] font-semibold">{{ $konten['nama_konten'] }}</td>
                                <td class="px-1 py-4 text-sm text-gray-800 dark:text-gray-200">
                                    : {{ $konten['isi_konten'] }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="text-gray-900 text-lg font-bold bg-gray-100 px-2 py-2 mt-5">Studi Kasus</div>
            <div class="mt-2">
                <table class="w-full">
                    <tbody>
                        @foreach ($bahanAjarHistory['generate_output']['studi_kasus'] as $konten)
                            <tr>
                                <td class="py-1 text-sm w-[200px] font-semibold">{{ $konten['nama_studi_kasus'] }}</td>
                                <td class="px-1 py-4 text-sm text-gray-800 dark:text-gray-200">
                                    : {{ $konten['isi_studi_kasus'] }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="text-gray-900 text-lg font-bold bg-gray-100 px-2 py-2 mt-5">Quiz & Evaluasi</div>
            <div class="mt-2">
                <table class="w-full">
                    <tbody>
                        @foreach ($bahanAjarHistory['generate_output']['quiz'] as $key => $value)
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
                        @foreach ($bahanAjarHistory['generate_output']['evaluasi'] as $key => $value)
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

            <div class="text-gray-900 text-lg font-bold bg-gray-100 px-2 py-2 mt-5">Sumber Referensi</div>
            <div class="mt-2">
                <table class="w-full">
                    <tbody>
                        @foreach ($bahanAjarHistory['generate_output']['lampiran'] as $key => $value)
                            <tr>

                                <td class="px-1 py-1 text-sm text-gray-800 dark:text-gray-200">
                                    @if (is_array($value))
                                        <ul class="list-disc pl-5">
                                            @foreach ($value as $item)
                                                <li>{{ $item }}</li>
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

            <div class="flex flex-row gap-3 py-7">
                <x-export-word generateId="{{ $bahanAjarHistory['id'] }}" export="{{ route('export-bahan-ajar') }}" />
                <x-export-ppt generateId="{{ $bahanAjarHistory['id'] }}" export="{{ route('export-bahanAjar-ppt') }}" />
            </div>

        </div>

    </div>


@endsection
