@extends('layouts.default')

@section('content')
<div class="container-fluid">

    <div class="row page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Ganti Password</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)">Ganti Password</a></li>
        </ol>
    </div>
    <!-- row -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Ganti Password</h4>
                </div>
                <div class="card-body">

                    <div class="row">
                        <div class="col-12">
                            <a href="{{ route('management-users.index') }}" class="btn btn-primary mb-4">
                                <i class="fas fa-arrow-left"></i>
                                Kembali
                            </a>
                        </div>
                    </div>

                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    @if(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                    @endif

                    <form action="{{ route('management-users.postGantiPassword') }}" method="POST">
                        @csrf
                        <input type="hidden" id="users_id" name="users_id" value="{{ $id }}">

                        <div class="form-group mb-2">
                            <label for="password">Masukan Password Baru</label>
                            <input class="form-control" type="text" id="password" name="password">
                        </div>

                        <div class="form-group mb-2">
                            <label for="password">Konfirmasi Password Baru</label>
                            <input class="form-control" type="text" id="konfirmasi_password" name="konfirmasi_password">
                        </div>

                        <div class="form-group mt-3">
                            <button class="btn btn-primary" id="button_action">
                                <i class="fa fa-save"></i>
                                Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@push('scripts')
@endpush