@extends('langganan.langganan')

@section('langganan - Paket')

@section('langganan-content')

    <div class="flex justify-center items-center flex-col ">
        <div class="text-sm font-medium text-center text-gray-500 border shadow-md rounded-md">
            <ul class="flex flex-wrap -mb-px py-2 px-2">
                <li class="mr-2 flex justify-center items-center">
                    <a href="#"
                        class="flex items-center gap-2 active dashboard-tab-link p-2 rounded-md font-['Inter'] text-sm"
                        data-dashboard-tab="paket1">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6"
                            id="svg1">
                            <path fill-rule="evenodd"
                                d="M6.75 2.25A.75.75 0 0 1 7.5 3v1.5h9V3A.75.75 0 0 1 18 3v1.5h.75a3 3 0 0 1 3 3v11.25a3 3 0 0 1-3 3H5.25a3 3 0 0 1-3-3V7.5a3 3 0 0 1 3-3H6V3a.75.75 0 0 1 .75-.75Zm13.5 9a1.5 1.5 0 0 0-1.5-1.5H5.25a1.5 1.5 0 0 0-1.5 1.5v7.5a1.5 1.5 0 0 0 1.5 1.5h13.5a1.5 1.5 0 0 0 1.5-1.5v-7.5Z"
                                clip-rule="evenodd" />
                        </svg>
                        Bulanan
                    </a>
                </li>
                <li class="mr-2 flex justify-center items-center">
                    <a href="#"
                        class="flex items-center gap-2 dashboard-tab-link p-2 rounded-md font-['Inter'] text-sm"
                        data-dashboard-tab="paket2">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" id="svg2"
                            class="size-6">
                            <path
                                d="M12.75 12.75a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM7.5 15.75a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5ZM8.25 17.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM9.75 15.75a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5ZM10.5 17.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM12 15.75a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5ZM12.75 17.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM14.25 15.75a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5ZM15 17.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM16.5 15.75a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5ZM15 12.75a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM16.5 13.5a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Z" />
                            <path fill-rule="evenodd"
                                d="M6.75 2.25A.75.75 0 0 1 7.5 3v1.5h9V3A.75.75 0 0 1 18 3v1.5h.75a3 3 0 0 1 3 3v11.25a3 3 0 0 1-3 3H5.25a3 3 0 0 1-3-3V7.5a3 3 0 0 1 3-3H6V3a.75.75 0 0 1 .75-.75Zm13.5 9a1.5 1.5 0 0 0-1.5-1.5H5.25a1.5 1.5 0 0 0-1.5 1.5v7.5a1.5 1.5 0 0 0 1.5 1.5h13.5a1.5 1.5 0 0 0 1.5-1.5v-7.5Z"
                                clip-rule="evenodd" />
                        </svg>
                        Tahunan
                    </a>
                </li>


            </ul>
        </div>

        <div id="dashboard-tab-content" class="py-10">
            <div id="paket1-content" class="dashboard-tab-content hidden">

                @include('langganan.paket.bulanan')

            </div>
            <div id="paket2-content" class="dashboard-tab-content">

                @include('langganan.paket.tahunan')
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const tabs = document.querySelectorAll('.dashboard-tab-link');
            const contents = document.querySelectorAll('.dashboard-tab-content');

            function activateTab(tab) {
                tabs.forEach(link => {
                    link.classList.remove('active', 'text-blue-600', 'border-blue-600', 'bg-gray-100');
                    link.classList.add('text-gray-500', 'border-transparent');
                });
                contents.forEach(content => content.classList.add('hidden'));

                tab.classList.add('active', 'text-blue-600', 'border-blue-600', 'bg-gray-100');
                tab.classList.remove('text-gray-500', 'border-transparent');
                document.getElementById(tab.getAttribute('data-dashboard-tab') + '-content').classList.remove(
                    'hidden');
            }

            tabs.forEach(tab => {
                tab.addEventListener('click', function(e) {
                    e.preventDefault();
                    activateTab(this);
                });
            });

            // Activate the default tab (optional)
            activateTab(document.querySelector('.dashboard-tab-link.active'));
        });
    </script>


@endsection
