@props(['onclick', 'icon', 'title', 'description', 'status'])

@php
    $isDisabled = in_array($title, ['Templat Rubrik Nilai', 'Templat Persuratan']);
@endphp

<button @if (!$isDisabled) onclick="{{ $onclick }}" @endif
    class="p-4 rounded-lg border border-gray-300 transition duration-300 ease-in-out flex flex-col items-start text-left shadow-md
        {{ $isDisabled ? '' : 'hover:bg-slate-50' }}"
    {{ $isDisabled ? 'disabled' : '' }}>
    <div class="flex items-center justify-between w-full">
        <img src="{{ $icon }}" alt="" class="w-10 h-10">
        @if ($status === 'baru')
            <span class="bg-[#88F2C8] text-black text-xs font-bold px-2 py-1 rounded-full -mt-5">BARU</span>
        @endif
    </div>
    <div class="w-full py-2 text-left">
        <div class="text-base font-bold leading-normal text-gray-900 font-inter">
            {{ $title }}
        </div>
    </div>
    <div class="w-full text-xs font-normal leading-normal text-left text-black font-inter">
        {{ $description }}
    </div>
</button>
