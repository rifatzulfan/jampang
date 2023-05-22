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
                <h3>Edit Instansi</h3>
                <div class="rectangle"></div>
                <p>
                    <a href="{{route('instansi.index')}}">Instansi</a><span class="mx-2">/</span>Edit
                    Instansi
                </p>
            </div>
            <div class="dashboard-container">
                <div class="card-form mx-auto">
                    <form id="myForm" action="{{route('instansi.update', $instansi->id)}}" method="POST" class="form-submit d-block" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="input mb-3">
                            <p class="mb-2">
                                <label for="name">Nama</label>
                            </p>
                            <input name="name" id="name" class="input-custom @error('name') is-invalid @enderror" type="text" value="{{ $instansi->name }}" placeholder="Masukan Nama Instansi" />
                            @error('name')
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