@extends('layouts.app')

@section('content')
<div id="wrapper" class="">

    @include('components/dashboard/sidebar')

    <!-- Page Content -->
    <div class="container">
        <div id="page-content-wrapper">
            @include('components/dashboard/header')

            <!-- /#page-content-wrapper -->
            <div class="section-heading">
                <h3>Peminjaman</h3>
                <div class="rectangle"></div>
                <p>Peminjaman</p>
            </div>
            <div class="dashboard-container">
                <div class="table-function d-block d-lg-flex mb-4">
                    <form action="{{ route('peminjaman.index') }}" method="GET" class="mb-2">
                        <div class="d-flex">
                            <input style="max-width: 420px" type="text" class="input-custom" id="cari" name="cari" placeholder="Cari" value="{{ request('cari') }}" />
                            <button type="submit" style="margin-left:8px; padding: 6px 12px; width:fit-content;" class="btn-primary-2 "><img class="py-2" src="{{asset('images/ri-search-line.svg')}}" alt=""></button>
                            @if (request('cari'))
                            <a href="{{ route('peminjaman.index', ['clear' => true]) }}" class="mx-2"><img class="py-3" src="{{asset('images/clear.svg')}}" alt=""></a>
                            @endif
                        </div>
                    </form>
                    <div class="action">
                        <form class=" mx-0 mx-sm-1" action="{{ route('peminjaman.index') }}" method="GET">
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
                                        <a href="{{ route('peminjaman.index') }}" style="text-decoration: none; color:#212529">Semua</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('peminjaman.index', ['status' => 'diterima']) }}" style="text-decoration: none; color:#212529">Diterima</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('peminjaman.index', ['status' => 'diproses']) }}" style="text-decoration: none; color:#212529">Diproses</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('peminjaman.index', ['status' => 'ditolak']) }}" style="text-decoration: none; color:#212529">Ditolak</a>
                                    </li>
                                </ul>
                            </label>
                        </form>


                        <a href="{{route('peminjaman.create')}}" class="btn-primary-2 mx-0 mx-sm-1">Tambah</a>
                        <button class="mx-3" id="exportBtn">
                            <img src="{{asset('images/csv.svg')}}" alt="" />
                        </button>
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
                                <th>Phone</th>
                                <th>Kegunaan</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($peminjamen as $peminjaman)
                            <tr>
                                <th style="width: 48px;" scope="row">{{$loop->iteration}}</th>
                                <td style="width: 140px;" class="">{{$peminjaman->name}}</td>
                                <td class="">{{$peminjaman->phone}}</td>
                                <td class="">{{$peminjaman->kegunaan}}</td>
                                <td class="">
                                    @foreach ($peminjaman->jadwals as $jadwal)
                                    <span class="">{{ $jadwal->tanggalmulai }}</span>
                                    <span class="">-</span> <br>
                                    <span class="">{{ $jadwal->tanggalselesai }}</span>
                                    @endforeach
                                </td>
                                <td class="">
                                    <div class="badge {{ $peminjaman->status == 'diproses' ? 'warning' : ($peminjaman->status == 'diterima' ? 'success' : 'danger') }}">
                                        @foreach ($peminjaman->checkouts as $checkout)
                                        <span>{{ $checkout->payment_status }}</span>
                                        @endforeach
                                    </div>
                                </td>
                                <td style="width: 128px;" class="text-end">
                                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Peminjaman</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body text-start">
                                                    Kamu akan menghapus peminjaman Atas Nama {{$peminjaman->name}}
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                    <form action="{{route('peminjaman.destroy',$peminjaman->id)}}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <a href="{{route('peminjaman.show',$peminjaman->id)}}" class="mx-0 mx-sm-3" style="color:transparent;">
                                        <img src="{{asset('images/show.svg')}}" style="cursor: pointer" alt="" />
                                    </a>
                                    <button class="btn-delete my-3 my-sm-0" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                        <img src="{{asset('images/delete.svg')}}" style="cursor: pointer" alt="" />
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div aria-label="Page navigation example" class="mt-4">
                    {!! $peminjamen->links() !!}
                </div>
            </div>
        </div>
    </div>
</div>


@endsection