@extends('layouts.app')

@section('content')
@include('components/navbar')

<section class="success-page">
    <div class="container">
        <div class="section-heading mb-4">
            <h2>Sukses Ajukan</h2>
            <div class="rectangle"></div>
            <p>Sukses Peminjaman Lapangan</p>
        </div>

        <div class="wrapper">
            <div class="success-card mx-auto text-center">
                <img src="{{asset('images/success-state.png')}}" alt="" class="img-success mx-auto mb-4" />
                <h4>Total Bayar : @foreach ($peminjaman->checkouts as $checkout)
                    {{ $checkout-> total_payment }}
                    @endforeach
                </h4>
                <hr>
                <p class="mb-1">
                    Peminjaman Gor Pendowo dengan detail berikut
                </p>
                <hr>
                <div class="d-flex justify-content-between mb-2">
                    <p class="">Atas Nama</p>
                    <p style="font-weight: bold;" class="">{{$peminjaman->name}}</p>
                </div>
                <div class="d-flex justify-content-between mb-2">
                    <p class="">Kegunaan</p>
                    <p style="font-weight: bold;" class="">{{$peminjaman->kegunaan}}</p>
                </div>
                <div class="d-flex justify-content-between mb-2">
                    <p class="">Asal</p>
                    <p style="font-weight: bold;" class="">{{$peminjaman->asal}}</p>
                </div>
                <div class="d-flex justify-content-between mb-2">
                    <p class="">Jadwal</p>
                    <p style="font-weight: bold;" class="">@foreach ($peminjaman->jadwals as $jadwal)
                        {{ $jadwal->tanggalmulai }} - {{$jadwal->tanggalselesai}}
                        @endforeach
                    </p>
                </div>
                <a href=" @foreach ($peminjaman->checkouts as $checkout)
                    {{ $checkout-> midtrans_url }}
                    @endforeach" target="_blank" class="btn-primary-2 mt-2 d-block">Bayar</a>

            </div>
        </div>
    </div>
</section>
@include('components/footer')

@endsection