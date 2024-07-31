@extends('generates.generateEssay')

@section('title', 'Templat Soal - Brainys')

@section('meta')
    <meta name="robots" content="noindex, nofollow">
@endsection

@section('output')

    @isset($data)

        @if (isset($data['informasi_umum']) && !empty($data['informasi_umum']))
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-slate-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-sm font-bold text-gray-800 uppercase" colspan="2">
                                Informasi Umum
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach ($data['informasi_umum'] as $key => $value)
                            <tr>
                                <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200 font-semibold bg-slate-50">
                                    {{ str_replace(' ', ' ', ucwords(str_replace('_', ' ', $key))) }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200">
                                    {{ $value }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif

        @if (isset($data['soal_essay']) && !empty($data['soal_essay']))
            <div class="overflow-x-auto my-4">
                <table class="w-full">
                    <thead class="bg-slate-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-sm font-bold text-gray-800 uppercase">No.</th>
                            <th class="px-6 py-3 text-left text-sm font-bold text-gray-800 uppercase">Pertanyaan</th>
                            <th class="px-6 py-3 text-left text-sm font-bold text-gray-800 uppercase">Instruksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach ($data['soal_essay'] as $index => $soal)
                            <tr>
                                <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200">{{ $index + 1 }}</td>
                                <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200">{{ $soal['question'] }}</td>
                                <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200">{{ $soal['instructions'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif

        @if (isset($data['soal_pilihan_ganda']) && !empty($data['soal_pilihan_ganda']))
            <div class="w-full overflow-x-auto my-4">
                @foreach ($data['soal_pilihan_ganda'] as $index => $question)
                    <div class="mt-4 px-6 py-4 bg-slate-50">
                        <p class="text-gray-800 dark:text-gray-200"><strong>{{ $index + 1 }}.</strong>
                            {{ $question['question'] }}</p>
                        <ul>
                            @foreach ($question['options'] as $key => $option)
                                <li class="text-gray-800 dark:text-gray-200 ml-4 py-1">
                                    {{ $key }} {{ $option }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endforeach
            </div>
        @endif

        @if (isset($generateId) && isset($data['soal_essay']) && !empty($data['soal_essay']))
            <div class="mb-3 px-6 py-4">
                <x-export-word generateId="{{ $generateId }}" export="{{ route('export-essay') }}" />
            </div>
        @endif

    @endisset
@endsection
