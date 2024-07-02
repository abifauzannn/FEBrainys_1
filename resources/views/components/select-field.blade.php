@props(['id', 'name', 'label', 'options', 'defaultOption' => ''])

<div class="mb-4">
    <label for="{{ $id }}"
        class="text-gray-900 text-base font-['Inter'] mb-[30px] leading-normal font-semibold">{{ $label }}</label>
    <select id="{{ $id }}" name="{{ $name }}"
        class="mt-[10px] shadow appearance-none border-gray-300 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
        required>
        <option value="" disabled hidden {{ !old($name) && !(session('user')[$name] ?? '') ? 'selected' : '' }}>
            {{ $defaultOption }}</option>
        @foreach ($options as $option)
            <option value="{{ $option['value'] }}" class="font-['Inter'] text-base "
                {{ (old($name) ?? (session('user')[$name] ?? '')) == $option['value'] ? 'selected' : '' }}>
                {{ $option['label'] }}</option>
        @endforeach
    </select>
</div>
