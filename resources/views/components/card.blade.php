<button onclick="{{ $onclick }}"
    class="p-4 rounded-lg shadow border border-gray-300 hover:bg-slate-50 transition duration-300 ease-in-out flex flex-col">
    <img src="{{ $icon }}" alt="" class="w-10 h-10">
    <div class="text-gray-900 text-lg font-bold font-inter leading-normal py-2">{{ $title }}</div>
    <div class="text-black text-xs font-normal font-inter leading-normal">{{ $description }}</div>
</button>
