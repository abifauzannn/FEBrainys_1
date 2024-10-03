@extends('generates.generatesAtp')

@section('title', 'Templat Alur Tujuan Pembelajaran - Brainys')

@section('meta')
    <meta name="robots" content="noindex, nofollow">
@endsection

@section('output')

    @php
        $data = session('data');
        $generateId = session('generateId');
        $userLimit = session('userLimit');
    @endphp
    @isset($data)
        @isset($data['informasi_umum'])
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
                                    @if (is_array($value))
                                        <ul class="list-disc pl-5">
                                            @foreach ($value as $item)
                                                @if (is_array($item))
                                                    <li>
                                                        @foreach ($item as $key => $val)
                                                            <strong>
                                                                {{ str_replace(' ', ' ', ucwords(str_replace('_', ' ', $key))) }}
                                                                :</strong> {{ $val }}<br>
                                                        @endforeach
                                                    </li>
                                                @else
                                                    <li>{{ $item }}</li>
                                                @endif
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
        @endisset

        @if (!empty($data['alur']))
            <div class="overflow-x-auto py-5">
                <table class="w-full">
                    <thead class="bg-slate-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-sm font-bold text-gray-800 uppercase">No</th>
                            <th class="px-6 py-3 text-left text-sm font-bold text-gray-800 uppercase">Tujuan Pembelajaran</th>
                            <th class="px-6 py-3 text-left text-sm font-bold text-gray-800 uppercase">Kata/Frase Kunci</th>
                            <th class="px-6 py-3 text-left text-sm font-bold text-gray-800 uppercase">Profil Pelajar Pancasila
                            </th>
                            <th class="px-6 py-3 text-left text-sm font-bold text-gray-800 uppercase">Glorasium</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach ($data['alur'] as $item)
                            <tr>
                                <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200 font-semibold bg-slate-50">
                                    {{ $item['no'] }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200">
                                    {{ $item['tujuan_pembelajaran'] ?? '' }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200">
                                    <ul class="list-disc pl-5">
                                        @foreach ($item['kata_frase_kunci'] as $kata_frase)
                                            <li>{{ $kata_frase ?? '' }}</li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200">
                                    <ul class="list-disc pl-5">
                                        @foreach ($item['profil_pelajar_pancasila'] as $profil)
                                            <li>{{ $profil ?? '' }}</li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200">
                                    {{ $item['glosarium'] ?? '' }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif

        <div class="flex flex-col mb-3 px-6 py-4">
            <x-output-banner />
            <div class="flex flex-row gap-3">
                <x-export-word generateId="{{ $generateId }}" export="{{ route('export-atp-word') }}" />
                <x-export-excel generateId="{{ $generateId }}" export="{{ route('export-atp-excel') }}" />
            </div>


        </div>
    @endisset

    @if (isset($data))
        <script>
            document.getElementById('output').style.display = 'none';
            document.getElementById('imageBox').classList.remove('my-8');
        </script>
    @endif
@endsection
