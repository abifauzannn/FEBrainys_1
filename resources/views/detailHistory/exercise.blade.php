@extends('layouts.template')

@section('title', 'Detail History Exercise - ' . (isset($data) ? $data['name'] : ''))

@section('meta')
    <meta name="robots" content="noindex, nofollow">
@endsection

@section('content')
    <x-nav></x-nav>

    <div class="container mx-auto px-4 sm:px-10 py-9 font-['Inter']">

        <button onclick="window.location='{{ route('history') }}'" class="mb-6">
            <div class="flex items-center">
                <img src="{{ URL('images/back.svg') }}" alt="Back" class="w-6 h-6">
                <div class="text-black text-base font-semibold ml-2">Kembali</div>
            </div>
        </button>

        <div class="w-full">
            <div class="text-gray-900 text-2xl font-semibold">{{ $data['name'] ?? 'Detail History Exercise' }}</div>
            <div class="mt-2 text-gray-500 text-sm leading-snug">Detail hasil generate Exercise</div>
            <div class="text-slate-400 text-xs mt-2"> Dibuat pada
                <span
                    class="text-gray-900 font-bold">{{ date('d F Y | H:i', strtotime($data['created_at'] ?? now())) }}</span>
            </div>
        </div>

        <div class="mt-8">
            <div class="text-gray-900 text-lg font-bold bg-gray-100 px-2 py-2">Informasi Umum</div>
            <div class="mt-2">
                <table class="w-full">
                    <tbody>
                        @foreach ($data['output_data']['informasi_umum'] ?? [] as $key => $value)
                            <tr>
                                <td class="py-1 text-sm w-[200px]">{{ ucwords(str_replace('_', ' ', $key)) }}</td>
                                <td class="py-1 text-sm">: {{ $value }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @if (!empty($data['output_data']['soal_pilihan_ganda']))
                <div class="w-full overflow-x-auto my-4">
                    @foreach ($data['output_data']['soal_pilihan_ganda'] as $index => $question)
                        <div class="mt-4 px-6 py-4 bg-slate-50">
                            <p class="text-gray-800 dark:text-gray-200 text-sm"><strong>{{ $index + 1 }}.</strong>
                                {{ $question['question'] }}</p>
                            <ul>
                                @foreach ($question['options'] as $key => $option)
                                    <li class="text-gray-800 dark:text-gray-200 ml-4 py-1 text-sm">
                                        {{ $key }} {{ $option }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endforeach
                </div>
            @endif

            @if (!empty($data['output_data']['soal_essay']))
                <div class="overflow-x-auto my-4">
                    <table class="w-full">
                        <thead class="bg-slate-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-sm font-bold text-gray-800 uppercase">No.</th>
                                <th class="px-6 py-3 text-left text-sm font-bold text-gray-800 uppercase">Pertanyaan</th>
                                <th class="px-6 py-3 text-left text-sm font-bold text-gray-800 uppercase">Instruksi</th>
                                @if (isset($data['output_data']['soal_essay'][0]['kriteria_penilaian']))
                                    <th class="px-6 py-3 text-left text-sm font-bold text-gray-800 uppercase">Kriteria
                                        Penilaian</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach ($data['output_data']['soal_essay'] as $index => $soal)
                                <tr>
                                    <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200">{{ $index + 1 }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200">{{ $soal['question'] }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200">
                                        {{ $soal['instructions'] }}</td>
                                    @if (isset($soal['kriteria_penilaian']))
                                        <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200">
                                            <ul>
                                                @foreach ($soal['kriteria_penilaian'] as $kriteria => $value)
                                                    <li>{{ $kriteria + 1 }}. {{ $value }}</li>
                                                @endforeach
                                            </ul>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>

        <div class="py-4">
            <x-export-word generateId="{{ $data['id'] ?? '' }}" export="{{ route('export-essay') }}" />
        </div>

    </div>
@endsection
