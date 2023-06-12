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
                <h2>HORAYYYY!!!!</h2>
                <p class="mb-5">
                    Horay peminjaman sukses diajukan cek dashboard untuk lihat status
                    peminjaman kamu
                </p>
                @if(Auth::user()->role == 'User')
                <a href="{{ route('peminjaman-user.index') }}" class="btn-primary-2 mt-2 d-block">Cek Status</a>
                @elseif(Auth::user()->role == 'Admin' || Auth::user()->role == 'Superadmin')
                <a href="{{ route('peminjaman.index') }}" class="btn-primary-2 mt-2 d-block">Cek Status</a>
                @endif
            </div>
        </div>
    </div>
</section>
@include('components/footer')

@endsection