@extends('layouts.app')

@section('content')
<nav class="navbar navbar-expand-lg navbar-light py-24">
    <div class="container">
        <div class="mx-auto">
            <a class="navbar-brand fw-bold logo-2" href="/"><svg width="184" height="47" viewBox="0 0 184 47" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M29.006 15.205C29.193 15.1371 29.3454 14.9977 29.4296 14.8175C29.5138 14.6373 29.5229 14.431 29.455 14.244C29.3871 14.057 29.2478 13.9047 29.0675 13.8205C28.8873 13.7363 28.681 13.7271 28.494 13.795L16 18.338V14.5C16 14.3011 15.921 14.1103 15.7804 13.9697C15.6397 13.829 15.449 13.75 15.25 13.75H13.75C13.5511 13.75 13.3604 13.829 13.2197 13.9697C13.0791 14.1103 13 14.3011 13 14.5V19.43L11.994 19.795C11.8071 19.8629 11.6547 20.0023 11.5705 20.1825C11.4863 20.3627 11.4771 20.569 11.545 20.756C11.6129 20.943 11.7523 21.0953 11.9326 21.1795C12.1128 21.2637 12.3191 21.2729 12.506 21.205L29.006 15.205Z" fill="#222222" />
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M13.019 22.615L28 17.167V20.59L32.006 22.046C32.193 22.1139 32.3453 22.2533 32.4295 22.4335C32.5137 22.6137 32.5229 22.82 32.455 23.007C32.3871 23.194 32.2477 23.3463 32.0675 23.4305C31.8873 23.5147 31.681 23.5239 31.494 23.456L31 23.276V31.751H31.75C31.9489 31.751 32.1397 31.83 32.2803 31.9707C32.421 32.1113 32.5 32.3021 32.5 32.501C32.5 32.6999 32.421 32.8907 32.2803 33.0313C32.1397 33.172 31.9489 33.251 31.75 33.251H12.25C12.0511 33.251 11.8603 33.172 11.7197 33.0313C11.579 32.8907 11.5 32.6999 11.5 32.501C11.5 32.3021 11.579 32.1113 11.7197 31.9707C11.8603 31.83 12.0511 31.751 12.25 31.751H13V22.622L13.019 22.616V22.615ZM28 31.75V22.185L29.5 22.73V31.75H28ZM19 25.75C18.8011 25.75 18.6103 25.829 18.4697 25.9697C18.329 26.1103 18.25 26.3011 18.25 26.5V31C18.25 31.414 18.586 31.75 19 31.75H22C22.1989 31.75 22.3897 31.671 22.5303 31.5303C22.671 31.3897 22.75 31.1989 22.75 31V26.5C22.75 26.3011 22.671 26.1103 22.5303 25.9697C22.3897 25.829 22.1989 25.75 22 25.75H19Z" fill="#222222" />
                    <path d="M43.54 31V16.2H49.7C52.68 16.2 54.48 17.76 54.48 20.3C54.48 21.88 53.76 23.04 52.42 23.62C53.88 24.1 54.66 25.24 54.66 26.92C54.66 29.54 52.9 31 49.7 31H43.54ZM49.36 19.04H46.78V22.26H49.36C50.52 22.26 51.16 21.68 51.16 20.62C51.16 19.58 50.54 19.04 49.36 19.04ZM49.52 24.98H46.78V28.16H49.52C50.72 28.16 51.34 27.62 51.34 26.52C51.34 25.52 50.7 24.98 49.52 24.98ZM56.7408 25.44V16.2H59.9808V25.22C59.9808 27.08 61.0008 28.1 62.8208 28.1C64.6608 28.1 65.7008 27.04 65.7008 25.22V16.2H68.9408V25.44C68.9408 28.96 66.5408 31.24 62.8208 31.24C59.1208 31.24 56.7408 28.98 56.7408 25.44ZM70.7789 26.76V25.72H73.8989V26.76C73.8989 27.54 74.3389 28.26 75.5789 28.26C76.7789 28.26 77.2389 27.64 77.2389 26.64V16.2H80.4789V26.84C80.4789 29.38 78.5989 31.26 75.6189 31.26C72.3589 31.26 70.7789 29.32 70.7789 26.76ZM85.0913 31H81.7113L86.9913 16.2H90.1513L95.4113 31H91.9713L90.9313 27.88H86.1513L85.0913 31ZM88.1513 22L87.0913 25.16H90.0113L88.9513 22C88.7913 21.5 88.6113 20.92 88.5513 20.56C88.4913 20.9 88.3313 21.46 88.1513 22ZM100.334 31H97.1338V16.2H100.334L106.574 25.62V16.2H109.774V31H106.574L100.334 21.6V31ZM114.876 31H111.496L116.776 16.2H119.936L125.196 31H121.756L120.716 27.88H115.936L114.876 31ZM117.936 22L116.876 25.16H119.796L118.736 22C118.576 21.5 118.396 20.92 118.336 20.56C118.276 20.9 118.116 21.46 117.936 22ZM132.919 26.08H130.159V31H126.919V16.2H132.919C135.939 16.2 137.959 18.18 137.959 21.14C137.959 24.1 135.939 26.08 132.919 26.08ZM132.199 19.08H130.159V23.2H132.199C133.759 23.2 134.539 22.52 134.539 21.14C134.539 19.76 133.759 19.08 132.199 19.08ZM139.905 25.44V16.2H143.145V25.22C143.145 27.08 144.165 28.1 145.985 28.1C147.825 28.1 148.865 27.04 148.865 25.22V16.2H152.105V25.44C152.105 28.96 149.705 31.24 145.985 31.24C142.285 31.24 139.905 28.98 139.905 25.44ZM158.323 31H155.083V16.2H160.803C164.403 16.2 166.443 17.94 166.443 21C166.443 22.92 165.623 24.28 163.983 25.12L166.583 31H163.043L160.823 25.82H158.323V31ZM158.323 19.08V22.98H160.783C162.203 22.98 163.023 22.26 163.023 21C163.023 19.76 162.243 19.08 160.803 19.08H158.323ZM172.093 16.2V31H168.853V16.2H172.093Z" fill="#222222" />
                </svg>

            </a>
        </div>
    </div>
