@extends('layouts.app')

@section('content')
@include('components/navbar')

<section class="form-peminjaman">
    <div class="container">
        <div class="section-heading mb-4">
            <h2>Form Peminjaman</h2>
            <div class="rectangle"></div>
            <p>Jadwal Peminjaman Lapangan</p>
        </div>
        <div class="section-heading mb-4">
            <img src="{{asset('images/info.svg')}}" class="mr-1" alt="">
            <label style="font-size: 16px;" for="">Untuk harga peminjaman 1 Hari Rp.120.000</label>
        </div>

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

        @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
        @endif

        <div class="wrapper">
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
                        <div class="input mb-3">
                            <p class="mb-2">
                                <label for="kegunaan">Asal</label>
                            </p>
                            <input name="asal" id="kegunaan" class="input-custom" type="text" placeholder="Ketikan kegunaan penyewaan" />

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
</section>

<section id="jadwal" class="jadwal">
    <div class="container">
        <div class="jadwal-wrap" style="position:static;">
            <div class="section-heading" style="padding: 0;">
                <h2>Jadwal Peminjaman</h2>
                <div class="rectangle"></div>
                <p>Jadwal Peminjaman Lapangan</p>
            </div>
            <div id="calendar"></div>
        </div>
    </div>
</section>

@include('components/footer')

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
<!-- <script>
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
</script> -->
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
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var calendarEl = document.getElementById("calendar");
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: "dayGridMonth",
            contentHeight: 700,
            events: JSON.parse('{!! $jsonEvents !!}'),
            eventContent: function(info) {
                var eventTitle = info.event.title;
                var additionalInfo = info.event.extendedProps.additionalInfo;
                return {
                    html: '<div class="fc-content"><div class="fc-title">' +
                        eventTitle +
                        "</div></div>",
                };
            },

        });


        calendar.render();
    });
</script>
@endsection