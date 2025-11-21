@extends('layouts.default')

@push('styles')
<link rel="stylesheet" href="{{ asset('templateadmin/vendor/sweetalert2/dist/sweetalert2.min.css') }}">
<style type="text/css">
    #performaLayanan {
        width: 100%;
        height: 300px;
    }
</style>
@endpush

@section('content')
<!-- row -->
<div class="container-fluid">
    <div class="row page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active"><a href="{{ url('/home') }}">Pengaturan</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)">Ubah</a></li>
        </ol>
    </div>

    {{-- content --}}
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Form Ubah Pengaturan</h4>
            </div>
            <div class="card-body">
                <div class="basic-form">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <form action="{{ route('pengaturan.update', $data->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3 row">
                            <label class="col-sm-2 col-form-label">Nama</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="name" placeholder="Nama"
                                    value="{{ $data->name }}">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-2 col-form-label">Jabatan</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="jabatan" placeholder="Jabatan"
                                    value="{{ $data->position }}">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-2 col-form-label">Fungsi</label>
                            <div class="col-sm-10">

                                <select class="single-select" id="division" name="division_id">
                                    <option value="">Pilih Fungsi</option>
                                    @foreach ($divisions as $division)
                                    <option value="{{ $division->id }}" {{ $data->division_id == $division->id ?
                                        'selected' : '' }} >{{
                                        $division->name }}</option>
                                    @endforeach
                                    <option value="0">Lainnya</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control" name="email" placeholder="Nama Email"
                                    value="{{ $data->email }}">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-2 col-form-label">No Hp</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="phone_number" placeholder="No Hp"
                                    value="{{ $data->phone_number }}">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-2 col-form-label">Username</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="username" placeholder="Username"
                                    value="{{ $data->username }}">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-2 col-form-label">Password</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" name="password" placeholder="password..">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- end conten --}}
</div>

@endsection

@push('scripts')
<script src="{{ asset('templateadmin/vendor/sweetalert2/dist/sweetalert2.min.js') }}"></script>
<script>
    let success = '{{ Session::get("success") }}';
    let error = '{{ Session::get("error") }}';
    if(success) {
        swal("Berhasil", success, "success");
    } else if(error) {
        swal("Gagal", error, "error");
    }
</script>
@endpush