<div class="mb-4">
    <label for="{{ $id }}"
        class="text-gray-900 text-base font-['Inter'] leading-normal font-semibold">{{ $label }}</label>
    <select id="{{ $id }}" name="{{ $id }}"
        class="bg-white shadow-sm border border-gray-300 mt-[10px] text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 font-['Inter']"
        required>
        <option value="" selected disabled class="text-xs lg:text-sm">{{ $defaultOption }}</option>
        @foreach ($options as $option)
            <option value="{{ $option['value'] }}" class="text-xs lg:text-sm">{{ $option['label'] }}</option>
        @endforeach
    </select>
</div>
