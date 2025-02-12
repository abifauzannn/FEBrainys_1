@props(['onclick', 'icon', 'title', 'description', 'status'])

<button onclick="{{ $onclick }}"
    class="p-4 rounded-lg border border-gray-300 hover:bg-slate-50 transition duration-300 ease-in-out flex flex-col items-start text-left shadow-md">
    <div class="flex justify-between items-center w-full">
        <img src="{{ $icon }}" alt="" class="w-10 h-10">
        @if ($status === 'baru')
            <span class="bg-[#88F2C8] text-black text-xs font-bold px-2 py-1 rounded-full -mt-5">BARU</span>
        @endif
    </div>
    <div class="py-2 w-full text-left">
        <div class="text-gray-900 text-base font-bold font-inter leading-normal">
            {{ $title }}
        </div>
    </div>
    <div class="text-black text-xs font-normal font-inter leading-normal w-full text-left">
        {{ $description }}
    </div>
</button>
