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
        class="w-full p-2 border-gray-300 shadow-sm text-gray-600 rounded-md mt-[10px] placeholder:text-gray-400 text-base font-normal font-['Inter'] leading-normal"
        placeholder="{{ $placeholder }}" value="{{ $value ?? '' }}" {{ $required ? 'required' : '' }}
        {{ $disabled ? 'disabled' : '' }}>

    @if ($type == 'password')
        <button type="button" class="absolute right-0 top-[48px] flex items-center mr-3 focus:outline-none"
            onclick="togglePasswordVisibility('{{ $id }}')">
            <img src="{{ URL('images/group.svg') }}" alt="">
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
