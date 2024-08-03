@extends('generates.generatesAtp')

@section('title', 'Templat Alur Tujuan Pembelajaran - Brainys')

@section('meta')
    <meta name="robots" content="noindex, nofollow">
@endsection

@section('output')
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
                                    {{ $item['glorasium'] }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif

        <div class="flex flex-row gap-3 mb-3 px-6 py-4">
            <form action="{{ route('export-atp-word') }}" method="post">
                @csrf
                <input type="hidden" name="generate_id" value="{{ $generateId }}">
                <button type="submit" class="flex items-center bg-green-600 px-4 py-3 rounded-lg text-white">
                    <svg class="w-5 h-5 mb-[9px]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                        viewBox="0 0 20 20">
                        <path
                            d="M14.707 7.793a1 1 0 0 0-1.414 0L11 10.086V1.5a1 1 0 0 0-2 0v8.586L6.707 7.793a1 1 0 1 0-1.414 1.414l4 4a1 1 0 0 0 1.416 0l4-4a1 1 0 0 0-.002-1.414Z" />
                        <path
                            d="M18 12h-2.55l-2.975 2.975a3.5 3.5 0 0 1-4.95 0L4.55 12H2a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-4a2 2 0 0 0-2-2Zm-3 5a1 1 0 1 1 0-2 1 1 0 0 1 0 2Z" />
                    </svg>
                    <span class="ml-3 font-bold font-['Inter']">Download File Word</span>
                </button>
            </form>
            <form action="{{ route('export-atp-excel') }}" method="post">
                @csrf
                <input type="hidden" name="generate_id" value="{{ $generateId }}">
                <button type="submit" class="flex items-center bg-blue-600 px-4 py-3 rounded-lg text-white">
                    <svg class="w-5 h-5 mb-[9px]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                        viewBox="0 0 20 20">
                        <path
                            d="M14.707 7.793a1 1 0 0 0-1.414 0L11 10.086V1.5a1 1 0 0 0-2 0v8.586L6.707 7.793a1 1 0 1 0-1.414 1.414l4 4a1 1 0 0 0 1.416 0l4-4a1 1 0 0 0-.002-1.414Z" />
                        <path
                            d="M18 12h-2.55l-2.975 2.975a3.5 3.5 0 0 1-4.95 0L4.55 12H2a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-4a2 2 0 0 0-2-2Zm-3 5a1 1 0 1 1 0-2 1 1 0 0 1 0 2Z" />
                    </svg>
                    <span class="ml-3 font-bold font-['Inter']">Download File Excel</span>
                </button>
            </form>
        </div>
    @endisset

    <script>
        document.getElementById('output').style.display = 'none';
    </script>
@endsection
