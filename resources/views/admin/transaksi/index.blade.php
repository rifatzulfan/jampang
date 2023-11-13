@extends('layouts.app')

@section('content')

<div id="wrapper" class="">
    <!-- Sidebar -->
    @include('components/dashboard/sidebar')

    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->
    <div class="container">
        <div id="page-content-wrapper">
            @include('components/dashboard/header')

            <!-- /#page-content-wrapper -->
            <div class="section-heading">
                <h3>Transaksi</h3>
                <div class="rectangle"></div>
                <p>Transaksi</p>
            </div>
            <div class="dashboard-container">
                <div class="table-function d-block d-lg-flex mb-4">
                    <form action="{{ route('transaksi.index') }}" method="GET" class="mb-2">
                        <div class="d-flex">
                            <input style="max-width: 420px" type="text" class="input-custom" id="cari" name="cari" placeholder="Cari" value="{{ request('cari') }}" />
                            <button type="submit" style="margin-left:8px; padding: 6px 12px; width:fit-content;" class="btn-primary-2 "><img class="py-2" src="{{asset('images/ri-search-line.svg')}}" alt=""></button>
                            @if (request('cari'))
                            <a href="{{ route('transaksi.index', ['clear' => true]) }}" class="mx-2"><img class="py-3" src="{{asset('images/clear.svg')}}" alt=""></a>
                            @endif
                        </div>
                    </form>
                    <div class="action">
                        <form class=" mx-0 mx-sm-1" action="{{ route('transaksi.index') }}" method="GET">
                            <label class="dropdown">
                                <div class="dd-button">
                                    <img width="22" height="22" src="{{ asset('images/Filter.svg') }}" alt="" />
                                    <span class="mx-2">Filter</span>
                                </div>

                                <input type="checkbox" class="dd-input" id="test" />

                                <ul class="dd-menu">
                                    <p>Status</p>
                                    <li class="divider m-0"></li>
                                    <li>
                                        <a href="{{ route('transaksi.index') }}" style="text-decoration: none; color:#212529">Semua</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('transaksi.index', ['payment_status' => 'paid']) }}" style="text-decoration: none; color:#212529">Paid</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('transaksi.index', ['payment_status' => 'pending']) }}" style="text-decoration: none; color:#212529">Pending</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('transaksi.index', ['payment_status' => 'expired']) }}" style="text-decoration: none; color:#212529">Expired</a>
                                    </li>
                                </ul>
                            </label>
                        </form>
                    </div>
                </div>
                @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
                @endif
                <div class="table-responsive">
                    <table id="myTable" class="table table-bordered rounded rounded-3 overflow-hidden">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>Atas Nama</th>
                                <th>Pengaju</th>
                                <th>Jadwal</th>
                                <th>Total</th>
                                <th>Tanggal Pengajuan</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($checkouts as $checkout)
                            <tr>
                                <th style="width: 48px;" scope="row">{{$loop->iteration}}</th>
                                <td style="width: 140px;" class="">{{$checkout->peminjaman->name}}</td>
                                <td style="width: 140px;" class="">{{$checkout->peminjaman->user->name}}</td>
                                <td style="width: 140px;" class="">
                                    @foreach ($checkout->peminjaman->jadwals as $jadwal)
                                    <span class="">{{ $jadwal->tanggalmulai }}</span>
                                    <span class="">-</span> <br>
                                    <span class="">{{ $jadwal->tanggalselesai }}</span>
                                    @endforeach
                                </td>
                                <td style="width: 140px;" class="">{{$checkout->total_payment}}</td>
                                <td style="width: 140px;" class="">{{$checkout->created_at->format('Y-m-d H:i:s')}}</td>
                                <td style="width: 128px;" class="text-end ">
                                    <div class="d-flex justify-content-end">

                                        <div class="{{ $checkout->payment_status == 'menunggu pembayaran' ? 'd-block' : ($checkout->payment_status == 'paid' ? 'success' : 'd-none') }}">
                                            <a style="padding:4px 12px; font-size:small; cursor:pointer;" href="{{$checkout->midtrans_url}}" class="btn-primary-2 text-white ">Bayar</a>
                                        </div>
                                        <a href="{{route('transaksi.show',$checkout->id)}}" class="mx-0 mx-sm-3" style="color:transparent;">
                                            <img src="{{asset('images/show.svg')}}" style="cursor: pointer" alt="" />
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div aria-label="Page navigation example" class="mt-4">
                    {!! $checkouts->links() !!}
                </div>
            </div>
        </div>
    </div>
</div>


</div>
<!-- /#wrapper -->

@endsection