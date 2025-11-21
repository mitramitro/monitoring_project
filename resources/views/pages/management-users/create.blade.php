@extends('layouts.default')

@section('content')
<div class="container-fluid">

    <div class="row page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Tambah User</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)">Tambah User</a></li>
        </ol>
    </div>
    <!-- row -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Tambah User</h4>
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

                    <form action="{{ route('management-users.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-4 row align-items-center">
                            <label for="nama" class="col-3">Nama <span class="text-danger">*</span> </label>
                            <div class="col-9">
                                <input class="form-control" type="text" id="name" value="{{ old('name') }}" name="name"
                                    placeholder="Masukan nama" required>
                            </div>
                        </div>

                       

                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Perusahaan</label>
                            <div class="col-sm-9">

                                <select class="single-select" id="company" name="company_id">
                                    <option value="">Pilih Perusahaan</option>
                                    @foreach ($companies as $company)
                                    <option value="{{ $company->id }}">{{ $company->name }}</option>
                                    @endforeach
                                    <option value="0">Lainnya</option>
                                </select>
                                <div class="mt-2" id="company_other_div" style="display: none;">
                                    <input type="text" class="form-control" name="company_other" id="company_other" placeholder="Masukkan Perusahaan Lainnya">
                                </div>
                            </div>
                        </div>


                       


                        <div class="form-group mb-4 row align-items-center">
                            <label for="username" class="col-3">Username <span class="text-danger">*</span></label>
                            <div class="col-9">
                                <input class="form-control" type="text" id="username" value="{{ old('username') }}"
                                    name="username" placeholder="Masukan username" required>
                            </div>
                        </div>

                        <div class="form-group mb-4 row align-items-center">
                            <label for="password" class="col-3">Password <span class="text-danger">*</span></label>
                            <div class="col-9">
                                <input class="form-control" type="text" id="password" value="{{ old('password') }}"
                                    name="password" placeholder="Masukan password" required>
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
    $(document).ready(function() {
        $('#company').on('change', function() {
            if ($(this).val() == '0') {
                $('#company_other_div').show();
            } else {
                $('#company_other_div').hide();
                $('#company_other').val('');
            }
        });
    });
</script>
@endpush