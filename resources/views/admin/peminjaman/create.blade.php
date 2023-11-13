@extends('layouts.app')

@section('content')
<div id="wrapper" class="">

    @include('components/dashboard/sidebar')

    <!-- Page Content -->
    <div class="container">
        <div id="page-content-wrapper">
            @include('components/dashboard/header')
            @if($errors->any())
            <div class="modal fade show" id="errorModal" tabindex="-1" role="dialog" aria-labelledby="errorModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="errorModalLabel">Jadwal Tabrakan</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body text-center">
                            <img src="{{asset('images/waduh.png')}}" alt="" class="mb-2 mx-auto">
                            <h2 class="mb-2">Waduh!!</h2>
                            <p class="mb-5">
                                @foreach($errors->all() as $error)
                                {{ $error }}
                                @endforeach
                            </p>
                            <button type="button" class="btn-primary-2" data-bs-dismiss="modal">Pilih Jadwal lain</button>
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
            <!-- /#page-content-wrapper -->
            <div class="section-heading">
                <h3>Tambah Peminjaman</h3>
                <div class="rectangle"></div>
                <p>
                    <a href="{{route('peminjaman.index')}}">Peminjaman</a><span class="mx-2">/</span>Tambah
                    Peminjaman
                </p>
            </div>
            @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <div class="dashboard-container">
                <div class="card-form mx-auto">
                    <form id="myForm" action="{{route('form-peminjaman.store')}}" method="POST" enctype="multipart/form-data" class="form-submit d-lg-flex d-block">
                        @csrf
                        <div class="left">
                            <div class="input mb-3">
                                <p class="mb-2">
                                    <label for="name">Atas Nama</label>
                                </p>
                                <input name="name" id="name" class="input-custom" type="text" placeholder="Masukan Atas Nama peminjaman" />
                            </div>
                            <div class="input mb-3">
                                <p class="mb-2">
                                    <label for="phone">No Telp</label>
                                </p>
                                <input name="phone" id="phone" class="input-custom" value="{{Auth()->user()->phone}}" type="text" placeholder="Masukan nomor telepon kamu" />
                            </div>
                            <div class="input mb-3">
                                <p class="mb-2">
                                    <label for="kegunaan">Kegunaan</label>
                                </p>
                                <input name="kegunaan" id="kegunaan" class="input-custom" type="text" placeholder="Ketikan kegunaan penyewaan" />

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
                                                <label for="">Pilih Jadwal</label>
                                            </p>
                                        </div>
                                        <div class="time-selector row gx-2">
                                            <div class="col-12">
                                                <p class="mb-2">
                                                    <label for="tanggal1">Tanggal Mulai</label>
                                                </p>
                                                <input type="text" name="tanggalmulai" class="input-custom datepicker mb-2  @error('tanggalmulai') is-invalid @enderror" id="date0" placeholder="Pilih Tanggal" />
                                                @error('tanggalmulai')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                            <div class="col-12">
                                                <p class="mb-2">
                                                    <label for="tanggal1">Tanggal Selesai</label>
                                                </p>
                                                <input type="text" name="tanggalselesai" class="input-custom datepicker mb-2  @error('tanggalselesai') is-invalid @enderror" id="date1" placeholder="Pilih Tanggal" />
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
                            <input type="submit" value="Ajukan" class="btn-primary-2 mt-2">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const input1 = document.getElementById("surat");
    const phone = document.getElementById("phone");
    const submitBtn = document.getElementById("myButton");

    input1.addEventListener("input", validateInputs);
    phone.addEventListener("input", validateInputs);

    function validateInputs() {
        if (input1.value.trim() !== "" && phone.value.trim() !== "") {
            submitBtn.disabled = false;
        } else {
            submitBtn.disabled = true;
        }
    }
</script>
<script>
    $(function() {
        var $startDate = $("#date0");
        var $endDate = $("#date1");

        $startDate.datepicker({
            dateFormat: "yy-mm-dd",
            minDate: 0,
            onSelect: function(selectedDate) {
                $endDate.datepicker("option", "minDate", selectedDate);
            }
        });

        $endDate.datepicker({
            dateFormat: "yy-mm-dd",
            onSelect: function(selectedDate) {
                $startDate.datepicker("option", "maxDate", selectedDate);
            }
        });
    });
</script>

<!-- /#wrapper -->

@endsection