@extends('layouts.app')

@section('content')

<div id="wrapper" class="">
    <!-- Sidebar -->
    <div id="sidebar-wrapper">
        <ul class="sidebar-nav">
            <li class="sidebar-brand">
                <a style="padding: 0 !important" href="/">
                    <img src="{{asset('images/logo-black.svg')}}" style="width: 100%" alt="" /></a>
            </li>
            <div class="divider">
                <div class="rectangle"></div>
            </div>
            <div class="title-section">
                <p>Daily Use</p>
            </div>
            <li>
                <a class="active" href="#">
                    <img src="{{asset('images/peminjaman-icon.svg')}}" class="mr-2" alt="" />
                    Peminjaman</a>
            </li>
            <li>
                <a href="#"><img src="{{asset('images/sewa-staff.svg')}}" class="mr-2" alt="" />
                    Transaksi</a>
            </li>
            <div class="title-section">
                <p>User</p>
            </div>
            <li>
                <a href="#"><img src="{{asset('images/user.svg')}}" class="mr-2" alt="" />
                    Profil
                </a>
            </li>
            <li>
                <form id="logout" action="/logout" method="post">
                    @csrf
                    <input type="hidden" value="Logout">
                    <a href="javascript:;" onclick="document.getElementById('logout').submit();"><img src="{{asset('images/Logout.svg')}}" class="mr-2" alt="" />
                        Logout
                    </a>
                </form>
            </li>
        </ul>
    </div>
    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->
    <div class="container">
        <div id="page-content-wrapper">
            <div class="dashboard-header">
                <div class="d-flex">
                    <a href="#menu-toggle" id="menu-toggle"><img src="{{asset('images/menu.svg')}}" alt="" /></a>
                    <h2 class="my-0 mx-2 mx-lg-4">Dashboard</h2>
                </div>
                <p class="user-profile m-0">Alisson Becker</p>
            </div>
            <!-- /#page-content-wrapper -->
            <div class="section-heading">
                <h3>Peminjaman</h3>
                <div class="rectangle"></div>
                <p>Peminjaman</p>
            </div>
            <div class="dashboard-container">
                <div class="table-function d-block d-lg-flex mb-4">
                    <input style="max-width: 420px" type="text" class="input-custom mb-2 mb-lg-0" id="cari" placeholder="Cari" />

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
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>
                <div aria-label="Page navigation example" class="mt-4">
                    <ul class="pagination justify-content-center justify-content-sm-end">
                        <li class="page-item disabled">
                            <a class="page-link">Previous</a>
                        </li>
                        <li class="page-item active">
                            <a class="page-link" href="#">1</a>
                        </li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#">Next</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /#wrapper -->

@endsection