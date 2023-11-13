@extends('layouts.app')

@section('content')
<nav id="navbar" class="navbar fixed-top navbar-expand-lg navbar-light py-24">
    <div class="container">
        <a class="navbar-brand fw-bold" href="#"><svg width="184" height="48" class="logo" viewBox="0 0 184 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M29.006 15.705C29.193 15.6371 29.3454 15.4977 29.4296 15.3175C29.5138 15.1373 29.5229 14.931 29.455 14.744C29.3871 14.557 29.2478 14.4047 29.0675 14.3205C28.8873 14.2363 28.681 14.2271 28.494 14.295L16 18.838V15C16 14.8011 15.921 14.6103 15.7804 14.4697C15.6397 14.329 15.449 14.25 15.25 14.25H13.75C13.5511 14.25 13.3604 14.329 13.2197 14.4697C13.0791 14.6103 13 14.8011 13 15V19.93L11.994 20.295C11.8071 20.3629 11.6547 20.5023 11.5705 20.6825C11.4863 20.8627 11.4771 21.069 11.545 21.256C11.6129 21.443 11.7523 21.5953 11.9326 21.6795C12.1128 21.7637 12.3191 21.7729 12.506 21.705L29.006 15.705Z" fill="white" />
                <path fill-rule="evenodd" clip-rule="evenodd" d="M13.019 23.115L28 17.667V21.09L32.006 22.546C32.193 22.6139 32.3453 22.7533 32.4295 22.9335C32.5137 23.1137 32.5229 23.32 32.455 23.507C32.3871 23.694 32.2477 23.8463 32.0675 23.9305C31.8873 24.0147 31.681 24.0239 31.494 23.956L31 23.776V32.251H31.75C31.9489 32.251 32.1397 32.33 32.2803 32.4707C32.421 32.6113 32.5 32.8021 32.5 33.001C32.5 33.1999 32.421 33.3907 32.2803 33.5313C32.1397 33.672 31.9489 33.751 31.75 33.751H12.25C12.0511 33.751 11.8603 33.672 11.7197 33.5313C11.579 33.3907 11.5 33.1999 11.5 33.001C11.5 32.8021 11.579 32.6113 11.7197 32.4707C11.8603 32.33 12.0511 32.251 12.25 32.251H13V23.122L13.019 23.116V23.115ZM28 32.25V22.685L29.5 23.23V32.25H28ZM19 26.25C18.8011 26.25 18.6103 26.329 18.4697 26.4697C18.329 26.6103 18.25 26.8011 18.25 27V31.5C18.25 31.914 18.586 32.25 19 32.25H22C22.1989 32.25 22.3897 32.171 22.5303 32.0303C22.671 31.8897 22.75 31.6989 22.75 31.5V27C22.75 26.8011 22.671 26.6103 22.5303 26.4697C22.3897 26.329 22.1989 26.25 22 26.25H19Z" fill="white" />
                <path d="M43.54 31.5V16.7H49.7C52.68 16.7 54.48 18.26 54.48 20.8C54.48 22.38 53.76 23.54 52.42 24.12C53.88 24.6 54.66 25.74 54.66 27.42C54.66 30.04 52.9 31.5 49.7 31.5H43.54ZM49.36 19.54H46.78V22.76H49.36C50.52 22.76 51.16 22.18 51.16 21.12C51.16 20.08 50.54 19.54 49.36 19.54ZM49.52 25.48H46.78V28.66H49.52C50.72 28.66 51.34 28.12 51.34 27.02C51.34 26.02 50.7 25.48 49.52 25.48ZM56.7408 25.94V16.7H59.9808V25.72C59.9808 27.58 61.0008 28.6 62.8208 28.6C64.6608 28.6 65.7008 27.54 65.7008 25.72V16.7H68.9408V25.94C68.9408 29.46 66.5408 31.74 62.8208 31.74C59.1208 31.74 56.7408 29.48 56.7408 25.94ZM70.7789 27.26V26.22H73.8989V27.26C73.8989 28.04 74.3389 28.76 75.5789 28.76C76.7789 28.76 77.2389 28.14 77.2389 27.14V16.7H80.4789V27.34C80.4789 29.88 78.5989 31.76 75.6189 31.76C72.3589 31.76 70.7789 29.82 70.7789 27.26ZM85.0913 31.5H81.7113L86.9913 16.7H90.1513L95.4113 31.5H91.9713L90.9313 28.38H86.1513L85.0913 31.5ZM88.1513 22.5L87.0913 25.66H90.0113L88.9513 22.5C88.7913 22 88.6113 21.42 88.5513 21.06C88.4913 21.4 88.3313 21.96 88.1513 22.5ZM100.334 31.5H97.1338V16.7H100.334L106.574 26.12V16.7H109.774V31.5H106.574L100.334 22.1V31.5ZM114.876 31.5H111.496L116.776 16.7H119.936L125.196 31.5H121.756L120.716 28.38H115.936L114.876 31.5ZM117.936 22.5L116.876 25.66H119.796L118.736 22.5C118.576 22 118.396 21.42 118.336 21.06C118.276 21.4 118.116 21.96 117.936 22.5ZM132.919 26.58H130.159V31.5H126.919V16.7H132.919C135.939 16.7 137.959 18.68 137.959 21.64C137.959 24.6 135.939 26.58 132.919 26.58ZM132.199 19.58H130.159V23.7H132.199C133.759 23.7 134.539 23.02 134.539 21.64C134.539 20.26 133.759 19.58 132.199 19.58ZM139.905 25.94V16.7H143.145V25.72C143.145 27.58 144.165 28.6 145.985 28.6C147.825 28.6 148.865 27.54 148.865 25.72V16.7H152.105V25.94C152.105 29.46 149.705 31.74 145.985 31.74C142.285 31.74 139.905 29.48 139.905 25.94ZM158.323 31.5H155.083V16.7H160.803C164.403 16.7 166.443 18.44 166.443 21.5C166.443 23.42 165.623 24.78 163.983 25.62L166.583 31.5H163.043L160.823 26.32H158.323V31.5ZM158.323 19.58V23.48H160.783C162.203 23.48 163.023 22.76 163.023 21.5C163.023 20.26 162.243 19.58 160.803 19.58H158.323ZM172.093 16.7V31.5H168.853V16.7H172.093Z" fill="white" />
            </svg>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mx-auto mb-4 mb-lg-0">
                <li class="nav-item">
                    <a class="link" aria-current="page" href="#jadwal">Jadwal</a>
                </li>
                <li class="nav-item">
                    <a class="link" href="#alur">Alur</a>
                </li>
                <li class="nav-item">
                    <a class="link" href="#sop">SOP</a>
                </li>
                <li class="nav-item">
                    <a class="link" href="#faq">FAQ</a>
                </li>
                <li class="nav-item">
                    <a class="link" href="#contact">Contact</a>
                </li>
            </ul>
            @auth
            <div style="width: 205px; text-align: end" class="my-4 my-lg-0">
                <a href="{{ auth()->user()->role === 'User' ? '/dashboard/peminjaman' : '/dashboard-admin/peminjaman' }}" class="profile-home">{{ auth()->user()->name }}</a>
            </div>
            @endauth
            @guest
            <div class="my-4 my-lg-0">
                <a href="/register" class="btn-secondarie mx-2"> Register </a>
                <a href="/login" class="btn-primarie"> Login </a>
            </div>
            @endguest
        </div>
    </div>
