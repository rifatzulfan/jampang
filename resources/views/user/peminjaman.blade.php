@extends('layouts.app')

@section('content')

<div id="wrapper" class="">
    <!-- Sidebar -->
    @include('components/dashboard/sidebar-user')

    <!-- /#sidebar-wrapper -->

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
                    <input style="max-width: 420px" type="text" class="input-custom mb-2 mb-lg-0" id="cari" placeholder="Cari" />
                    <div class="action">
                        <label class="dropdown mx-0 mx-sm-1">
                            <div class="dd-button">
                                <img width="22" height="22" src="{{asset('images/Filter.svg')}}" alt="" />
                                <span class="mx-2">Filter</span>
                            </div>

                            <input type="checkbox" class="dd-input" id="test" />

                            <ul class="dd-menu">
                                <p>Status</p>
                                <li class="divider m-0"></li>
                                <li data-status="all">Semua</li>
                                <li data-status="diterima">Diterima</li>
                                <li data-status="diproses">Diproses</li>
                                <li data-status="ditolak">Ditolak</li>
                            </ul>
                        </label>
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
                                <th>Jam</th>
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
                                <td class="">{{$peminjaman->kegunaan->name}}</td>
                                <td class="">
                                    @foreach ($peminjaman->jadwals as $jadwal)
                                    <span class="">{{$jadwal->tanggal}}</span> <br>
                                    @endforeach
                                </td>
                                <td class="">
                                    @foreach ($peminjaman->jadwals as $jadwal)
                                    <span class=""> {{$jadwal->jammulai}} - {{$jadwal->jamselesai}}</span> <br>
                                    @endforeach
                                </td>
                                <td class="">
                                    <div class="badge {{ $peminjaman->status == 'diproses' ? 'warning' : ($peminjaman->status == 'diterima' ? 'success' : 'danger') }}">
                                        <span>{{$peminjaman->status}}</span>
                                    </div>
                                </td>
                                <td style="width: 128px;" class="text-end">

                                    <form action="{{route('peminjaman.destroy',$peminjaman->id)}}" method="post">
                                        <a href="{{route('peminjaman.show',$peminjaman->id)}}" class="mx-0 mx-sm-3" style="color:transparent;">
                                            <img src="{{asset('images/show.svg')}}" style="cursor: pointer" alt="" />
                                        </a>
                                        @csrf
                                        @method('PUT')
                                        <button class="btn-batal my-3 my-sm-0">
                                            Batal
                                        </button>
                                    </form>
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

<script>
    $(document).ready(function() {
        // Handle dropdown item click event
        $(".dd-menu li").click(function() {
            // Get selected status
            var status = $(this).data("status");
            // Show/hide table rows based on selected status
            if (status == "all") {
                $("#myTable tbody tr").show();
            } else {
                $("#myTable tbody tr")
                    .hide()
                    .filter(function() {
                        // Compare search term with status text
                        var statusText = $(this)
                            .find("td span")
                            .filter(function() {
                                return $(this)
                                    .text()
                                    .toLowerCase()
                                    .includes(status.toLowerCase());
                            })
                            .first()
                            .text()
                            .toLowerCase();
                        return statusText === status.toLowerCase();
                    }).show()
            }
        });
    });
</script>
</div>
<!-- /#wrapper -->

@endsection