<div class="mb-4">
    <label for={{ $id }}>{{ $label }}</label>
    <button data-tooltip-target="{{ $tooltipId }}" data-tooltip-placement="right" data-tooltip-trigger="click"
        type="button"
        class="text-gray-600 transition-colors duration-200 focus:outline-none dark:text-gray-200 dark:hover:text-blue-400 hover:text-blue-500">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
            class="w-4 h-4">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9 5.25h.008v.008H12v-.008z" />
        </svg>
    </button>
    <div id="{{ $tooltipId }}" role="tooltip"
        class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-sm opacity-0 w-36 tooltip dark:bg-gray-700">
        {{ $tooltipText }}
        <div class="tooltip-arrow" data-popper-arrow></div>
    </div>
    <textarea id="{{ $id }}" name="{{ $name }}"
        class="shdaow-sm w-full p-3 border border-gray-300 rounded-md mt-[10px] placeholder:text-gray-400 text-[16px] font-normal font-['Inter'] leading-normal"
        placeholder="{{ $placeholder }}" maxlength="250" oninput="updateCharacterCount(this)" required></textarea>

</div>
