<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Log In Page</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
</head>

<body>

    @if (!session()->has('user'))
        @php
            header('Location: ' . route('login'), true, 302);
            exit();
        @endphp
    @endif

    <div class="container w-full mx-auto px-4 py-3 justify-center bg-white border-b border-zinc-200 font-['Inter']">
        <div class="flex justify-between h-45 items-center">
            <div>
                <a href="/dashboard"><img src="{{ URL('images/newlogo.png') }}" alt=""
                        class="w-[140px] object-cover"></a>
            </div>
            <div class="flex items-center space-x-4">
                <div class="hidden md:block mt-1">
                    <div class="relative">
                        <!-- Tombol untuk menampilkan dropdown -->
                        <button id="notificationButton"
                            class="w-[30px] h-[30px] bg-white rounded-[5px] border border-zinc-200 justify-center items-center inline-flex">
                            <svg class="w-5 h-5 fill-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 14 20">
                                <path
                                    d="M12.133 10.632v-1.8A5.406 5.406 0 0 0 7.979 3.57.946.946 0 0 0 8 3.464V1.1a1 1 0 0 0-2 0v2.364a.946.946 0 0 0 .021.106 5.406 5.406 0 0 0-4.154 5.262v1.8C1.867 13.018 0 13.614 0 14.807 0 15.4 0 16 .538 16h12.924C14 16 14 15.4 14 14.807c0-1.193-1.867-1.789-1.867-4.175ZM3.823 17a3.453 3.453 0 0 0 6.354 0H3.823Z" />
                            </svg>
                        </button>

                        <!-- Dropdown -->
                        <div id="notificationDropdown"
                            class="absolute mt-[19px] w-48 bg-white rounded-lg border border-gray-200 shadow-md transform translate-x-1/4 right-8 max-h-[150px] overflow-y-auto hidden z-10">
                            <div class="py-1">
                                <!-- Contoh item notifikasi -->
                                <a href="#"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Notification 1</a>
                                <a href="#"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Notification 2</a>
                                <a href="#"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Notification 3</a>
                                <a href="#"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Notification 3</a>
                                <a href="#"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Notification 3</a>
                                <a href="#"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Notification 3</a>
                                <a href="#"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Notification 3</a>
                                <a href="#"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Notification 3</a>
                                <!-- Tambahkan lebih banyak item di sini jika perlu -->
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex-col items-start hidden md:block">
                    <div class="text-gray-900 text-base font-medium font-inter leading-normal">
                        {{ session('user')['name'] }}</div>
                    <div class="text-gray-500 text-sm font-normal font-inter leading-snug">
                        {{ session('user')['profession'] }}</div>
                </div>

                @php
                    $fullName = session('user')['name'];
                    $initials = '';
                    $names = explode(' ', $fullName);
                    foreach ($names as $name) {
                        $initials .= strtoupper(substr($name, 0, 1));
                    }

                    // URL to DiceBear Avatars API with initials as parameter
                    $avatarUrl =
                        'https://api.dicebear.com/7.x/initials/svg?scale=75&backgroundColor=b6e3f4&seed=' . $initials;
                @endphp

                <img src="{{ $avatarUrl }}" alt="Profile Picture" class="w-12 h-12 rounded-full">


                <div class="relative">
                    <img src="{{ URL('images/dropdown.svg') }}" alt="" id="profileButton"
                        class="cursor-pointer">
                    <div id="profileDropdown"
                        class="absolute right-8 mt-[31px] border bg-white rounded-lg shadow p-3 transform translate-x-1/4 hidden w-48 z-10">
                        <div class="md:hidden">
                            <div class="text-gray-900 text-base font-medium font-inter leading-normal">
                                {{ session('user')['name'] }}
                            </div>
                            <div class="text-gray-500 text-sm font-normal font-inter leading-snug mb-[4px]">
                                {{ session('user')['profession'] }}</div>
                            <hr class="w-full">
                        </div>
                        <ul class="">
                            <li class="flex items-center hover:bg-gray-100 hover:rounded-lg px-1">
                                <img src="{{ URL('images/user-circle.png') }}" alt="" class="w-[20px] h-[20px]">
                                <a href="{{ route('userProfile') }}"
                                    class="block px-2 py-2 text-sm text-slate-500">Profile
                                    Pengguna</a>
                            </li>
                            <li class="flex items-center  hover:bg-gray-100 hover:rounded-lg px-1">
                                <img src="{{ URL('images/alarm.svg') }}" alt="" class="w-[18px] h-[20px]"
                                    onclick="test()">
                                <a href="{{ route('history') }}"
                                    class="block px-[10px] py-2 text-sm text-slate-500">Notification</a>
                            </li>
                            <li class="flex items-center  hover:bg-gray-100 hover:rounded-lg px-1">
                                <img src="{{ URL('images/Union.png') }}" alt="" class="w-[18px] h-[20px]">
                                <a href="{{ route('history') }}"
                                    class="block px-[10px] py-2 text-sm text-slate-500">Riwayat</a>
                            </li>
                            <li class="flex items-center  hover:bg-gray-100 hover:rounded-lg px-1">
                                <img src="{{ URL('images/sign-out.svg') }}" alt="" class="w-[20px] h-[20px]">
                                <form action="{{ route('logout') }}" method="get">
                                    @csrf
                                    <button type="submit"
                                        class="w-full text-start block px-2 py-2 text-sm  hover:bg-gray-100 hover:rounded-lg text-slate-500">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            const notificationButton = document.getElementById('notificationButton');
            const notificationDropdown = document.getElementById('notificationDropdown');
            const profileButton = document.getElementById('profileButton');
            const profileDropdown = document.getElementById('profileDropdown');

            notificationButton.addEventListener('click', () => {
                notificationDropdown.classList.toggle('hidden');
            });

            document.addEventListener('click', (event) => {
                if (!notificationButton.contains(event.target) && !notificationDropdown.contains(event
                        .target)) {
                    notificationDropdown.classList.add('hidden');
                }
            });

            profileButton.addEventListener('click', () => {
                profileDropdown.classList.toggle('hidden');
            });

            document.addEventListener('click', (event) => {
                if (!profileButton.contains(event.target) && !profileDropdown.contains(event.target)) {
                    profileDropdown.classList.add('hidden');
                }
            });
        });
    </script>
</body>

</html>
