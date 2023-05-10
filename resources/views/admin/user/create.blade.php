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
                <h3>Tambah User</h3>
                <div class="rectangle"></div>
                <p>
                    <a href="{{route('user.index')}}">User</a><span class="mx-2">/</span>Tambah
                    User
                </p>
            </div>
            <div class="dashboard-container">
                <div class="card-form mx-auto">
                    <form class="mb-4" action="{{route('user.store')}}" method="POST">
                        @csrf
                        <div class="input mb-3">
                            <p class="mb-2">
                                <label for="name">Nama</label>
                            </p>
                            <input id="name" name="name" class="input-custom  @error('name') is-invalid @enderror" type="text" placeholder="Masukan nama user" value="{{ old('name') }}" />
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
                            <input id="email" name="email" class="input-custom @error('email') is-invalid @enderror" type="text" placeholder="Masukan alamat email user" value="{{ old('email') }}" />
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
                            <input id="phone" name="phone" class="input-custom @error('phone') is-invalid @enderror" type="text" placeholder="Masukan nomor hp user" value="{{ old('phone') }}" />
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
                            <input id="password" name="password" class="input-custom @error('password') is-invalid @enderror" type="password" placeholder="Masukan password user" />
                            @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="input mb-3">
                            <p class="mb-2">
                                <label for="role_id">Role</label>
                            </p>
                            <div class="select">
                                <select name="role_id" id="role_id" class="input-custom @error('role') is-invalid @enderror">
                                    @foreach ($roles as $role)
                                    <option value="{{$role->id}}">{{$role->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('role')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <input type="submit" value="Tambahkan" class="btn-primary-2 mt-2">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- /#wrapper -->

@endsection