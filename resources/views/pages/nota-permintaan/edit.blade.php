@extends('layouts.default')

@push('styles')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/lightgallery@2.7.2/css/lightgallery-bundle.min.css">
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

    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Progress</h4>
        </div>
        <div class="card-body">
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
                <div id="smartwizard" class="form-wizard order-create">
                    <ul class="nav nav-wizard">
                        <li><a class="nav-link" href="#wizard_submited">
                                <span class="mb-2">
                                    <i class="fa fa-check"></i>
                                </span>
                                SUBMITED
                            </a></li>
                        <li><a class="nav-link" href="#wizard_approve">
                                <span class="mb-2">
                                    <i class="fa fa-check"></i>
                                </span>
                                APPROVE
                            </a></li>
                        <li><a class="nav-link" href="#wizard_in_progress">
                                <span class="mb-2">
                                    <i class="fa fa-check"></i>
                                </span>
                                IN PROGRESS
                            </a></li>
                        <li><a class="nav-link" href="#wizard_completed">
                                <span class="mb-2">
                                    <i class="fa fa-check"></i>
                                </span>
                                COMPLETED
                            </a></li>
                    </ul>
                    <div class="tab-content">
                    </div>
                </div>

                <div class="row">
                    <div class="col-auto">
                        <h5>Submited</h5>
                        <p>Submited By</p>

                        <div class="d-flex">
                            <div class="mr-2">
                                <div class="btn btn-primary rounded-circle mr-2 ml-5">
                                    {{ strtoupper(substr($item->user->name, 0, 1)) }}
                                </div>
                            </div>
                            <div style="margin-left: 10px">
                                <p>
                                    <b>{{ $item->user->name }}</b>
                                    <br />
                                    <span>{{ $item->user->division->name }}</span>
                                    <br />
                                    <span>{{ Carbon\Carbon::parse($item->created_at)->format('d F Y') }}</span>
                                </p>

                            </div>
                        </div>
                    </div>
                    <div class="col-auto">
                        <h5>Approval</h5>
                        <p>Currently Waiting for {{ 2 - $countApproval }} Approval</p>
                        <div class="row">
                            @foreach ($approvals as $approval)

                            <div class="col-auto">


                                <div class="d-flex">
                                    <div class="mr-2">
                                        <div class="btn btn-primary rounded-circle mr-2 ml-5">
                                            {{ strtoupper(substr($approval->user->name, 0, 1)) }}
                                        </div>
                                    </div>
                                    <div style="margin-left: 10px">
                                        <p>
                                            <b>{{ $approval->user->name }}</b>
                                            <br />
                                            <span>{{ $approval->user->position }}</span>
                                            <br />
                                            <span>{{ Carbon\Carbon::parse($approval->created_at)->format('d F Y')
                                                }}</span>
                                        </p>

                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    {{-- content --}}
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Form Nota Permintaan</h4>
            </div>
            <div class="card-body">
                <div class="basic-form">
                    <form action="{{ route('nota-permintaan.update', $item->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        @if ($item->status !== 'WAITING APPROVAL')
                        <div class="mb-3 row">
                            <label class="col-sm-2 col-form-label">Status</label>
                            <div class="col-sm-10">
                                <div class="row">
                                    <div class="col-auto">
                                        <input type="radio" class="form-check-input check-position" name="status" {{
                                            $item->status == 'IN PROGRESS' ?
                                        'checked' :
                                        '' }} value="IN PROGRESS" id="in_progress"
                                        {{ $disabledStatus }}
                                        />
                                        <label for="in_progress">
                                            IN PROGRESS</label>
                                    </div>
                                    <div class="col-auto">
                                        <input type="radio" class="form-check-input check-position" name="status" {{
                                            $item->status == 'CLOSE' ?
                                        'checked' :
                                        '' }} value="CLOSE" id="close"
                                        {{ $disabledStatus }}
                                        />
                                        <label for="close">
                                            CLOSE</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        <div class="mb-3 row">
                            <label class="col-sm-2 col-form-label">No</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="number"
                                    placeholder="Masukan Nomor Nota Permintaan" value="{{ $item->number }}" {{
                                    $disabledForm }}>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-2 col-form-label">Tanggal</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="date" value="{{ $item->date }}"
                                    placeholder="Tanggal" id="mdate" {{ $disabledForm }}>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-2 col-form-label">Kepada</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="to"
                                    value="Integrated Terminal Manager Balongan" readonly {{ $disabledForm }}>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-2 col-form-label">Dari</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="from" value="{{ $item->from }}" readonly
                                    {{ $disabledForm }}>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-2 col-form-label">Perihal</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="regarding" value="{{ $item->regarding }}"
                                    placeholder="Masukan perihal" {{ $disabledForm }}>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label class="col-sm-2 col-form-label">Isi Body Surat</label>
                            <div class="col-sm-10">
                                <div class="custom-ckeditor">
                                    <textarea rows="4" id="ckeditor" name="body" {{ $disabledForm
                                        }}>{{ $item->body }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-2 col-form-label">Lampiran</label>
                            <div class="col-sm-10">
                                <input type="hidden" name="attachment_old" value="{{ $item->attachment }}">
                                <input class="form-control" type="file" id="lampiran" name="attachment" {{ $disabledForm
                                    }}>
                                <a href="{{ asset('storage/'.$item->attachment) }}" target="_blank"
                                    class="btn btn-primary mt-3">Lihat
                                    Lampiran</a>
                                {{-- <a href="{{ Storage::url($item->attachment) }}" target="_blank"
                                    class="btn btn-primary mt-3">Lihat
                                    Lampiran</a> --}}
                            </div>
                        </div>

                        {{-- <div class="mb-3 row mt-5">
                            @foreach ($notePhoto as $photo)
                            <div class="col-lg-4 text-center" id="photoDatabase{{ $photo->id }}">
                                <input type="hidden" name="photo_database[]" value="{{ $photo->photo }}">
                                <div
                                    style="width: auto;height: 600px;background-image: url({{ asset('storage/'.$photo->photo) }});background-size: cover;text-align: center;">
                                </div>
                                <br />
                                @if(Auth::user()->role == 'teknik')
                                <button type="button" class="btn btn-danger text-center mt-3 mb-5"
                                    onclick="deletePhotoDatabase({{ $photo->id }})">
                                    <i class="fa fa-trash"></i> Hapus
                                </button>
                                @endif
                            </div>
                            @endforeach
                        </div> --}}

                        {{-- di ubah dengan light Gallery --}}

                        <div class="row mt-5 mb-3" id="photoDatabase">
                            <label class="col-sm-2 col-form-label">Foto</label>
                            @foreach ($notePhoto as $photo)
                            <div class="col-lg-3 col-md-4 col-6 mb-4 text-center" id="photoDatabase{{ $photo->id }}">
                                <input type="hidden" name="photo_database[]" value="{{ $photo->photo }}">
                                <div class="position-relative">
                                    <a href="{{ asset('storage/'.$photo->photo) }}" data-lg-size="1400-800">
                                        <img src="{{ asset('storage/'.$photo->photo) }}" class="img-fluid img-thumbnail"
                                            style="height: 150px; object-fit: cover;" />
                                    </a>

                                    @if(Auth::user()->role == 'teknik')
                                    <button type="button" class="btn btn-danger btn-sm mt-2"
                                        style="position: absolute; top: 150px; right: 50px;"
                                        onclick="deletePhotoDatabase({{ $photo->id }})">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                    @endif
                                </div>

                            </div>
                            @endforeach
                        </div>



                        @if(Auth::user()->role == 'teknik')
                        <div class="mb-3 row mt-5">
                            <label class="col-sm-2 col-form-label">Foto</label>
                            <div class="col-sm-10">
                                <input type="file" class="form-control" name="photos[]">
                            </div>
                        </div>
                        <div id="element-add-photo"></div>
                        <button type="button" class="btn btn-primary btn-add-photo" onclick="addPhoto()">
                            <i class="fa fa-plus"></i> Tambah Foto
                        </button>
                        @endif

                        <div class="mb-3 row mt-5">
                            <div class="col-sm-auto">
                                <button class="btn btn-primary" id="button_action" {{ $disabledForm }}>
                                    Simpan Perubahan
                                </button>
                            </div>
                            @if(Auth::user()->role == 'teknik' || Auth::user()->role == 'manager')
                            <div class="col-sm-auto">
                                <button type="button" onclick="approvePermohonan()" id="btn-approve-permohonan"
                                    class="btn btn-warning" {{ $statusAprovePermohonan }}>
                                    <i class="fa fa-database"></i>
                                    {{ $statusAprovePermohonan == 'disabled' ? 'Sudah di approve' : 'Approve' }}
                                </button>
                            </div>

                            @if($statusAprovePermohonan == 'disabled')
                            <div class="col-sm-auto">
                                <button type="button" onclick="cancelPermohonan()" id="btn-cancel-permohonan"
                                    class="btn btn-danger">
                                    <i class="fa fa-database"></i>
                                    Batalkan Approve
                                </button>
                            </div>
                            @endif
                            @endif
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
<script src="https://cdn.jsdelivr.net/npm/lightgallery@2.7.2/lightgallery.umd.min.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
         lightGallery(document.getElementById('photoDatabase'), {
        selector: 'a',
        download: true,
        thumbnail: true
    });
    });
