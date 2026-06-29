@extends('generates.generate-simulasi')

@section('title', 'Templat Simulasi - Brainys')

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

        {{-- Informasi Umum --}}
        @if (!empty($data['informasi_umum']))
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
                                <td class="px-6 py-4 text-sm text-gray-800 font-semibold bg-slate-50 w-1/3">
                                    {{ ucwords(str_replace('_', ' ', $key)) }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-800">
                                    {{ $value }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif

        {{-- Informasi Simulasi (tema, konsep_utama, skema_game ada di root data) --}}
        @if (!empty($data['tema']) || !empty($data['konsep_utama']) || !empty($data['skema_game']))
            <div class="overflow-x-auto mt-5">
                <table class="w-full">
                    <thead class="bg-slate-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-sm font-bold text-gray-800 uppercase" colspan="2">
                                Informasi Simulasi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @if (!empty($data['tema']))
                            <tr>
                                <td class="px-6 py-4 text-sm text-gray-800 font-semibold bg-slate-50 w-1/3">
                                    Tema
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-800">
                                    {{ $data['tema'] }}
                                </td>
                            </tr>
                        @endif
                        @if (!empty($data['konsep_utama']))
                            <tr>
                                <td class="px-6 py-4 text-sm text-gray-800 font-semibold bg-slate-50 w-1/3">
                                    Konsep Utama
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-800">
                                    {{ $data['konsep_utama'] }}
                                </td>
                            </tr>
                        @endif
                        @if (!empty($data['skema_game']))
                            <tr>
                                <td class="px-6 py-4 text-sm text-gray-800 font-semibold bg-slate-50 w-1/3">
                                    Skema Game
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-800">
                                    {{ ucfirst($data['skema_game']) }}
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        @endif

        {{-- Elemen Simulasi --}}
        @if (!empty($data['elemen_simulasi']))
            <div class="overflow-x-auto mt-5">
                <table class="w-full">
                    <thead class="bg-slate-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-sm font-bold text-gray-800 uppercase" colspan="2">
                                Elemen Simulasi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach ($data['elemen_simulasi'] as $element)
                            <tr>
                                <td class="px-6 py-4 text-sm text-gray-800 font-semibold bg-slate-50 w-1/3">
                                    {{ $element['judul'] }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-800">
                                    {{ $element['deskripsi'] }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif

        {{-- Misi dan Tantangan --}}
        @if (!empty($data['misi_dan_tantangan']))
            <div class="overflow-x-auto mt-5">
                <table class="w-full">
                    <thead class="bg-slate-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-sm font-bold text-gray-800 uppercase" colspan="3">
                                Misi dan Tantangan
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach ($data['misi_dan_tantangan'] as $mission)
                            <tr>
                                <td class="px-6 py-4 text-sm text-gray-800 font-semibold bg-slate-50 w-1/4">
                                    {{ $mission['jenis'] }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-800">
                                    {{ $mission['deskripsi'] }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-800 text-center whitespace-nowrap">
                                    {{ $mission['poin'] ?? 100 }} poin
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif

        {{-- Langkah Implementasi --}}
        @if (!empty($data['langkah_implementasi']))
            <div class="overflow-x-auto mt-5">
                <table class="w-full">
                    <thead class="bg-slate-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-sm font-bold text-gray-800 uppercase" colspan="3">
                                Langkah Implementasi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach ($data['langkah_implementasi'] as $step)
                            <tr>
                                <td class="px-6 py-4 text-sm text-gray-800 font-semibold bg-slate-50 whitespace-nowrap">
                                    Langkah {{ $step['langkah'] }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-800 font-semibold w-1/4">
                                    {{ $step['judul'] }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-800">
                                    <ul class="list-disc pl-5 space-y-1">
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
        <div class="flex flex-col mb-3 px-6 py-4">
            <x-output-banner />
            <div class="flex flex-row gap-3">
                <x-export-word generateId="{{ $generateId }}" export="{{ route('export-simulasi-word') }}" />
                <x-export-ppt generateId="{{ $generateId }}" export="{{ route('export-simulasi-ppt') }}" />
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
