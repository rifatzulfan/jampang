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
                <h3>Tambah Role</h3>
                <div class="rectangle"></div>
                <p>
                    <a href="{{route('role.index')}}">Role</a><span class="mx-2">/</span>Tambah
                    Role
                </p>
            </div>
            <div class="dashboard-container">
                <div class="card-form mx-auto">
                    <form id="myForm" action="{{route('role.store')}}" method="POST" class="form-submit d-block">
                        @csrf
                        <div class="input mb-3">
                            <p class="mb-2">
                                <label for="name">Nama</label>
                            </p>
                            <input name="name" id="name" class="input-custom @error('name') is-invalid @enderror" type="text" placeholder="Masukan Nama Role" />
                            @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <input type="submit" value="Tambah" class="btn-primary-2 mt-2">

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- /#wrapper -->

@endsection