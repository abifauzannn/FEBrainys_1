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

                <div class="bg-[#F9F9F9] w-5/6 mt-6 px-5 py-10 flex flex-row justify-around rounded-md">
                    <div class="w-1/3 px-4 py-4">
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

                    <div class="w-1/3 bg-white gap-3 rounded-md border border-gray-200">
                        <div class="w-full bg-[#F9F9F9] px-4 py-4 rounded-md">
                            <p class="text-black font-bold font-['Inter'] text-[16px]">Pilih Metode Pembayaran</p>
                        </div>

                        <div class="py-5 flex flex-col gap-2 px-4">
                            <p class="text-black font-['Inter'] text-[13px]">Transfer Virtual Account Bank</p>



                            @foreach ($data['payment_method']['virtual_account'] as $method)
                                <div id="payment-method-{{ $method['id'] }}"
                                    class="payment-method flex justify-center items-center w-full bg-white shadow-md py-4 rounded-md cursor-pointer"
                                    onclick="selectPaymentMethod('{{ $method['id'] }}')">
                                    <img src="{{ $method['thumbnail'] }}" alt="{{ $method['name'] }}"
                                        class="w-[80px] h-[40px]">
                                </div>
                            @endforeach

                            <p class="text-black font-['Inter'] text-[13px] mt-3">Metode Pembayaran Lainnya</p>

                            @foreach ($data['payment_method']['others'] as $method)
                                <div id="payment-method-{{ $method['id'] }}"
                                    class="payment-method flex justify-center items-center w-full bg-white shadow-md py-4 rounded-md cursor-pointer"
                                    onclick="selectPaymentMethod('{{ $method['id'] }}')">
                                    <img src="{{ $method['thumbnail'] }}" alt="{{ $method['name'] }}"
                                        class="w-[80px] h-[40px]">
                                </div>
                            @endforeach

                            <form action="{{ route('proses.pembayaran') }}" method="POST">
                                @csrf
                                <input type="text" id="paymentMethodCode" name="paymentMethodCode" value=""
                                    oninput="toggleButtonState()" class="">

                                <input type="text" id="item_type" name="item_type" value="{{ $item_type }}"
                                    class="">

                                <input type="text" id="item_id" name="item_id" value="{{ $item_id }}"
                                    class="">
                                <button id="paymentButton" type="submit"
                                    class="w-full py-4 rounded-md mt-5 font-['Inter'] bg-gray-400 text-white cursor-not-allowed"
                                    disabled>Lanjut Pembayaran</button>
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
                // Remove the 'selected' class from any previously selected method
                const previouslySelected = document.querySelector('.payment-method.selected');
                if (previouslySelected) {
                    previouslySelected.classList.remove('selected');
                }

                // Set the payment method code in the hidden input field
                document.getElementById('paymentMethodCode').value = id;

                // Add the 'selected' class to the clicked method
                const selectedMethod = document.getElementById('payment-method-' + id);
                if (selectedMethod) {
                    selectedMethod.classList.add('selected');
                }

                // Enable the payment button
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
