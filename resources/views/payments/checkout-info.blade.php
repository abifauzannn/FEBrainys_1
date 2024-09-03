@extends('layouts.template')

@section('title', 'Langganan - Brainys')

@section('meta')
    <meta name="robots" content="noindex, nofollow">
@endsection

@section('content')
    @if (!isset($data))
        <script>
            window.location.href = "{{ route('dashboard') }}";
        </script>
    @else
        <x-nav></x-nav>
        <div class="container mx-auto px-4 py-6 sm:px-10 sm:py-9 relative">
            <x-back-button url="{{ route('langganan.tagihan') }}" />

            <div class="flex flex-col items-center justify-center">
                <img src="{{ URL('images/Steps2.png') }}" alt="" class="w-[309px] h-[84px]">

                <div class="bg-[#F9F9F9] w-5/6 mt-6 px-5 py-10 flex flex-col md:flex-row justify-around rounded-md">
                    <div class="md:w-1/3 w-full px-4 py-4">
                        <p class="mb-5 text-black font-bold font-['Inter'] text-[16px]">Informasi Pembelian</p>
                        <div class="flex flex-row items-center bg-white p-4 gap-3 rounded-md border border-gray-200">
                            <img src="{{ URL('images/info.png') }}" alt="" class="w-[50px] h-[50px]">
                            <div class="flex flex-col">
                                <p class="font-['Inter'] font-bold text-[14px]">{{ $data['items']['item_name'] }}</p>
                                <p class="font-['Inter'] text-gray-400 text-[14px]">
                                    Rp{{ number_format($data['items']['item_price'], 0, ',', '.') }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="md:w-1/3 w-full bg-white gap-3 rounded-md border border-gray-200">
                        <div class="w-full bg-[#F9F9F9] px-4 py-4 rounded-md">
                            <p class="text-black font-bold font-['Inter'] text-[16px]">Pilih Metode Pembayaran</p>
                        </div>

                        <div class="py-5 flex flex-col gap-2 px-4">
                            @if ($data['payment_method']['virtual_account'] == [])
                                <p></p>
                            @else
                                @foreach ($data['payment_method']['virtual_account'] as $method)
                                    <div id="payment-method-{{ $method['id'] }}"
                                        class="payment-method flex justify-center items-center w-full bg-white shadow-md py-4 rounded-md cursor-pointer"
                                        onclick="selectPaymentMethod('{{ $method['id'] }}')">
                                        <img src="{{ $method['thumbnail'] }}" alt="{{ $method['name'] }}"
                                            class="w-[80px] h-[40px]">
                                    </div>
                                @endforeach
                            @endif

                            <p class="text-black font-['Inter'] text-[13px] mt-3">Metode Pembayaran Lainnya</p>

                            @foreach ($data['payment_method']['others'] as $method)
                                <div id="payment-method-{{ $method['id'] }}"
                                    class="payment-method flex justify-center items-center w-full bg-white shadow-md py-4 rounded-md cursor-pointer"
                                    onclick="selectPaymentMethod('{{ $method['id'] }}')">
                                    <img src="{{ $method['thumbnail'] }}" alt="{{ $method['name'] }}"
                                        class="w-[80px] h-[40px]">
                                </div>
                            @endforeach

                            <form id="paymentForm" action="{{ route('proses.pembayaran') }}" method="POST">
                                @csrf
                                <input type="hidden" id="paymentMethodCode" name="paymentMethodCode" value="">
                                <input type="hidden" id="item_type" name="item_type" value="{{ $item_type }}">
                                <input type="hidden" id="item_id" name="item_id" value="{{ $item_id }}">
                                <button id="paymentButton" type="submit"
                                    class="w-full py-4 rounded-md mt-5 font-['Inter'] bg-gray-400 text-white cursor-not-allowed flex justify-center items-center"
                                    disabled>
                                    <span id="submitButtonText">Lanjut Pembayaran</span>
                                    <div id="loadingSpinner" class="hidden ml-2">
                                        <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg"
                                            fill="none" viewBox="0 0 24 24">
                                            <circle class="opacity-25" cx="12" cy="12" r="10"
                                                stroke="currentColor" stroke-width="4"></circle>
                                            <path class="opacity-75" fill="currentColor"
                                                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                            </path>
                                        </svg>
                                    </div>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            @if (session('user')['school_level'] == '')
                <x-alert-jenjang />
            @endif

            @if (session('user')['is_active'] == 0)
                <script>
                    window.location.href = "{{ route('dashboard') }}";
                </script>
            @endif
        </div>

        <script>
            function selectPaymentMethod(id) {
                const previouslySelected = document.querySelector('.payment-method.selected');
                if (previouslySelected) {
                    previouslySelected.classList.remove('selected');
                }

                document.getElementById('paymentMethodCode').value = id;
                const selectedMethod = document.getElementById('payment-method-' + id);
                if (selectedMethod) {
                    selectedMethod.classList.add('selected');
                }

                toggleButtonState();
            }

            function toggleButtonState() {
                const inputField = document.getElementById('paymentMethodCode');
                const button = document.getElementById('paymentButton');

                if (inputField.value.trim() === '') {
                    button.disabled = true;
                    button.classList.add('bg-gray-400');
                    button.classList.remove('bg-blue-500', 'cursor-pointer');
                    button.classList.add('cursor-not-allowed');
                } else {
                    button.disabled = false;
                    button.classList.remove('bg-gray-400', 'cursor-not-allowed');
                    button.classList.add('bg-blue-500', 'cursor-pointer');
                }
            }

            document.getElementById('paymentForm').addEventListener('submit', function() {
                document.getElementById('submitButtonText').classList.add('hidden');
                document.getElementById('loadingSpinner').classList.remove('hidden');
            });
        </script>

        <style>
            .payment-method.selected {
                border: 2px solid blue;
            }

            .bg-blue-500 {
                background-color: #3b82f6;
            }
        </style>
    @endif
@endsection