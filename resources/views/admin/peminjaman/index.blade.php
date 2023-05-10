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
                                <li data-status="Terima">Terima</li>
                                <li data-status="Tunggu">Tunggu</li>
                                <li data-status="Tolak">Tolak</li>
                            </ul>
                        </label>

                        <a href="" class="btn-primary-2 mx-0 mx-sm-1">Tambah</a>
                        <button class="mx-3" id="exportBtn">
                            <img src="{{asset('images/csv.svg')}}" alt="" />
                        </button>
                    </div>
                </div>
                <div class="table-responsive">
                    <table id="myTable" class="table table-bordered rounded rounded-3 overflow-hidden">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Kegunaan</th>
                                <th>Tanggal Mulai</th>
                                <th>Jam</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th style="width: 48px;" scope="row">1</th>
                                <td class="w-25">Mark Lazaro</td>
                                <td>Any item</td>
                                <td>Any item</td>
                                <td class="">
                                    09.00 AM - 10.00 AM
                                </td>
                                <td class="">Active</td>
                                <td style="width: 128px;" class="text-end">
                                    <img style="cursor: pointer" class="mx-2" src="{{asset('images/show.svg')}}" alt="" />
                                    <img src="{{asset('images/edit.svg')}}" style="cursor: pointer" alt="" />
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div aria-label="Page navigation example" class="mt-4">
          
                </div>
            </div>
        </div>
    </div>
</div>

<!-- /#wrapper -->

@endsection