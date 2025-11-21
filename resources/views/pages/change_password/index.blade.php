@extends('layouts.default')

@push('styles')
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
            <li class="breadcrumb-item active"><a href="{{ url('/change-password') }}">Ganti Password</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)">Ubah</a></li>
        </ol>
    </div>

    {{-- content --}}
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Form Ganti Password</h4>
            </div>
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <div class="card-body">
                <div class="basic-form">
                    <form method="POST" action="{{ route('change-password.update', $user->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" class="form-control" name="password" placeholder="Password">
                        </div>
                        @error('password')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                        <div class="mb-3">
                            <label class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" name="confirm_password" placeholder="Confirm Password">
                        </div>
                        @error('confirm_password')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
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
@endpush