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
            <div class="flex flex-row gap-3 mb-3 px-6 py-4">
                <form action="{{ route('export-kisi-kisi-word') }}" method="post">
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
                <form action="{{ route('export-kisi-kisi-excel') }}" method="post">
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
        @endif
    @endisset

    @if (isset($data))
        <script>
            document.getElementById('output').style.display = 'none';
            document.getElementById('imageBox').classList.remove('my-8');
        </script>
    @endif
@endsection
