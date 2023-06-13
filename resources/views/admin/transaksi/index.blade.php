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
                                <th>Peminjaman</th>
                                <th>Pengaju</th>
                                <th>Staff</th>
                                <th>Tarif</th>
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
                                <td style="width: 140px;" class="">{{$checkout->peminjaman->staff->name}}</td>
                                <td style="width: 140px;" class="">{{$checkout->peminjaman->staff->price}}</td>
                                <td class="">
                                    <div class="badge {{ $checkout->payment_status == 'pending' ? 'warning' : ($checkout->payment_status == 'paid' ? 'success' : 'danger') }}">
                                        <span>{{$checkout->payment_status}}</span>
                                    </div>
                                </td>
                                <td style="width: 128px;" class="text-end">

                                    <a href="{{route('transaksi.show',$checkout->id)}}" class="mx-0 mx-sm-3" style="color:transparent;">
                                        <img src="{{asset('images/show.svg')}}" style="cursor: pointer" alt="" />
                                    </a>

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