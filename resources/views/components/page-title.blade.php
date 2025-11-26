<div class="container relative px-4 py-6 mx-auto sm:px-10 sm:py-9">
    <button onclick="window.location='{{ $url }}'" class="mb-6">
        <div class="flex items-cente">
            <img src="{{ URL('images/back.svg') }}" alt="" class="w-6 h-6" loading="lazy">
            <div class="ml-2 text-base font-semibold text-black">Kembali</div>
        </div>
    </button>

    <div class="w-full mb-6">
        <div class="text-gray-900 text-2xl font-semibold font-['Inter']">{{ $title }}</div>
        <div class="mt-2 text-sm leading-snug text-gray-500">{{ $description }}</div>
    </div>


    @if (session('user')['school_level'] == '')
        <x-alert-jenjang />
    @endif
</div>
