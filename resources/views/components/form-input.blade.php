@props([
    'id',
    'name',
    'type' => 'text',
    'label',
    'placeholder' => '',
    'value' => '',
    'required' => false,
    'disabled' => false,
])

<div class="relative mb-4">
    <label for="{{ $id }}" class="text-gray-900 text-base font-['Inter'] leading-normal font-semibold">
        {{ $label }}
    </label>
    <input type="{{ $type }}" id="{{ $id }}" name="{{ $name }}"
        class="w-full p-3  border border-gray-300  shadow-sm text-gray-600 rounded-md mt-[10px] placeholder:text-gray-400 text-[16px] font-['Inter'] leading-normal focus:border-blue-600 focus:border-2 focus:outline-none"
        placeholder="{{ $placeholder }}" value="{{ $value ?? '' }}" {{ $required ? 'required' : '' }}
        {{ $disabled ? 'disabled' : '' }}>

    @if ($type == 'password')
        <button type="button" class="absolute right-0 top-[48px] flex items-center mr-3 focus:outline-none"
            onclick="togglePasswordVisibility('{{ $id }}')">
            <img src="{{ URL('images/group.svg') }}" alt="" loading="lazy">
        </button>
    @endif
</div>

<script>
    function togglePasswordVisibility(id) {
        const passwordField = document.getElementById(id);
        const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordField.setAttribute('type', type);
    }
</script>