</nav>

<section class="hero">
    <div class="container">
        <div class="hero-heading">
            <div class="hero-title">
                <h1 class="text-white">
                    Peminjaman Gedung Serbaguna Bujana Puri
                </h1>
            </div>
            <div class="hero-subtitle">
                <p class="text-white">
                    Sistem Peminjaman Gedung Serbaguna Bujana Puri Kota Malang Jawa Timur
                </p>
                <div class="rectangle"></div>
            </div>
            <div class="hero-action text-center">
                <a href="{{route('form-peminjaman.index')}}" class="btn-primary mb-2">Mulai Pinjam</a>
                <a href="#alur" class="btn-secondary">Lihat Alur Peminjaman
                    <img src="{{asset('images/Arrow - bottom.svg')}}" alt="" class="ml-2" />
                </a>
            </div>
        </div>
    </div>
    <img src="{{ asset('images/hero.png') }}" class="hero-image" alt="" />
</section>

<section id="jadwal" class="jadwal">
    <div class="container">
        <div class="jadwal-wrap">
            <div class="section-heading" style="padding:0;">
                <h2>Jadwal Peminjaman</h2>
                <div class="rectangle"></div>
                <p>Jadwal Peminjaman Lapangan</p>
            </div>

            <div id='calendar'></div>
        </div>
    </div>
