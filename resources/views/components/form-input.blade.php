<div class="relative mb-4">
    <label for="{{ $id }}"
        class="text-gray-900 text-base font-['Inter'] leading-normal mb-[30px] font-semibold tracking-wider">
        {{ $label }}
    </label>
    <input type="{{ $type }}" id="{{ $id }}" name="{{ $name }}"
        class="w-full p-2 border rounded-md mt-[10px] placeholder:text-gray-400 text-base font-normal font-['Inter'] leading-normal"
        placeholder="{{ $placeholder }}" required>

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
