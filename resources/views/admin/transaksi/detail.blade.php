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
                <h3>Detail Transaksi</h3>
                <div class="rectangle"></div>
                <p>
                    <a href="{{route('transaksi.index')}}">Transaksi</a><span class="mx-2">/</span>Detail Transaksi
                </p>
            </div>
            <div class="dashboard-container">
                <div class="card-form mx-auto">
                    <form id="myForm" enctype="multipart/form-data" class="form-submit d-lg-flex d-block">
                        <div class="left">
                            <div class="input mb-3">
                                <p class="mb-2">
                                    <label for="kegunaan">Peminjaman</label>
                                </p>
                                <input class="input-custom" type="text" value="{{$checkout->peminjaman->name}}" disabled />

                            </div>
                            <div class="input mb-3">
                                <p class="mb-2">
                                    <label for="kegunaan">Pengaju</label>
                                </p>
                                <input class="input-custom" type="text" value="{{$checkout->peminjaman->user->name}}" disabled />

                            </div>
                            <div class="input mb-3">
                                <p class="mb-2">
                                    <label for="kegunaan">phone</label>
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
                        <hr class="vhr d-none d-sm-block" />
                        <div class="right">
                            <div class="input mb-3">
                                <p class="mb-2">
                                    <label for="kegunaan">Staff</label>
                                </p>
                                <input class="input-custom" type="text" value="{{$checkout->peminjaman->staff->name}}" disabled />

                            </div>
                            <div class="input mb-3">
                                <p class="mb-2">
                                    <label for="kegunaan">Deskripsi</label>
                                </p>
                                <input class="input-custom" type="text" value="{{$checkout->peminjaman->staff->description}}" disabled />

                            </div>
                        </div>
                    </form>





                </div>



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
            var totalPembayaran = parseInt(selectedStaffPrice) * jumlahJadwal;
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