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
                            <div class="input mb-3">
                                <p class="mb-2">
                                    <label for="name">Atas Nama</label>
                                </p>
                                <input name="name" id="name" class="input-custom" value="{{$peminjaman->name}}" readonly type="text" placeholder="Masukan Atas Nama peminjaman" />
                            </div>
                            <div class="input mb-3">
                                <p class="mb-2">
                                    <label for="phone">No Telp</label>
                                </p>
                                <input name="phone" id="phone" class="input-custom" value="{{$peminjaman->phone}}" readonly type="text" placeholder="Masukan nomor telepon kamu" />
                            </div>
                            <div class="input mb-3">
                                <p class="mb-2">
                                    <label for="kegunaan">Kegunaan</label>
                                </p>
                                <input name="kegunaan" id="kegunaan" class="input-custom" value="{{$peminjaman->kegunaan}}" readonly type="text" placeholder="Ketikan kegunaan penyewaan" />

                            </div>
                            <div class="input mb-3">
                                <p class="mb-2">
                                    <label for="kegunaan">Status</label>
                                </p>
                                <input name="status" id="status" class="input-custom" value="@foreach ($peminjaman->checkouts as $checkout){{ $checkout->payment_status }}
@endforeach" readonly type="text" placeholder="Ketikan kegunaan penyewaan" />

                            </div>


                            <hr class="d-block d-sm-none" />
                        </div>
                        <hr class="vhr d-none d-sm-block" />
                        <div class="right">
                            <div class="input mb-3">
                                <div id="tanggal-container" class="mb-3">
                                    <div id="tanggal" class="field-input" style="margin-bottom: 8px">
                                        <div class="jh-input">
                                            <p class="mb-2">
                                                <label for="">Jadwal</label>
                                            </p>
                                        </div>
                                        <div class="time-selector row gx-2">
                                            <div class="col-12">
                                                <p class="mb-2">
                                                    <label for="tanggal1">Tanggal Mulai</label>
                                                </p>
                                                <input type="text" name="tanggalmulai" class="input-custom datepicker mb-2 @error('tanggalmulai') is-invalid @enderror" id="date0" value="@foreach ($peminjaman->jadwals as $jadwal){{ $jadwal->tanggalmulai }}
@endforeach" readonly placeholder="Pilih Tanggal" />
                                                @error('tanggalmulai')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                            <div class=" col-12">
                                                <p class="mb-2">
                                                    <label for="tanggal1">Tanggal Selesai</label>
                                                </p>
                                                <input type="text" name="tanggalselesai" class="input-custom datepicker mb-2  @error('tanggalselesai') is-invalid @enderror" id="date1" value="@foreach ($peminjaman->jadwals as $jadwal){{ $jadwal->tanggalselesai }}
@endforeach" readonly placeholder="Pilih Tanggal" />
                                                @error('tanggalselesai')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    @endif
                    <hr class=" my-4">
                    <div id="#status" class="section-heading p-0">
                        <h4>Ubah Status</h4>
                    </div>
                    <!-- <form action="{{route('peminjaman.update', $peminjaman->id)}}" method="post">
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

                    </form> -->
                </div>

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