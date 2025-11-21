@extends('layouts.default')

@section('content')
<div class="container-fluid">

    <div class="row page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Edit User</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)">Edit User</a></li>
        </ol>
    </div>
    <!-- row -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Edit User</h4>
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

                    <form action="{{ route('management-users.update', $user->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="form-group mb-4 row align-items-center">
                            <label for="nama" class="col-3">Nama <span class="text-danger">*</span> </label>
                            <div class="col-9">
                                <input class="form-control" type="text" id="name"
                                    value="{{ old('name') ? old('name') : $user->name }}" name="name"
                                    placeholder="Masukan nama" required>
                            </div>
                        </div>

                       

                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Fungsi</label>
                            <div class="col-sm-9">

                                <select class="single-select" id="company" name="company_id">
                                    <option value="">Pilih Perusahaan</option>
                                    @foreach ($companies as $company)
                                    <option value="{{ $company->id }}" {{ $user->company_id == $company->id ?
                                        'selected' : '' }} >{{
                                        $company->name }}</option>
                                    @endforeach
                                    <option value="0">Lainnya</option>
                                </select>
                            </div>
                        </div>

                        

                        

                        <div class="form-group mb-4 row align-items-center">
                            <label for="username" class="col-3">Username <span class="text-danger">*</span></label>
                            <div class="col-9">
                                <input class="form-control" type="text" id="username"
                                    value="{{ old('username') ? old('username') : $user->username }}" name="username"
                                    placeholder="Masukan username" disabled>
                            </div>
                        </div>

                        <div class="form-group mb-4 row align-items-center">
                            <label for="password" class="col-3">Role <span class="text-danger">*</span></label>
                            <div class="col-9">
                                <select name="role" id="role" class="single-select" required>
                                   <option value="">Pilih</option>
                                    <option value="mps" {{ old('role')=='mps' ? 'selected' : '' }}>MPS
                                    </option>
                                    <option value="vendor" {{ old('role')=='vendor' ? 'selected' : '' }}>Vendor
                                    </option>
                                    <option value="display" {{ old('role')=='display' ? 'selected' : '' }}>Display
                                    </option>
                                </select>
                            </div>
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
<script>

</script>
@endpush