</nav>

<section class="auth">
    <div class="container">
        <div class="card-auth mx-auto">
            <div class="header-auth mb-4">
                <h2 class="mb-3">Daftar</h2>
                <p>Daftar dulu guys baru langkah selanjutnya</p>
                <div class="rectangle"></div>
            </div>
            <div class="form-register">
                <form class="mb-4" action="" method="POST">
                    @csrf
                    <div class="input mb-3">
                        <p class="mb-2">
                            <label for="name">Nama</label>
                        </p>
                        <input id="name" name="name" class="input-custom  @error('name') is-invalid @enderror" type="text" placeholder="Masukan nama kamu" value="{{ old('name') }}" />
                        @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="input mb-3">
                        <p class="mb-2">
                            <label for="email">Email</label>
                        </p>
                        <input id="email" name="email" class="input-custom @error('email') is-invalid @enderror" type="text" placeholder="Masukan alamat email kamu" value="{{ old('email') }}" />
                        @error('email')
                        <div class=" invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="input mb-3">
                        <p class="mb-2">
                            <label for="phone">No Telepon</label>
                        </p>
                        <input id="phone" name="phone" class="input-custom @error('phone') is-invalid @enderror" type="text" placeholder="Masukan nomor hp kamu" value="{{ old('phone') }}" />
                        @error('phone')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="input mb-3">
                        <p class="mb-2">
                            <label for="password">Password</label>
                        </p>
                        <input id="password" name="password" class="input-custom @error('password') is-invalid @enderror" type="password" placeholder="Masukan password kamu" />
                        @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="input mb-3">
                        <p class="mb-2">
                            <label for="password_confirmation">Konfirmasi Password</label>
                        </p>
                        <input id="password_confirmation" name="password_confirmation" class="input-custom  @error('password_confirmation') is-invalid @enderror" type="password" placeholder="Konfirmasi password kamu" />
                        @error('password_confirmation')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <input type="submit" value="Daftar" class="btn-primary-2 mt-2">
                </form>
                <div class="forgot-password mt-5">
                    <p class="message">Sudah punya Akun?<a href="/login"> Masuk</a></p>
                </div>
            </div>
        </div>
    </div>
</section>

<img src="{{ asset('images/auth.png') }}" class="img-reg" alt="" />
@endsection