</section>

<section class="jadwal-bg"></section>

<section class="alurjadwal" id="alur">
    <div class="container">
        <img src="{{ asset('images/alur.png') }}" class="img-alur" alt="" />
        <div class="row gx-2 gy-2">
            <div class="col-12 col-sm-4 mb-4">
                <h1>
                    Alur Peminjaman <br class="d-none d-lg-block" />
                    Lapangan
                </h1>
            </div>
            <div class="col-sm-1 col-12">
                <div class="rectangle-2"></div>
            </div>
            <div class="col-12 col-sm">
                <div class="alur d-flex">
                    <h2 class="">1</h2>
                    <div class="alur-detail">
                        <h3>Buat Surat Izin Untuk Rektorat dan UABV</h3>
                        <p>
                            membuat surat izin yang diajukan kepada rektor dan juga UABV
                            UB. Pengajuan dapat diserahkan kepada rektorat bagian rumah
                            tangga yang bertempat di lt.4
                        </p>
                    </div>
                </div>
                <div class="alur d-flex">
                    <h2 class="">2</h2>
                    <div class="alur-detail">
                        <h3>Masuk / Daftar</h3>
                        <p>
                            Login untuk pengguna yang sudah memiliki akun peminjaman
                            lapangan, Register bagi yang belum
                        </p>
                    </div>
                </div>
                <div class="alur d-flex">
                    <h2 class="">3</h2>
                    <div class="alur-detail">
                        <h3>Isi Form dan Pilih Jadwal Tersedia</h3>
                        <p>
                            lihat jadwal peminjaman dan fill and submit form untuk
                            mengajukan peminjaman
                        </p>
                    </div>
                </div>
                <div class="alur d-flex">
                    <h2 class="">4</h2>
                    <div class="alur-detail">
                        <h3>Tunggu Validasi dan Feedback</h3>
                        <p>
                            Tunggu konfirmasi peminjaman lapangan oleh pengurus inti UABV
                            untuk di ACC pada dashboard pengguna
                        </p>
                    </div>
                </div>
                <div class="alur d-flex" style="margin-bottom: 0px">
                    <h2 class="">5</h2>
                    <div class="alur-detail">
                        <h3>TARAAAAA!!!!!!</h3>
                        <p>
                            Tunggu konfirmasi peminjaman lapangan oleh pengurus inti UABV
                            untuk di ACC pada dashboard pengguna
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="sop" class="sop">
    <div class="container">
        <div class="section-heading">
            <h2>SOP Peminjaman</h2>
            <div class="rectangle"></div>
            <p>Jadwal Peminjaman Lapangan</p>
        </div>

        <div class="row gx-3 gy-3">
            <div class="col-6 col-sm-3">
                <div class="sop-card">
                    <img src="" alt="" />
                    <h3>Pengajuan Surat Izin Ke Rektorat</h3>
                    <p>
                        Tunggu konfirmasi peminjaman lapangan oleh pengurus inti UABV
                        untuk di ACC pada dashboard pengguna
                    </p>
                </div>
            </div>
            <div class="col-6 col-sm-3">
                <div class="sop-card">
                    <img src="" alt="" />
                    <h3>Pengajuan Surat Izin Ke Rektorat</h3>
                    <p>
                        Tunggu konfirmasi peminjaman lapangan oleh pengurus inti UABV
                        untuk di ACC pada dashboard pengguna
                    </p>
                </div>
            </div>
            <div class="col-6 col-sm-3">
                <div class="sop-card">
                    <img src="" alt="" />
                    <h3>Pengajuan Surat Izin Ke Rektorat</h3>
                    <p>
                        Tunggu konfirmasi peminjaman lapangan oleh pengurus inti UABV
                        untuk di ACC pada dashboard pengguna
                    </p>
                </div>
            </div>
            <div class="col-6 col-sm-3">
                <div class="sop-card">
                    <img src="" alt="" />
                    <h3>Pengajuan Surat Izin Ke Rektorat</h3>
                    <p>
                        Tunggu konfirmasi peminjaman lapangan oleh pengurus inti UABV
                        untuk di ACC pada dashboard pengguna
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- <section id="faq" class="faq">
      <div class="container">
        <div class="section-heading">
          <h2>Frequently Asked Question</h2>
          <div class="rectangle"></div>
          <p>Jadwal Peminjaman Lapangan</p>
        </div>

        <div class="row gx-3 gy-3">
          <div class="col-6">
            <div class="faq-card">
              <h2>1</h2>
              <div class="alur-detail">
                <h3>TARAAAAA!!!!!!</h3>
                <p>
                  Tunggu konfirmasi peminjaman lapangan oleh pengurus inti UABV
                  untuk di ACC pada dashboard pengguna
                </p>
              </div>
            </div>
          </div>
          <div class="col-6">
            <div class="faq-card">
              <h2>1</h2>
              <div class="alur-detail">
                <h3>TARAAAAA!!!!!!</h3>
                <p>
                  Tunggu konfirmasi peminjaman lapangan oleh pengurus inti UABV
                  untuk di ACC pada dashboard pengguna
                </p>
              </div>
            </div>
          </div>
          <div class="col-6">
            <div class="faq-card">
              <h2>1</h2>
              <div class="alur-detail">
                <h3>TARAAAAA!!!!!!</h3>
                <p>
                  Tunggu konfirmasi peminjaman lapangan oleh pengurus inti UABV
                  untuk di ACC pada dashboard pengguna
                </p>
              </div>
            </div>
          </div>
          <div class="col-6">
            <div class="faq-card">
              <h2>1</h2>
              <div class="alur-detail">
                <h3>TARAAAAA!!!!!!</h3>
                <p>
                  Tunggu konfirmasi peminjaman lapangan oleh pengurus inti UABV
                  untuk di ACC pada dashboard pengguna
                </p>
              </div>
            </div>
          </div>
          <div class="col-6">
            <div class="faq-card">
              <h2>1</h2>
              <div class="alur-detail">
                <h3>TARAAAAA!!!!!!</h3>
                <p>
                  Tunggu konfirmasi peminjaman lapangan oleh pengurus inti UABV
                  untuk di ACC pada dashboard pengguna
                </p>
              </div>
            </div>
          </div>
          <div class="col-6">
            <div class="faq-card">
              <h2>1</h2>
              <div class="alur-detail">
                <h3>TARAAAAA!!!!!!</h3>
                <p>
                  Tunggu konfirmasi peminjaman lapangan oleh pengurus inti UABV
                  untuk di ACC pada dashboard pengguna
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section> -->

@include('components/footer')
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

    $(document).ready(function() {
        $(window).scroll(function() {
            var scroll = $(window).scrollTop();
            if (scroll > 0) {
                $("#navbar").addClass("navbar-scrolled");
                $(".logo").addClass("logo-scrolled");
                $(".link").addClass("navlink-scrolled");
                $(".btn-primarie").addClass("btn-primarie-scrolled");
                $(".btn-secondarie").addClass("btn-secondarie-scrolled");
                $(".profile-home").addClass("profile");
            } else {
                $("#navbar").removeClass("navbar-scrolled");
                $(".logo").removeClass("logo-scrolled");
                $(".link").removeClass("navlink-scrolled");
                $(".btn-primarie").removeClass("btn-primarie-scrolled");
                $(".btn-secondarie").removeClass("btn-secondarie-scrolled");
                $(".profile-home").removeClass("profile");
            }
        });
    });
</script>
@endsection