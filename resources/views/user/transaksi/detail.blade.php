@extends('layouts.app')

@section('content')
<div id="wrapper" class="">

    @include('components/dashboard/sidebar-user')
    <!-- Page Content -->
    <div class="container">
        <div id="page-content-wrapper">
            @include('components/dashboard/header')

            <!-- /#page-content-wrapper -->
            <div class="section-heading">
                <h3>Detail Transaksi</h3>
                <div class="rectangle"></div>
                <p>
                    <a href="{{route('transaksi-user.index')}}">Transaksi</a><span class="mx-2">/</span>Detail Transaksi
                </p>
            </div>
            <div class="dashboard-container">
                <div class="card-form mx-auto">
                    <div class="input mb-3">
                        <p class="mb-2">
                            <label for="kegunaan">Peminjaman</label>
                        </p>
                        <input class="input-custom" type="text" value="{{$checkout->peminjaman->staff->description}}" disabled />

                    </div>
                    <div class="input mb-3">
                        <p class="mb-2">
                            <label for="kegunaan">Pengaju</label>
                        </p>
                        <input class="input-custom" type="text" value="{{$checkout->peminjaman->user->name}}" disabled />

                    </div>
                    <div class="input mb-3">
                        <p class="mb-2">
                            <label for="kegunaan">Phone</label>
                        </p>
                        <input class="input-custom" type="text" value="{{$checkout->peminjaman->user->phone}}" disabled />

                    </div>
                    <div class="input mb-3">
                        <p class="mb-2">
                            <label for="phone">Status Pembayaran</label>
                        </p>
                        <input class="input-custom" type="text" value="{{$checkout->payment_status}}" disabled />
                    </div>

                    <div class="input mb-3">
                        <p class="mb-2">
                            <label for="kegunaan">Total Pembayaran</label>
                        </p>
                        <input class="input-custom" type="text" value="{{$checkout->total_payment}}" disabled />

                    </div>


                </div>



            </div>
        </div>
    </div>
</div>
</div>
@endsection