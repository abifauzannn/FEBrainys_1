@extends('generates.generateKisi')

@section('title', 'Templat Gamifikasi - Brainys')

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
                        @php
                            $informasiUmumOrder = [
                                'nama_kisi_kisi' => 'Nama Kisi-kisi',
                                'penyusun' => 'Nama Penyusun',
                                'instansi' => 'Satuan Pendidikan',
                                'kelas' => 'Fase/Kelas',
                                'mata_pelajaran' => 'Mata Pelajaran',
                                'alokasi_waktu' => 'Alokasi Waktu',
                                'kompetensi_awal' => 'Kompetensi Awal',
                                'elemen_capaian' => 'Elemen Capaian',
                                'capaian_pembelajaran_redaksi' => 'Capaian Pembelajaran',
                                'pokok_materi' => 'Pokok Materi',
                                'tahun_penyusunan' => 'Tahun Penyusunan',
                            ];
                        @endphp

                        @foreach ($informasiUmumOrder as $key => $label)
                            @if (isset($data['informasi_umum'][$key]))
                                <tr>
                                    <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200 font-semibold bg-slate-50">
                                        {{ $label }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200">
                                        {{ is_array($data['informasi_umum'][$key]) ? json_encode($data['informasi_umum'][$key]) : htmlspecialchars($data['informasi_umum'][$key]) }}
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif


        @if (isset($data['kisi_kisi']) && !empty($data['kisi_kisi']))
            <div class="overflow-x-auto py-5">
                <table class="w-full">
                    <thead class="bg-slate-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-sm font-bold text-gray-800 uppercase" colspan="3">
                                Misi dan Tantangan
                            </th>
                        </tr>
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
                        @foreach ($data['kisi_kisi'] as $mission)
                            <tr>
                                <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200 font-semibold bg-slate-50">
                                    {{ $mission['nomor'] }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200">
                                    {{ $mission['indikator_soal'] }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200">
                                    {{ $mission['no_soal'] }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif

        @if (isset($generateId) && !empty($data['kisi_kisi']))
            <div class="flex flex-col mb-3 px-6 py-4">

                <x-output-banner />
                <div class="flex flex-row gap-3">
                    <x-export-word generateId="{{ $generateId }}" export="{{ route('export-kisi-kisi-word') }}" />
                    <x-export-excel generateId="{{ $generateId }}" export="{{ route('export-kisi-kisi-excel') }}" />
                </div>

            </div>
        @endif
    @endisset

    @if (isset($data))
        <script>
            document.getElementById('output').style.display = 'none';
            document.getElementById('imageBox').classList.remove('my-8');
        </script>
    @endif
@endsection
