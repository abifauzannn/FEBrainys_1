@extends('langganan.langganan')

@section('langganan - Tagihan')


@section('langganan-content')


    <div class="flex flex-col md:flex-row justify-between gap-5">
        @include('langganan.tagihan.paket-aktif')
        @include('langganan.tagihan.daftar-transaksi')
    </div>


@endsection
