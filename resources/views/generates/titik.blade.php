<div class="overflow-x-auto">
    <table class="w-full">
        <thead class=" bg-slate-50">
            <tr>
                <th class="px-6 py-3 text-left text-sm font-bold text-gray-800 uppercase" colspan="2">
                    Silabus Pembelajaran</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            <tr class="">
                <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200 font-semibold bg-slate-50">
                    Mata Pelajaran</td>
                <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200">
                    {{ $data['silabus_pembelajaran']['mata_pelajaran'] }}
                </td>
            </tr>
            <tr class="">
                <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200 font-semibold bg-slate-50">
                    Tingkat Kelas</td>
                <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200">
                    {{ $data['silabus_pembelajaran']['tingkat_kelas'] }}
                </td>
            </tr>
            <tr class="">
                <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200 font-semibold bg-slate-50">
                    Alokasi Waktu</td>
                <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200">
                    {{ $data['silabus_pembelajaran']['alokasi_waktu'] }}
                </td>
            </tr>
            <tr class="">
                <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200 font-semibold bg-slate-50">
                    Kompetensi Inti</td>
                <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200">
                    <ul>
                        @foreach ($data['silabus_pembelajaran']['kompetensi_inti'] as $ki)
                            <li>{{ $ki }}</li>
                        @endforeach
                    </ul>
                </td>
            </tr>
            <tr class="">
                <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200 font-semibold bg-slate-50">
                    Definisi Kompetensi Inti</td>
                <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200">
                    {{ $data['silabus_pembelajaran']['definisi_kompetensi_inti'] }}
                </td>
            </tr>
        </tbody>
    </table>
</div>


<div class="overflow-x-auto mt-4">
    <table class="w-full">
        <tbody class="divide-y divide-gray-200">
            <tr>
                <td class="px-3 py-4 text-sm text-gray-800 dark:text-gray-200 font-semibold bg-slate-50">
                    Kompetensi Dasar</td>
                <td class="px-3 py-4 text-sm text-gray-800 dark:text-gray-200 font-semibold bg-slate-50">
                    Materi Pembelajaran</td>
                <td class="px-3 py-4 text-sm text-gray-800 dark:text-gray-200 font-semibold bg-slate-50">
                    Kegiatan Pembelajaran</td>
            </tr>
            @foreach ($data['silabus_pembelajaran']['inti_silabus'] as $silabus)
                <tr class="">
                    <td class="px-3 py-4 text-sm text-gray-800 dark:text-gray-200">
                        <ul>
                            @foreach ($silabus['kompetensi_dasar'] as $index => $kd)
                                <li>{{ $index + 1 }}. {{ $kd }}</li>
                            @endforeach
                        </ul>
                    </td>
                    <td class="px-3 py-4 text-sm text-gray-800 dark:text-gray-200">
                        <ul>
                            @foreach ($silabus['materi_pembelajaran'] as $index => $materi)
                                <li>{{ $index + 1 }}. {{ $materi }}</li>
                            @endforeach
                        </ul>
                    </td>
                    <td class="px-3 py-4 text-sm text-gray-800 dark:text-gray-200">
                        <ul>
                            @foreach ($silabus['kegiatan_pembelajaran'] as $index => $kegiatan)
                                <li>{{ $index + 1 }}. {{ $kegiatan }}</li>
                            @endforeach
                        </ul>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="mb-3 px-6 py-4">
    <form action="{{ route('export-word-syllabus') }}" method="post">
        @csrf
        <input type="hidden" name="generate_id" value="{{ $generateId }}">
        <button type="submit" class="flex items-center bg-green-600 px-4 py-3 rounded-lg text-white">
            <svg class="w-5 h-5 mb-[9px] " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                viewBox="0 0 20 20">
                <path
                    d="M14.707 7.793a1 1 0 0 0-1.414 0L11 10.086V1.5a1 1 0 0 0-2 0v8.586L6.707 7.793a1 1 0 1 0-1.414 1.414l4 4a1 1 0 0 0 1.416 0l4-4a1 1 0 0 0-.002-1.414Z" />
                <path
                    d="M18 12h-2.55l-2.975 2.975a3.5 3.5 0 0 1-4.95 0L4.55 12H2a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-4a2 2 0 0 0-2-2Zm-3 5a1 1 0 1 1 0-2 1 1 0 0 1 0 2Z" />
            </svg>
            <span class="ml-3 font-bold font-['Inter']">Download File</span>

        </button>
    </form>
</div>