</script>
<script>
    function approvePermohonan() {
        $.ajax({
            url: "{{ url('/approve-nota/' . $item->id . '/edit') }}",
            type: 'GET',
            cache: false,
            contentType: false,
            processData: false,
            beforeSend: function(f) {
                $("#btn-approve-permohonan").prop('disabled', true)
                $("#btn-approve-permohonan").html('<i class="fa fa-spinner fa-spin"></i> Menunggu mengirim data...')
            },
            success: function (data) {
                swal("Berhasil", data.message, "success").then(() => {
                    window.location.href = "{{ route('nota-permintaan.index') }}";
                });
            },
            error: function (data) {
                console.log(data.message);
                swal("Gagal", 'Gagal mengirim data', "error");
                $("#btn-approve-permohonan").prop('disabled', false)
                $("#btn-approve-permohonan").html('<i class="fa fa-database"></i> Approve')
            }
        });
    }

    function cancelPermohonan() {
        $.ajax({
            url: "{{ url('/cancel-nota/' . $item->id ) }}",
            type: 'GET',
            cache: false,
            contentType: false,
            processData: false,
            beforeSend: function(f) {
                $("#btn-cancel-permohonan").prop('disabled', true)
                $("#btn-cancel-permohonan").html('<i class="fa fa-spinner fa-spin"></i> Menunggu mengirim data...')
            },
            success: function (data) {
                swal("Berhasil", data.message, "success").then(() => {
                    window.location.href = "{{ route('nota-permintaan.edit', $item->id) }}";
                });
            },
            error: function (data) {
                console.log(data.message);
                swal("Gagal", 'Gagal mengirim data', "error");
                $("#btn-cancel-permohonan").prop('disabled', false)
                $("#btn-cancel-permohonan").html('<i class="fa fa-database"></i> Batalkan Approval')
            }
        });
    }

    $(document).ready(function(){
		$('#smartwizard').smartWizard();
	});
    
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

    function deletePhotoDatabase(id) {
        $(`#photoDatabase${id}`).remove();
    }

</script>
@endpush