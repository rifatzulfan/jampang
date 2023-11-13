@extends('layouts.app')

@section('content')
<div id="wrapper" class="">

    @include('components/dashboard/sidebar-user')
    @if ($message = Session::get('success'))
    <div class="modal fade show" id="errorModal" tabindex="-1" role="dialog" aria-labelledby="errorModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="errorModalLabel">Sukses Sewa Staff</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div style="padding-bottom: 48px !important;" class="modal-body text-center">
                    <img src="{{asset('images/success-state.png')}}" alt="" class="mb-2 mx-auto">
                    <h2 class="mb-2">Yess Sukses!!</h2>
                    <p class="mb-5">
                        {{ $message }}
                    </p>
                    <a href="{{route('transaksi-user.index')}}" class="btn-primary-2" data-bs-dismiss="">Selesaikan Pembayaran</a>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var myModal = new bootstrap.Modal(document.getElementById('errorModal'));
            myModal.show();
        });
    </script>
    @endif

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

                </div>
                @if($peminjaman->staff_id != '')
                <hr class=" my-4">
                <div class="section-heading p-0">
                    <h4>Detail Sewa Staff</h4>
                </div>
                <form id="myForm" enctype="multipart/form-data" class="form-submit d-lg-flex d-block">
                    <div class="left">
                        <div class="input mb-3">
                            <p class="mb-2">
                                <label for="kegunaan">Staff</label>
                            </p>
                            <input class="input-custom" type="text" value="{{$peminjaman->staff->name}}" disabled />
                        </div>
                        <hr class="d-block d-sm-none" />
                    </div>
                    <hr class="vhr d-none d-sm-block" />
                    <div class="right">
                        <div class="input mb-3">
                            <p class="mb-2">
                                <label for="kegunaan">Tarif</label>
                            </p>
                            <input class="input-custom" type="text" value="{{$peminjaman->staff->price}}" disabled />
                        </div>
                    </div>
                </form>
                @endif
                @if ($peminjaman->staff_id === null && $peminjaman->status === 'diterima')

                <hr class="my-4">
                <div class="section-heading p-0">

                    <div class="">
                        <h4>Sewa Staff?</h4>
                        <p class="text-start">Sewa staff untuk Kelengkapan Voli</p>
                    </div>
                    @endif

                </div>



                @if ($peminjaman->staff_id === null && $peminjaman->status === 'diterima')
                <form id="myForm" enctype="multipart/form-data" action="{{route('peminjaman-user.sewa', $peminjaman->id)}}" method="POST" class="form-submit">
                    @csrf
                    @method('PUT')
                    <div class="input mb-3">
                        <p class="mb-2">
                            <label for="kegunaan">Pilih Staff</label>
                        </p>
                        <div class="select">
                            <select name="staff" id="staff" class="input-custom">
                                <option selected hidden value="">Pilih Staff</option>
                                @foreach ($staffs as $staff)
                                <option value="{{ $staff->id }}">{{ $staff->name }} - {{$staff->price}} - {{$staff->description}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModal">Sewa Staff</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body text-start">
                                    <p>Anda akan menyewa Staff Voli <span style="font-weight: bold;" id="selectedStaffName">
                                        </span> dengan tarif Rp. <span style="font-weight: bold;" id="selectedStaffPrice"></span> pada jadwal
                                        @foreach ($peminjaman->jadwals as $jadwal) {{$jadwal->tanggal}} @endforeach dengan detail :</p>
                                    <div class="d-lg-flex d-block">
                                        <div class="left">
                                            <div class="input mb-3" style="padding-right: 8px;">
                                                <p class="mb-2">
                                                    <label for="kegunaan">Jumlah Jadwal</label>
                                                </p>
                                                <input class="input-custom" type="text" id="jumlah" value="{{count($peminjaman->jadwals)}}" disabled />
                                            </div>
                                            <hr class="d-block d-sm-none" />
                                        </div>
                                        <script>
                                        </script>
                                        <hr class="vhr d-none d-sm-block" />
                                        <div class="right">
                                            <div class="input mb-3" style="padding-left: 8px;">
                                                <p class="mb-2">
                                                    <label for="kegunaan">Total Pembayaran</label>
                                                </p>
                                                <input class="input-custom" type="text" id="total" name="total" value="" readonly />
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn-primary-2" data-bs-dismiss="modal">Iya Sewa Staff</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            var myModal = new bootstrap.Modal(document.getElementById('errorModal'));
                            myModal.show();
                        });
                    </script>
                </form>
                <button disabled class="btn-primary-2 mt-2" id="sewa" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Sewa
                </button>
                @endif
            </div>
        </div>
    </div>
</div>
</div>
<script>
    $(document).ready(function() {
        $('#staff').change(function() {
            var selectedStaffName = $(this).find('option:selected').text().split(' - ')[0];
            var selectedStaffPrice = $(this).find('option:selected').text().split(' - ')[1];
            $('#selectedStaffName').text(selectedStaffName);
            $('#selectedStaffPrice').text(selectedStaffPrice);

            var selectedValue = $(this).val();
            if (selectedValue === "") {
                $('.btn-primary-2').prop('disabled', true);
            } else {
                $('.btn-primary-2').prop('disabled', false);
            }

            var jumlahJadwal = parseInt($('#jumlah').val());
            var totalPembayaran = (parseInt(selectedStaffPrice) * jumlahJadwal).toString();
            $('#total').val(totalPembayaran);
        });
    });
</script>
<script>
</script>
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

<script>
    const inputStaff = document.getElementById("staff");
    const submitBtn = document.getElementById("sewa");

    inputStaff.addEventListener("input", validateInputs);

    function validateInputs() {
        if (inputStaff.value() !== "") {
            submitBtn.disabled = false;
        } else {
            submitBtn.disabled = true;
        }
    }
</script>
@endsection