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
            <li class="breadcrumb-item active"><a href="{{ url('/') }}">Form permohonan PTPP</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)">Form PTPP</a></li>
        </ol>
    </div>

    {{-- content --}}
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Form Permohonan PTPP</h4>
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
                    <form action="{{ route('permohonan-ptpp.store') }}" enctype="multipart/form-data"
                        id="formPermohonanPtpp" method="POST">
                        @csrf
                        <div class="mb-3 row">
                            <label class="col-sm-2 col-form-label">No. PTPP</label>
                            <div class="col-sm-10">
                                <input type="hidden" name="ptpp_number" value="{{ $nextNumber }}">
                                <input type="text" class="form-control" name="number" value="{{ $number }}"
                                    placeholder="No. PTPP" readonly>
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
                            <label class="col-sm-2 col-form-label">Nama Pemohon</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="name" value="{{ Auth::user()->name }}"
                                    placeholder="Masukan Nama Pemohon" readonly>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-2 col-form-label">Kepada Fungsi</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="to_function"
                                    value="Maintenance Planning and Services (MPS)" readonly>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-2 col-form-label">Dari Fungsi</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="from_function"
                                    value="{{ Auth::user()->division->name }}" readonly>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-2 col-form-label">Judul Temuan</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="title" value="{{ old('title') }}"
                                    placeholder="Masukan Judul Temuan">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-2 col-form-label">Lokasi Temuan</label>
                            <div class="col-sm-10">

                                <select class="single-select" id="location" name="location_id">
                                    <option value="">Pilih Lokasi Temuan</option>
                                    @foreach ($locations as $location)
                                    <option value="{{ $location->id }}">{{ $location->name }}</option>
                                    @endforeach
                                    <option value="0">Lainnya</option>
                                </select>

                                <input type="text" class="form-control mt-3" name="location_other"
                                    value="{{ old('location_other') }}" id="location_other"
                                    placeholder="Masukan Lokasi Temuan Lainnya" hidden>
                            </div>
                        </div>
                        <div class="mb-12 row">
                            <label class="col-sm-10 col-form-label">Sumber Ketidaksesuaian atau potensinya</label>
                            <div class="col-sm-10">
                                <div class="row">
                                    @foreach($potentialSources as $potentialSource)
                                    <div class="col-auto">
                                        <div class="">
                                            <input class="form-check-input" type="checkbox" name="potential_source[]"
                                                id="{{ str_replace(' ', '_', strtolower($potentialSource)) }}"
                                                value="{{ $potentialSource }}">
                                            <label for="{{ str_replace(' ', '_', strtolower($potentialSource)) }}"
                                                class="form-check-label">
                                                {{ $potentialSource }}
                                            </label>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="mb-12 row">
                            <label class="col-sm-10 col-form-label mt-3">Ketidaksesuaian atau potensi yang
                                ditemukan:</label>
                            <div class="col-sm-12">

                                <div class="mb-3">
                                    <div class="custom-ekeditor">
                                        <textarea rows="4" id="ckeditor" name="discovered_potential"></textarea>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-2 col-form-label">Foto</label>
                            <div class="col-sm-10">
                                <input type="file" class="form-control" name="photos[]">
                            </div>
                        </div>
                        <div id="element-add-photo"></div>
                        <button type="button" class="btn btn-primary btn-add-photo" onclick="addPhoto()">
                            <i class="fa fa-plus"></i> Tambah Foto
                        </button>
                        <div class="row my-4">
                            <label class="col-sm-10 col-form-label">Kategori
                                <label><input type="radio" value="Urgent" class="form-check-input check-space"
                                        name="category"> Urgent</label>
                                <label><input type="radio" class="form-check-input check-space" value="Tidak Urgent"
                                        name="category"> Tidak
                                    Urgent</label>
                            </label>
                        </div>
                        <div class="mb-3 row">
                            <div class="col-sm-10">
                                <button type="submit" id="btn-submit" class="btn btn-primary">
                                    <i class="fa fa-database"></i> Simpan Perubahan
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
<script>
    @if(session('error'))
    swal("Yeyy Berhasil", "{{ session('error') }}", "error")
    @endif

    $("#location").change(function() {
        let val = $("#location").val();
        console.log(val)
        if(val == 0) {
            $("#location_other").prop('hidden', false);
        } else {
            $("#location_other").prop('hidden', true);
        }
    })
    function storeChecklist()
    {
        const data = new FormData(document.getElementById('formPermohonanPtpp'));

        $.ajax({
            url: "{{ route('permohonan-ptpp.store') }}",
            data: data,
            type: 'POST',
            contentType: 'multipart/form-data',
            cache: true,
            contentType: false,
            processData: true,
            beforeSend: function(f) {
                $("#btn-submit").prop('disabled', true)
                $("#btn-submit").html('<i class="fa fa-spinner fa-spin"></i> Menunggu mengirim data...')
            },
            success: function (data) {
                console.log(data);
                swal("Berhasil", data.message, "success").then(() => {
                    window.location.href = "{{ route('permohonan-ptpp.index') }}";
                });
            },
            error: function (data) {
                console.log(data.message);
                swal("Gagal", 'Gagal mengirim data', "error");
                $("#btn-submit").prop('disabled', false)
                $("#btn-submit").html('<i class="fa fa-database"></i> Kirim')
            }
        });
        event.preventDefault();
    }

    let indexPhoto = 0;
    function addPhoto() {
        $("#element-add-photo").append(`
            <div class="mb-3 row" id="add-photo${indexPhoto}">
                <label class="col-sm-2 col-form-label">Foto</label>
                <div class="col-sm-10">
                    <div class="row">
                        <div class="col-lg-9">
                            <input type="file" class="form-control" name="photos[]">
                        </div>
                        <div class="col-lg-3">
                            <button type="button" class="btn btn-danger btn-block" onclick="deletePhoto(${indexPhoto})">
                                <i class="fa fa-trash"></i> Hapus
                        </div>
                    </div>
                </div>
            
            </div>
        `)
        indexPhoto++
    }
        
    function deletePhoto(id) {
        $(`#add-photo${id}`).remove();
    }
</script>
@endpush