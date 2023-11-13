@extends('layouts.app')

@section('content')
<nav id="navbar" class="navbar fixed-top navbar-expand-lg navbar-light py-24">
    <div class="container">
        <a class="navbar-brand fw-bold" href="#"><svg width="235" height="48" viewBox="0 0 235 48" class="logo" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M15.2874 14.7095C16.6105 13.9267 17.7367 13.5455 19.5331 13.2721C19.6924 13.2479 19.828 13.2427 19.828 13.2609C19.828 13.2698 19.6242 13.4035 19.3751 13.5581C16.8011 15.1554 14.8632 17.8141 14.1171 20.7716C13.8364 21.8845 13.7511 22.6051 13.7526 23.8518C13.7536 24.7016 13.7483 24.7664 13.6786 24.7664C13.5123 24.7664 12.8231 24.6293 12.2912 24.4903C11.6291 24.3174 11.0924 24.1233 10.4585 23.8275L10 23.6135L10.0281 23.2123C10.2738 19.7024 12.2511 16.5058 15.2874 14.7095ZM24.6063 16.3332C25.1422 15.8002 25.517 15.4831 26.0808 15.0859C26.2683 14.9538 26.447 14.845 26.4778 14.8441C26.5086 14.8433 26.6982 14.9552 26.8991 15.0929C29.1079 16.6065 30.6635 18.8643 31.2898 21.4655C31.5091 22.3762 31.5599 22.8408 31.5609 23.9464C31.5624 25.5191 31.3605 26.606 30.811 27.9832L30.5929 28.5299L30.5426 27.7987C30.4577 26.5613 30.2944 25.6756 29.962 24.6493C29.0049 21.6948 26.8661 19.1539 24.1466 17.7407C23.8685 17.5962 23.6337 17.4722 23.6247 17.465C23.5864 17.4348 24.1359 16.8012 24.6063 16.3332ZM21.6837 21.6347C21.8763 20.7479 22.3329 19.527 22.7509 18.7809L22.9099 18.4973L23.444 18.7752C26.2428 20.2312 28.2402 22.7675 28.9902 25.8177C29.214 26.728 29.2854 27.3483 29.2852 28.3827C29.285 29.3017 29.2499 29.6797 29.0885 30.5022C29.0044 30.9306 28.9856 30.9761 28.8018 31.196C28.4711 31.5918 27.3019 32.6411 27.1203 32.7051C27.1012 32.7118 27.0628 32.5358 27.0348 32.3139C26.8131 30.5565 26.1237 28.7151 25.1299 27.2264C24.6179 26.4594 24.2839 26.0541 23.6018 25.3723C22.9757 24.7465 22.463 24.3189 21.8145 23.8813L21.4204 23.6154L21.4489 23.2553C21.4905 22.7298 21.5799 22.1127 21.6837 21.6347ZM14.6074 26.095C16.6002 26.1739 18.7771 25.7003 20.4811 24.8173C20.6201 24.7453 20.7447 24.6854 20.758 24.6843C20.7713 24.6832 20.9229 24.7791 21.095 24.8974C22.2855 25.7155 23.2903 26.7248 24.0622 27.8779C24.348 28.3049 24.451 28.4952 24.4138 28.5278C24.4059 28.5347 24.2572 28.635 24.0834 28.7507C23.0531 29.4361 21.7749 29.9786 20.5283 30.2594C17.0858 31.035 13.5256 30.103 10.8723 27.7318C10.5836 27.4738 10.5714 27.4548 10.4629 27.0938C10.4014 26.8892 10.3227 26.6082 10.2881 26.4694C10.2227 26.2075 10.0534 25.2176 10.0533 25.0971C10.0533 25.0406 10.1319 25.0607 10.4926 25.2095C11.8478 25.7685 13.0852 26.0347 14.6074 26.095ZM20.1502 31.5991C21.7679 31.3259 23.2899 30.7417 24.6311 29.8793C24.8281 29.7526 25.0024 29.6621 25.0184 29.6782C25.0663 29.726 25.3277 30.4367 25.4467 30.8427C25.6751 31.6219 25.853 32.673 25.853 33.2437V33.5169L25.4095 33.7236C21.8888 35.3644 17.7941 35.0204 14.6247 32.8177C13.8063 32.2488 12.9014 31.3958 12.3111 30.6366C12.0624 30.3166 11.9394 30.1629 11.9641 30.1336C11.9877 30.1056 12.1465 30.1916 12.4597 30.3552C14.8788 31.6184 17.5132 32.0445 20.1502 31.5991Z" fill="white" />
                <path d="M22.2928 13.536C20.7133 14.0804 19.3686 14.9205 18.1838 16.103C17.308 16.9771 16.6568 17.8849 16.1201 18.9798C15.4376 20.3722 15.1257 21.5329 15.0172 23.0844C14.9846 23.5517 14.9813 23.9498 15.0073 24.3038L15.046 24.8295L15.3608 24.842C15.7327 24.8568 16.6291 24.7596 17.2106 24.6413C18.0517 24.4702 18.913 24.1848 19.6846 23.8212C20.1988 23.579 20.2056 23.5707 20.2066 23.1811C20.2075 22.8712 20.3185 22.0575 20.4409 21.4655C20.8084 19.6861 21.6494 17.909 22.8188 16.4405C23.2705 15.8733 24.1504 14.9954 24.7154 14.5485C24.9587 14.356 25.1578 14.1793 25.1578 14.1559C25.1578 14.0384 23.7842 13.5864 22.8405 13.3935C22.7942 13.384 22.5477 13.4481 22.2928 13.536Z" fill="white" />
                <path d="M39.9609 27.26C39.9609 29.82 41.5409 31.76 44.8009 31.76C47.7809 31.76 49.6609 29.88 49.6609 27.34V16.7H46.4209V27.14C46.4209 28.14 45.9609 28.76 44.7609 28.76C43.5209 28.76 43.0809 28.04 43.0809 27.26V26.22H39.9609V27.26ZM54.2733 31.5L55.3333 28.38H60.1133L61.1533 31.5H64.5933L59.3333 16.7H56.1733L50.8933 31.5H54.2733ZM57.3333 22.5C57.5133 21.96 57.6733 21.4 57.7333 21.06C57.7933 21.42 57.9733 22 58.1333 22.5L59.1933 25.66H56.2733L57.3333 22.5ZM69.4558 31.5V27.36C69.4558 25.74 69.4358 24.5 69.2558 23.4L72.3758 31.5H75.3358L78.4758 23.4C78.3158 24.5 78.3158 25.2 78.3158 28.4V31.5H81.4558V16.7H78.2758L73.8558 27.74L69.4558 16.7H66.3158V31.5H69.4558ZM90.5384 26.58C93.5584 26.58 95.5784 24.6 95.5784 21.64C95.5784 18.68 93.5584 16.7 90.5384 16.7H84.5384V31.5H87.7784V26.58H90.5384ZM89.8184 19.58C91.3784 19.58 92.1584 20.26 92.1584 21.64C92.1584 23.02 91.3784 23.7 89.8184 23.7H87.7784V19.58H89.8184ZM98.7459 31.5L99.8059 28.38H104.586L105.626 31.5H109.066L103.806 16.7H100.646L95.3659 31.5H98.7459ZM101.806 22.5C101.986 21.96 102.146 21.4 102.206 21.06C102.266 21.42 102.446 22 102.606 22.5L103.666 25.66H100.746L101.806 22.5ZM113.988 31.5V22.1L120.228 31.5H123.428V16.7H120.228V26.12L113.988 16.7H110.788V31.5H113.988ZM133.171 19.5C134.711 19.5 136.071 20.18 136.451 21.74H139.851C139.511 18.54 136.791 16.46 133.251 16.46C128.671 16.46 125.691 19.68 125.691 24.14C125.691 28.68 128.591 31.72 132.731 31.72C134.491 31.72 136.091 31.1 136.891 30.16L137.071 31.5H139.851V23H132.891V25.84H136.811C136.671 27.38 135.591 28.7 133.151 28.7C130.791 28.7 129.111 27.22 129.111 24.24C129.111 21.38 130.491 19.5 133.171 19.5Z" fill="white" />
                <path d="M149.737 31L153.609 24.92L149.865 19.08H151.305L154.553 24.168H154.121L157.353 19.08H158.793L155.049 24.92L158.937 31H157.497L154.121 25.688H154.553L151.145 31H149.737Z" fill="white" />
                <path d="M169.001 25.94C169.001 29.48 171.381 31.74 175.081 31.74C178.801 31.74 181.201 29.46 181.201 25.94V16.7H177.961V25.72C177.961 27.54 176.921 28.6 175.081 28.6C173.261 28.6 172.241 27.58 172.241 25.72V16.7H169.001V25.94ZM185.594 31.5L186.654 28.38H191.434L192.474 31.5H195.914L190.654 16.7H187.494L182.214 31.5H185.594ZM188.654 22.5C188.834 21.96 188.994 21.4 189.054 21.06C189.114 21.42 189.294 22 189.454 22.5L190.514 25.66H187.594L188.654 22.5ZM197.636 31.5H203.796C206.996 31.5 208.756 30.04 208.756 27.42C208.756 25.74 207.976 24.6 206.516 24.12C207.856 23.54 208.576 22.38 208.576 20.8C208.576 18.26 206.776 16.7 203.796 16.7H197.636V31.5ZM203.456 19.54C204.636 19.54 205.256 20.08 205.256 21.12C205.256 22.18 204.616 22.76 203.456 22.76H200.876V19.54H203.456ZM203.616 25.48C204.796 25.48 205.436 26.02 205.436 27.02C205.436 28.12 204.816 28.66 203.616 28.66H200.876V25.48H203.616ZM214.746 31.5H218.086L223.526 16.7H220.146L217.386 24.18C217.066 25.06 216.786 25.88 216.406 27.3C216.086 26.02 215.806 25.1 215.466 24.18L212.666 16.7H209.206L214.746 31.5Z" fill="white" />
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
                    Peminjaman Gedung Olahraga Pendowo
                </h1>
            </div>
            <div class="hero-subtitle">
                <p class="text-white">
                    Sistem Peminjaman Gedung Olahraga Pendowo
                    dikelola oleh Unit Aktivitas Pemuda Pendowo
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