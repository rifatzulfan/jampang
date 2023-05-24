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
                <h3>Edit User</h3>
                <div class="rectangle"></div>
                <p>
                    <a href="{{route('user.index')}}">User</a><span class="mx-2">/</span>Edit
                    User
                </p>
            </div>
            <div class="dashboard-container">
                <div class="card-form mx-auto">
                    <form class="mb-4" action="{{route('user.update', $user->id)}}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="input mb-3">
                            <p class="mb-2">
                                <label for="name">Nama</label>
                            </p>
                            <input id="name" name="name" value="{{ $user->name }}" class="input-custom  @error('name') is-invalid @enderror" type="text" placeholder="Masukan nama user" value="{{ old('name') }}" />
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
                            <input id="email" name="email" value="{{ $user->email }}" class="input-custom @error('email') is-invalid @enderror" type="text" placeholder="Masukan alamat email user" value="{{ old('email') }}" />
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
                            <input id="phone" name="phone" value="{{ $user->phone }}" class="input-custom @error('phone') is-invalid @enderror" type="text" placeholder="Masukan nomor hp user" value="{{ old('phone') }}" />
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
                            <input id="password" name="password" value="" class="input-custom @error('password') is-invalid @enderror" type="password" placeholder="Masukan password user" />
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
                                <select name="role" id="role" class="input-custom @error('role') is-invalid @enderror">
                                    <option selected hidden value="{{$user->role}}">{{$user->role}}</option>
                                    <option value="Superadmin">Superadmin</option>
                                    <option value="Admin">Admin</option>
                                    <option value="User">User</option>
                                </select>
                            </div>
                            @error('role')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <input type="submit" value="Perbarui" class="btn-primary-2 mt-2">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- /#wrapper -->

@endsection