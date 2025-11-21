@extends('layouts.default')

@push('styles')
<style type="text/css">
    #performaLayanan {
        width: 100%;
        height: 300px;
    }

    .check-space {
        margin-left: 40px;
    }

    .check-position {
        margin-top: 0px;
        margin-right: 10px;
    }
</style>
@endpush

@section('content')
<!-- row -->
<div class="container-fluid">
    <div class="row page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active"><a href="{{ url('/') }}">Form Nota Permintaan</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)">Ubah</a></li>
        </ol>
    </div>

    {{-- content --}}
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Form Nota Permintaan</h4>
            </div>
            <div class="card-body">
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <div class="basic-form">
                    <form action="{{ route('nota-permintaan.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3 row">
                            <label class="col-sm-2 col-form-label">No</label>
                            <div class="col-sm-10">
                                <input type="hidden" name="note_number" value="{{ $nextNumber }}">
                                <input type="text" class="form-control" name="number"
                                    placeholder="Masukan Nomor Nota Permintaan" value="{{ $number }}" readonly>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-2 col-form-label">Tanggal</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="date" value="{{ old('date') }}"
                                    placeholder="Tanggal" id="mdate">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-2 col-form-label">Kepada</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="to"
                                    value="Integrated Terminal Manager Balongan" readonly>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-2 col-form-label">Dari</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="from" value="{{ Auth::user()->position }}"
                                    readonly>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-2 col-form-label">Perihal</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="regarding" value="{{ old('regarding') }}"
                                    placeholder="Masukan perihal">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-2 col-form-label">Isi Body Surat</label>
                            <div class="col-sm-10">
                                <div class="custom-ekeditor">
                                    <textarea rows="4" id="ckeditor" name="body"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-2 col-form-label">Lampiran</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="file" id="lampiran" name="attachment">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <div class="col-sm-10">
                                <button class="btn btn-primary" id="button_action">
                                    Simpan Perubahan
                                </button>
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