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
                <h3>Detail Peminjaman</h3>
                <div class="rectangle"></div>
                <p>
                    <a href="{{route('peminjaman.index')}}">Peminjaman</a><span class="mx-2">/</span>Detail Peminjaman
                </p>
            </div>
            <div class="dashboard-container">
                <div class="card-form mx-auto">
                    <div class="section-heading p-0">
                        <h4>Detail Pengajuan</h4>
                        <p>
                            Ubah Status dibawah
                        </p>
                    </div>
                    <form id="myForm" enctype="multipart/form-data" class="form-submit d-lg-flex d-block">
                        <div class="left">
                            <div class="col-12">
                                <div class="row gx-2">

                                    <div class="col-6">
                                        <div class="input mb-3">
                                            <p class="mb-2">
                                                <label for="name">Atas Nama</label>
                                            </p>
                                            <input class="input-custom" type="text" placeholder="Masukan Nama kamu" value="{{$peminjaman->name}}" disabled />
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="input mb-3">
                                            <p class="mb-2">
                                                <label for="name">User Pengaju</label>
                                            </p>
                                            <input class="input-custom" type="text" placeholder="Masukan Nama kamu" value="{{$peminjaman->user->name}}" disabled />
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="input mb-3">
                                <p class="mb-2">
                                    <label for="phone">No Telp</label>
                                </p>
                                <input class="input-custom" type="text" value="{{$peminjaman->phone}}" disabled />
                            </div>
                            <div class="input mb-3">
                                <p class="mb-2">
                                    <label for="kegunaan">Instansi</label>
                                </p>
                                <input class="input-custom" type="text" value="{{$peminjaman->instansi->name}}" disabled />

                            </div>
                            <div class="input mb-3">
                                <p class="mb-2">
                                    <label for="kegunaan">Kegunaan</label>
                                </p>
                                <input class="input-custom" type="text" value="{{$peminjaman->kegunaan->name}}" disabled />

                            </div>

                            <div class="input mb-3">
                                <p class="mb-2">
                                    <label for="kegunaan">Kegunaan</label>
                                </p>
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-9">
                                            <input class="input-custom" type="text" value="{{$peminjaman->surat}}" disabled />
                                        </div>
                                        <div class="col-3">
                                            <a class="d-flex justify-content-center" style="padding-top: 16px;" href="{{ $path }}">Tampilkan </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <hr class="d-block d-sm-none" />
                        </div>
                        <hr class="vhr d-none d-sm-block" />
                        <div class="right">
                            <div class="input mb-3">
                                <div id="tanggal-container" class="mb-3">
                                    @foreach ($peminjaman->jadwals as $jadwal)
                                    <div id="tanggal" class="field-input" style="margin-bottom: 8px">
                                        <div class="jh-input">
                                            <p class="mb-2">
                                                <label for="">Jadwal {{$loop->iteration}}</label>
                                            </p>
                                        </div>
                                        <div class="time-selector row gx-2 gy-2">
                                            <div class="col-12 col-sm-4">
                                                <p class="mb-2">
                                                    <label for="tanggal1">Tanggal</label>
                                                </p>
                                                <input class="input-custom" type="text" value="{{$jadwal->tanggal}}" disabled />

                                            </div>
                                            <div class="col-sm-4 col-6">
                                                <p class="mb-2">
                                                    <label for="jammulai.1">Jam Mulai</label>
                                                </p>
                                                <input class="input-custom" type="text" value="{{$jadwal->jammulai}}" disabled />
                                            </div>

                                            <div class="col-sm-4 col-6">
                                                <p class="mb-2">
                                                    <label for="jamselesai.1">Selesai</label>
                                                </p>
                                                <input class="input-custom" type="text" value="{{$jadwal->jamselesai}}" disabled />

                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                    </form>

                </div>
                <hr class="my-4">
                <div class="section-heading p-0">
                    <h4>Detail Sewa Staff</h4>
                </div>
                <form id="myForm" enctype="multipart/form-data" class="form-submit d-lg-flex d-block">
                    <div class="left">
                        <div class="input mb-3">
                            <p class="mb-2">
                                <label for="kegunaan">Staff</label>
                            </p>
                            <input class="input-custom" type="text" value="{{$peminjaman->kegunaan->name}}" disabled />
                        </div>
                        <hr class="d-block d-sm-none" />
                    </div>
                    <hr class="vhr d-none d-sm-block" />
                    <div class="right">
                        <div class="input mb-3">
                            <p class="mb-2">
                                <label for="kegunaan">Status Pembayaran</label>
                            </p>
                            <input class="input-custom" type="text" value="{{$peminjaman->kegunaan->name}}" disabled />
                        </div>
                </form>
            </div>
            <hr class="my-4">
            <div id="#status" class="section-heading p-0">
                <h4>Ubah Status</h4>
            </div>
            <form action="{{route('peminjaman.update', $peminjaman->id)}}" method="post">
                @csrf
                @method('PUT')
                <div class="input mb-3">
                    <p class="mb-2">
                        <label for="kegunaan">Status</label>
                    </p>
                    <div class="select">
                        <select name="status" id="status" class="input-custom">
                            <option selected hidden value="{{ $peminjaman->status }}">{{ $peminjaman->status }}</option>
                            <option value="diterima">diterima</option>
                            <option value="diproses">diproses</option>
                            <option value="ditolak">ditolak</option>
                        </select>
                    </div>
                </div>
                <div class="input mb-3 pesan" style="display: none;">
                    <p class="mb-2">
                        <label for="message">Pesan</label>
                    </p>
                    <input class="input-custom " type="text" name="message" placeholder="Masukan pesan alasan ditolak" value="" />
                </div>
                <input type="submit" value="Perbarui Status" class="btn-primary-2 mt-2">

            </form>
        </div>
    </div>
</div>
</div>

<script>
    $(document).ready(function() {
        $('#status').change(function() {
            var selectedStatus = $(this).val();
            if (selectedStatus === 'ditolak') {
                $('.pesan').show();
            } else {
                $('.pesan').hide();
                $('.pesan').val(''); //
            }
        });
    });
</script>
@endsection