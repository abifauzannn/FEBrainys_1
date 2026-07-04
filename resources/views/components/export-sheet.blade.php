@props(['export', 'generateId'])

<form action="{{ $export }}" method="post" target="_blank">
    @csrf
    <input type="hidden" name="generate_id" value="{{ $generateId }}">
    <button type="submit" class="flex items-center bg-[#11A553] px-4 py-3 rounded-lg text-white">
        <svg class="w-5 h-5 mb-[9px]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20"
            stroke-width="1.5" stroke="currentColor" class="size-6">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M9 4.5v15m6-15v15m-10.875 0h15.75c.621 0 1.125-.504 1.125-1.125V5.625c0-.621-.504-1.125-1.125-1.125H4.125C3.504 4.5 3 5.004 3 5.625v12.75c0 .621.504 1.125 1.125 1.125Z" />
        </svg>

        <span class="ml-3 font-['Inter']">Buka Spreadsheet</span>
    </button>
</form>
