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
                <h3>Staff</h3>
                <div class="rectangle"></div>
                <p>Staff</p>
            </div>
            <div class="dashboard-container">
                <div class="table-function d-block d-lg-flex mb-4 align-items-baseline">
                    <form action="{{ route('staff.index') }}" method="GET" class="mb-2">
                        <div class="d-flex mb-4 mb-lg-0">
                            <input style="max-width: 420px" type="text" class="input-custom" id="cari" name="cari" placeholder="Cari" value="{{ request('cari') }}" />
                            <button type="submit" style="margin-left:8px; padding: 6px 12px; width:fit-content;" class="btn-primary-2 "><img class="py-2" src="{{asset('images/ri-search-line.svg')}}" alt=""></button>
                            @if (request('cari'))
                            <a href="{{ route('staff.index', ['clear' => true]) }}" class="mx-2"><img class="py-3" src="{{asset('images/clear.svg')}}" alt=""></a>
                            @endif
                        </div>
                    </form>
                    <a href="{{route('staff.create')}}" style="width: fit-content;" class="btn-primary-2 mx-0 mx-sm-1">Tambah</a>

                </div>
                @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
                @endif
                <div class="table-responsive">
                    <table id="myTable" class="table table-bordered rounded rounded-3 overflow-hidden">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Tarif</th>
                                <th>Deskripsi</th>
                                <th></th>
                            </tr>
                        </thead>
                        @php
                        $iteration = ($staffs->currentPage() - 1) * $staffs->perPage();
                        @endphp
                        <tbody>
                            @foreach ($staffs as $staff)
                            @php
                            $iteration++;
                            @endphp
                            <tr>
                                <th style="width: 48px;" scope="row">{{$iteration}}</th>
                                <td class="w-25">{{$staff->name}}</td>
                                <td class="w-25">{{$staff->price}}</td>
                                <td class="w-25">{{$staff->description}}</td>
                                <td style="width: 128px;" class="text-end">
                                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Staff</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body text-start">
                                                    Kamu akan menghapus staff {{$staff->name}}
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                    <form action="{{route('staff.destroy',$staff->id)}}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <a href="{{route('staff.edit',$staff->id)}}" class="mx-0 mx-sm-3" style="color:transparent;">
                                        <img src="{{asset('images/edit.svg')}}" style="cursor: pointer" alt="" />
                                    </a>
                                    <button class="btn-delete my-3 my-sm-0" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                        <img src="{{asset('images/delete.svg')}}" style="cursor: pointer" alt="" />
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>


                <div aria-label="Page navigation example" class="mt-4">
                    {!! $staffs->links() !!}
                </div>
            </div>
        </div>
    </div>
</div>

<!-- /#wrapper -->

@endsection