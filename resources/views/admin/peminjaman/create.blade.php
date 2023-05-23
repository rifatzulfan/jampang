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
                    <form id="myForm" action="{{route('peminjaman.store')}}" method="POST" enctype="multipart/form-data" class="form-submit d-lg-flex d-block">
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
                                <input name="phone" id="phone" class="input-custom" type="text" placeholder="Masukan nomor telepon kamu" />
                            </div>
                            <div class="input mb-3">
                                <p class="mb-2">
                                    <label for="instansi">Instansi</label>
                                </p>
                                <div class="select">
                                    <select name="instansi" id="instansi" class="input-custom" require>
                                        @foreach ($instansis as $instansi)
                                        <option value="{{ $instansi->id }}">{{ $instansi->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="input mb-3">
                                <p class="mb-2">
                                    <label for="kegunaan">Kegunaan</label>
                                </p>
                                <div class="select">
                                    <select name="kegunaan" id="kegunaan" class="input-custom" require>
                                        @foreach ($kegunaans as $kegunaan)
                                        <option value="{{ $kegunaan->id }}">{{ $kegunaan->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="input mb-3">
                                <p class="mb-2">
                                    <label for="surat">Surat</label>
                                </p>
                                <input name="surat" id="surat" class="input-custom" type="file" placeholder="Masukan nomor telepon kamu" accept="application/pdf,application/" required />
                            </div>
                            <hr class="d-block d-sm-none" />
                        </div>
                        <hr class="vhr d-none d-sm-block" />
                        <div class="right">
                            <div class="input mb-3">
                                <div class="jadwal-heading">
                                    <div class="info">
                                        <img src="{{asset('images/info.svg')}}" class="mr-1" alt="">
                                        <label style="font-size: 16px;" for="">Pilih Maksimal 4 jadwal dalam satu kali pengajuan ya rekk!</label>
                                    </div>
                                    <div class="add-input" id="add-tanggal">
                                        <p class="">Tambah Jadwal +</p>
                                    </div>
                                </div>
                                <hr>
                                <div id="tanggal-container" class="mb-3">
                                    <div id="tanggal" class="field-input" style="margin-bottom: 8px">
                                        <div class="jh-input">
                                            <p class="mb-2">
                                                <label for="">Pilih Jadwal</label>
                                            </p>
                                        </div>
                                        <div class="time-selector row gx-2">
                                            <div class="col-12 col-sm-4">
                                                <p class="mb-2">
                                                    <label for="tanggal1">Tanggal Mulai</label>
                                                </p>
                                                <input type="text" name="moreFields[0][tanggal]" class="input-custom datepicker mb-2  @error('moreFields[0][tanggal]') is-invalid @enderror" id="date0" placeholder="Pilih Tanggal" />
                                                @error('moreFields[0][tanggal]')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                            <div class="col-4">
                                                <p class="mb-2">
                                                    <label for="jammulai.1">Jam Mulai</label>
                                                </p>
                                                <div class="select">
                                                    <select class="input-custom start-time  @error('moreFields[0][jammulai]') is-invalid @enderror" name="moreFields[0][jammulai]" id="start-time" required>
                                                        <option value="" disabled selected hidden>
                                                            Pilih jam mulai
                                                        </option>
                                                        <option value="7:00">7:00</option>
                                                        <option value="8:00">8:00</option>
                                                        <option value="9:00">9:00</option>
                                                        <option value="10:00">10:00</option>
                                                        <option value="11:00">11:00</option>
                                                        <option value="12:00">12:00</option>
                                                        <option value="13:00">13:00</option>
                                                        <option value="14:00">14:00</option>
                                                        <option value="15:00">15:00</option>
                                                        <option value="16:00">16:00</option>
                                                        <option value="17:00">17:00</option>
                                                        <option value="18:00">18:00</option>
                                                        <option value="19:00">19:00</option>
                                                        <option value="20:00">20:00</option>
                                                    </select>
                                                </div>
                                                @error('moreFields[0][jammulai]')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>

                                            <div class="col-4">
                                                <p class="mb-2">
                                                    <label for="jamselesai.1">Selesai</label>
                                                </p>
                                                <div class="select">
                                                    <select class="input-custom end-time  @error('moreFields[0][jamselesai]') is-invalid @enderror" name="moreFields[0][jamselesai]" id="end-time">
                                                        <option value="" disabled selected hidden>
                                                            Pilih jam selesai
                                                        </option>
                                                        <option value="8:00">8:00</option>
                                                        <option value="9:00">9:00</option>
                                                        <option value="10:00">10:00</option>
                                                        <option value="11:00">11:00</option>
                                                        <option value="12:00">12:00</option>
                                                        <option value="13:00">13:00</option>
                                                        <option value="14:00">14:00</option>
                                                        <option value="15:00">15:00</option>
                                                        <option value="16:00">16:00</option>
                                                        <option value="17:00">17:00</option>
                                                        <option value="18:00">18:00</option>
                                                        <option value="19:00">19:00</option>
                                                        <option value="20:00">20:00</option>
                                                        <option value="21:00">21:00</option>
                                                        <option value="22:00">22:00</option>
                                                    </select>
                                                </div>
                                                @error('moreFields[0][jamselesai]')
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
    $(document).ready(function() {
        var maxInputs = 3; // maximum number of input fields
        var inputsWrapper = $("#tanggal-container"); // container for input fields
        var addButton = $("#add-tanggal"); // button to add input field

        var i = 0; // current number of input fields
        var j = 1; // current number of input fields

        // add input field on button click
        $(addButton).click(function() {
            if (i < maxInputs) {
                i++;
                j++;
                $(inputsWrapper).append(`
                <div id="tanggal" class="field-input"  style="margin-bottom: 8px">
                <div class="jh-input">
                                        <p class="mb-2">
                                            <label for="">Pilih Jadwal ${j}</label>
                                        </p>
                                        <div class="remove-input">
                                            <p style="font-size: 16px">Hapus</p>
                                        </div>
                                    </div>
                                    <div class="time-selector row gx-2">
                                        <div class="col-12 col-sm-4">
                                            <p class="mb-2">
                                                <label for="moreFields[${i}][tanggal]">Tanggal Mulai</label>
                                            </p>
                                            <input type="text" name="moreFields[${i}][tanggal]" class="input-custom datepicker mb-2 @error('"moreFields[${i}][tanggal]') is-invalid @enderror" id="date${i}" placeholder="Pilih Tanggal" />
                                            @error('moreFields[${i}][tanggal]')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="col-4">
                                            <p class="mb-2">
                                                <label for="jammulai.${i}">Jam Mulai</label>
                                            </p>
                                            <div class="select">
                                                <select class="input-custom start-time  @error('"moreFields[${i}][jammulai]') is-invalid @enderror" name="moreFields[${i}][jammulai]" id="start-time${i}" required>
                                                    <option value="" disabled selected hidden>
                                                        Pilih jam mulai
                                                    </option>
                                                    <option value="7:00">7:00</option>
                                                    <option value="8:00">8:00</option>
                                                    <option value="9:00">9:00</option>
                                                    <option value="10:00">10:00</option>
                                                    <option value="11:00">11:00</option>
                                                    <option value="12:00">12:00</option>
                                                    <option value="13:00">13:00</option>
                                                    <option value="14:00">14:00</option>
                                                    <option value="15:00">15:00</option>
                                                    <option value="16:00">16:00</option>
                                                    <option value="17:00">17:00</option>
                                                    <option value="18:00">18:00</option>
                                                    <option value="19:00">19:00</option>
                                                    <option value="20:00">20:00</option>
                                                </select>
                                            </div>
                                            @error('moreFields[${i}][jammulai]')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>

                                        <div class="col-4">
                                            <p class="mb-2">
                                                <label for="jamselesai.${i}">Selesai</label>
                                            </p>
                                            <div class="select">
                                                <select class="input-custom end-time  @error('"moreFields[${i}][jamselesai]') is-invalid @enderror" name="moreFields[${i}][jamselesai]" id="end-time${i}">
                                                    <option value="" disabled selected hidden>
                                                        Pilih jam selesai
                                                    </option>
                                                    <option value="8:00">8:00</option>
                                                    <option value="9:00">9:00</option>
                                                    <option value="10:00">10:00</option>
                                                    <option value="11:00">11:00</option>
                                                    <option value="12:00">12:00</option>
                                                    <option value="13:00">13:00</option>
                                                    <option value="14:00">14:00</option>
                                                    <option value="15:00">15:00</option>
                                                    <option value="16:00">16:00</option>
                                                    <option value="17:00">17:00</option>
                                                    <option value="18:00">18:00</option>
                                                    <option value="19:00">19:00</option>
                                                    <option value="20:00">20:00</option>
                                                    <option value="21:00">21:00</option>
                                                    <option value="22:00">22:00</option>
                                                </select>
                                            </div>
                                            @error('moreFields[${i}][jamselesai]')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
            `);
            }
        });

        $(document).on("click", ".remove-input", function(e) {
            e.preventDefault();
            $(this).closest(".field-input").remove(); // remove parent div
            i--; // decrement input field count
        });
    });
</script>
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
    $(document).ready(function() {
        // Reinitialize or rebind the JavaScript code to the new element
        var minDate = new Date();
        var maxDate = new Date();

        // Initialize the datepicker on all fields with the "datepicker" class
        $(".datepicker").datepicker({
            dateFormat: "yy-mm-dd",
            minDate: 0,
            onClose: function(selectedDate) {
                // Get the ID of the current datepicker field
                var currentId = $(this).attr("id");

                // Find the other datepicker fields
                $(".datepicker")
                    .not("#" + currentId)
                    .datepicker("option", "minDate", selectedDate);
            },
        });

        // When the start time changes, update the end time options
        $(".start-time").change(function() {
            var startTime = $(this).val();
            var startTimeDate = new Date("01/01/2000 " + startTime);
            $(this)
                .closest(".time-selector")
                .find(".end-time option")
                .each(function() {
                    var endTime = $(this).val();
                    var endTimeDate = new Date("01/01/2000 " + endTime);
                    if (endTimeDate <= startTimeDate) {
                        $(this).prop("disabled", true);
                    } else {
                        $(this).prop("disabled", false);
                    }
                });
            $(this)
                .closest(".time-selector")
                .find(".end-time option:not(:disabled):first")
                .prop("selected", true);
        });
        $(document).on("click", "#add-tanggal", function() {
            // Your event handling code here
            var minDate = new Date();
            var maxDate = new Date();
            maxDate.setDate(maxDate.getDate() + 32);

            // Initialize the datepicker on all fields with the "datepicker" class
            $(".datepicker").datepicker({
                dateFormat: "yy-mm-dd",
                minDate: 0,
                onClose: function(selectedDate) {
                    // Get the ID of the current datepicker field
                    var currentId = $(this).attr("id");

                    // Find the other datepicker fields
                    $(".datepicker")
                        .not("#" + currentId)
                        .datepicker("option", selectedDate);
                },
            });

            // When the start time changes, update the end time options
            $(".start-time").change(function() {
                var startTime = $(this).val();
                var startTimeDate = new Date("01/01/2000 " + startTime);
                $(this)
                    .closest(".time-selector")
                    .find(".end-time option")
                    .each(function() {
                        var endTime = $(this).val();
                        var endTimeDate = new Date("01/01/2000 " + endTime);
                        if (endTimeDate <= startTimeDate) {
                            $(this).prop("disabled", true);
                        } else {
                            $(this).prop("disabled", false);
                        }
                    });
                $(this)
                    .closest(".time-selector")
                    .find(".end-time option:not(:disabled):first")
                    .prop("selected", true);
            });
        });
    });
</script>
<!-- /#wrapper -->

@endsection