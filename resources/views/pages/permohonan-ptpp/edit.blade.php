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

    .profile-circle {
        width: 80px;
        height: 80px;
        background-color: gray;
        color: black;
        border-radius: 50%;
    }
</style>
@endpush

@section('content')
<form action="{{ route('permohonan-ptpp.update', $item->id) }}" method="POST" enctype="multipart/form-data"
    id="formPermohonanPtpp">
    @csrf
    @method('put')
    <!-- row -->
    <div class="container-fluid">
        <div class="row page-titles">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active"><a href="{{ url('/') }}">Form permohonan PTPP</a></li>
                <li class="breadcrumb-item"><a href="javascript:void(0)">Form PTPP</a></li>
            </ol>
        </div>

        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Progress</h4>
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
                <div class="card-body">

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
                                    {{ $item->status == 'PENDING' ? 'PENDING' : 'IN PROGRESS' }}
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
                    <h4 class="card-title">Form Permohonan PTPP</h4>
                </div>


                <div class="card-body">
                    <div class="basic-form">

                        <div class="mb-3 row">
                            <label class="col-sm-2 col-form-label">No. PTPP</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="number"
                                    value="{{ old('number') ? old('number') : $item->number }}" placeholder="No. PTPP"
                                    {{ $disabledFormPermohonan }} />
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-2 col-form-label">Tanggal</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="date"
                                    value="{{ old('date') ? old('date') : $item->date }}" placeholder="Tanggal"
                                    id="mdate" {{ $disabledFormPermohonan }} />
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-2 col-form-label">Nama Pemohon</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="name"
                                    value="{{ old('name') ? old('name') : $item->name }}"
                                    placeholder="Masukan Nama Pemohon" {{ $disabledFormPermohonan }} />
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-2 col-form-label">Kepada Fungsi</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="to_function"
                                    value="Maintenance Planning and Services (MPS)" readonly {{ $disabledFormPermohonan
                                    }} />
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-2 col-form-label">Dari Fungsi</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="from_function"
                                    value="{{ $item->from_function }}" readonly {{ $disabledFormPermohonan }} />
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-2 col-form-label">Judul Temuan</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="title"
                                    value="{{ old('title') ? old('title') : $item->title }}"
                                    placeholder="Masukan Judul Temuan" {{ $disabledFormPermohonan }} />
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-2 col-form-label">Lokasi Temuan</label>
                            <div class="col-sm-10">

                                <select class="single-select" id="location" name="location_id">
                                    <option value="">Pilih Lokasi Temuan</option>
                                    @foreach ($locations as $location)
                                    <option value="{{ $location->id }}" {{ $item->location_id == $location->id ?
                                        'selected' : '' }} >{{ $location->name }}</option>
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
                                                value="{{ $potentialSource }}" {{ in_array($potentialSource,
                                                array_map('trim', explode(',', $item->potential_source))) ?
                                            'checked' :
                                            '' }} {{ $disabledFormPermohonan }} />
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
                                <div class="custom-ekeditor">
                                    <textarea rows="4" id="ckeditor" name="discovered_potential" {{
                                        $disabledFormPermohonan
                                        }}>{{ old('discovered_potential') ? old('discovered_potential') : $item->discovered_potential }}</textarea>
                                </div>
                            </div>
                        </div>

                        {{-- <div class="mb-3 row mt-5">
                            @foreach ($ptppPhotoBefore as $photo)
                            <div class="col-lg-4 text-center" id="photoDatabase{{ $photo->id }}">
                                <input type="hidden" name="photo_database[]" value="{{ $photo->photo }}">
                                <div
                                    style="width: auto;height: 600px;background-image: url({{ asset('storage/'.$photo->photo) }});background-size: cover;text-align: center;">
                                </div>
                                <br />
                                @if(Auth::user()->role == 'pengusul')
                                <button type="button" class="btn btn-danger text-center mt-3 mb-5"
                                    onclick="deletePhotoDatabase({{ $photo->id }})" {{ $disabledFormPermohonan }}>
                                    <i class="fa fa-trash"></i> Hapus
                                </button>
                                @endif
                            </div>
                            @endforeach
                        </div> --}}

                        <div class="row mt-5 mb-3" id="photoDatabase">
                            @foreach ($ptppPhotoBefore as $photo)
                            <div class="col-lg-3 col-md-4 col-6 mb-4 text-center" id="photoDatabase{{ $photo->id }}">
                                <input type="hidden" name="photo_database[]" value="{{ $photo->photo }}">
                                <div class="position-relative">
                                    <a href="{{ asset('storage/'.$photo->photo) }}" data-lg-size="1400-800">
                                        <img src="{{ asset('storage/'.$photo->photo) }}" class="img-fluid img-thumbnail"
                                            style="height: 150px; object-fit: cover;" />
                                    </a>

                                    @if(Auth::user()->role == 'pengusul')
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



                        @if(Auth::user()->role == 'pengusul')
                        <div class="mb-3 row mt-5">
                            <label class="col-sm-2 col-form-label">Foto</label>
                            <div class="col-sm-10">
                                <input type="file" class="form-control" name="photos[]" {{ $disabledFormPermohonan }}>
                            </div>
                        </div>
                        <div id="element-add-photo"></div>
                        <button type="button" class="btn btn-primary btn-add-photo" onclick="addPhoto()" {{
                            $disabledFormPermohonan }}>
                            <i class="fa fa-plus"></i> Tambah Foto
                        </button>
                        @endif

                        <div class="mt-3 row mb-4">
                            <label class="col-sm-2 col-form-label">Kategori</label>
                            <div class="col-sm-10">
                                <div class="row">
                                    <div class="col-auto">
                                        <input type="radio" value="Urgent" class="form-check-input check-space"
                                            name="category" id="urgent" {{ $item->category == 'Urgent' ? 'checked'
                                        : '' }} {{ $disabledFormPermohonan }} /> <label for="urgent">Urgent</label>
                                    </div>
                                    <div class="col-auto">
                                        <input type="radio" class="form-check-input check-space" value="Tidak Urgent"
                                            name="category" id="tidak_urgent" {{ $item->category == 'Tidak Urgent' ?
                                        'checked' : '' }} {{ $disabledFormPermohonan }} />
                                        <label for="tidak_urgent">
                                            Tidak
                                            Urgent </label>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="mb-3 row">
                            <div class="col-sm-auto">
                                <button type="submit" class="btn btn-primary btn-submit" {{ $disabledFormPermohonan }}>
                                    <i class="fa fa-database"></i> Simpan Perubahan
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

                    </div>
                </div>
            </div>
        </div>
        {{-- end conten --}}
    </div>
    @if ($countApproval >= 2)
    <div class="container-fluid">

        {{-- content --}}
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Form Tindak Lanjut</h4>
                </div>
                <div class="card-body">
                    <div class="basic-form">

                        <div class="mb-3 row">
                            <label class="col-sm-2 col-form-label">Status</label>
                            <div class="col-sm-10">
                                <div class="row">
                                    <div class="col-auto">
                                        <input type="radio" class="form-check-input check-position" value="IN PROGRESS"
                                            id="in_progress" name="status" {{ $item->status ==
                                        'IN PROGRESS' ? 'checked'
                                        : '' }} {{
                                        $disabledFormTindakLanjut }} />
                                        <label for="in_progress">IN
                                            PROGRESS</label>
                                    </div>
                                    <div class="col-auto">
                                        <input type="radio" id="pending" class="form-check-input check-position"
                                            name="status" value="PENDING" {{ $item->status == 'PENDING' ? 'checked'
                                        : ''
                                        }} {{
                                        $disabledFormTindakLanjut }}>
                                        <label for="pending">PENDING</label>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-2 col-form-label">Tanggal Terima</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control date-picker-custom" name="date_reveived"
                                    placeholder="Tanggal Terima"
                                    value="{{ old('date_reveived') ? old('date_reveived') : $item->date_reveived }}" {{
                                    $disabledFormTindakLanjut }}>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-2 col-form-label">Penanggung Jawab</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="person_responsible"
                                    placeholder="Masukan Penanggung Jawab" value="{{ old('person_responsible') ?
                                old('person_responsible') : $item->person_responsible }}" {{ $disabledFormTindakLanjut
                                    }}>
                            </div>
                        </div>
                        <div class=" mb-12 row">
                            <label class="col-sm-10 col-form-label">Perbaikan / Tindakan Sementara (Jika
                                ada)</label>
                            <div class="col-sm-12">
                                <div class="mb-3">
                                    <div class="custom-ekeditor">
                                        <textarea class="form-control" rows="4" id="temporary_measure"
                                            name="temporary_measure" {{ $disabledFormTindakLanjut }}>{{ old('temporary_measure') ?
                                        old('temporary_measure') : $item->temporary_measure }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mb-12 row">
                            <label class="col-sm-10 col-form-label">Analisa Penyebab</label>
                            <div class="col-sm-12">
                                <div class="mb-3">
                                    <div class="custom-ekeditor">
                                        <textarea rows="4" id="causal_analysis" name="causal_analysis" {{
                                            $disabledFormTindakLanjut
                                            }}>{{ old('causal_analysis') ? old('causal_analysis') : $item->causal_analysis }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mb-12 row">
                            <label class="col-sm-10 col-form-label">Tindakan Pencegahan</label>
                            <div class="col-sm-12">
                                <div class="custom-ekeditor">
                                    <textarea rows="4" id="preventive_measure" name="preventive_measure" {{
                                        $disabledFormTindakLanjut
                                        }}>{{ old('preventive_measure') ? old('preventive_measure') : $item->preventive_measure }}</textarea>
                                </div>

                            </div>
                        </div>
                        <div class="mb-3 row mt-3">
                            <div class="col-sm-12">
                                <label class="col-sm-2">PIC</label>
                                <input type="text" class="form-control" name="pic"
                                    value="{{ old('pic') ? old('pic') : $item->pic }}" placeholder="Masukan nama PIC" {{
                                    $disabledFormTindakLanjut }} />
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-2">Waktu Pelaksanaan</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control date-picker-custom" name="execution_date"
                                    placeholder="Pilih Tanggal"
                                    value="{{ old('execution_date') ? old('execution_date') : $item->execution_date }}"
                                    {{ $disabledFormTindakLanjut }} />
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label class="col-sm-10 col-form-label">Dokumen yang direvisi (Jika ada)</label>
                            <div class="col-sm-10">
                                <div class="row">
                                    @foreach($documents as $documents)
                                    <div class="col-auto">
                                        <div class="">
                                            <input class="form-check-input" type="checkbox" name="documents[]"
                                                id="{{ str_replace(' ', '_', strtolower($documents)) }}"
                                                value="{{ $documents }}" {{ in_array($documents, array_map('trim',
                                                explode(',', $item->documents))) ? 'checked' :
                                            '' }} {{
                                            $disabledFormTindakLanjut }} />
                                            <label for="{{ str_replace(' ', '_', strtolower($documents)) }}"
                                                class="form-check-label">
                                                {{ $documents }}
                                            </label>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                <input type="text" class="form-control mt-2" name="document_others"
                                    placeholder="Masukan Dokumen Lainnya"
                                    value="{{ old('document_others') ? old('document_others') : $item->document_others }}"
                                    {{ $disabledFormTindakLanjut }} />
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Target Waktu Verifikasi</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control date-picker-custom" name="target_verification"
                                    placeholder="Masukan Tanggal Verifikasi"
                                    value="{{ old('target_verification') ? old('target_verification') : $item->target_verification }}"
                                    {{ $disabledFormTindakLanjut }} />
                            </div>
                        </div>

                        @if ($disabledFormTindakLanjut !== 'disabled')
                        <div class="mb-3 row">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary btn-submit">
                                    <i class="fa fa-database"></i> Simpan Perubahan
                                </button>
                            </div>
                        </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
        {{-- end conten --}}
    </div>
    <div class="container-fluid">

        {{-- content --}}
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Form Verifikasi Pelaksanaan Tindakan Perbaikan Dan Pencegahan</h4>
                </div>
                <div class="card-body">
                    <div class="basic-form">

                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Status</label>
                            <div class="col-sm-9">
                                <input type="radio" class="form-check-input check-position" name="status" {{
                                    $item->status == 'COMPLETED' ? 'checked' :
                                '' }} value="COMPLETED" id="completed"
                                {{ $disabledFormTindakLanjut }}
                                />
                                <label for="completed">
                                    COMPLETED</label>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Tanggal Penyelesaian</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control date-picker-custom" name="completion_date"
                                    placeholder="Masukan Tanggal Penyelesaian" value="{{
                                    old('completion_date') ? old('completion_date') : $item->completion_date }}" {{
                                    $disabledFormTindakLanjut }} />
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-2">Catatan</label>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-7">Jika Tindakan Perbaikan/Pencegahan belum memenuhi maka terbitkan
                                PTPP baru</label>
                        </div>
                        <div class="mb-12 row">
                            <div class="col-sm-2 mt-3">
                                <input type="radio" class="form-check-input check-position" value="Efektif"
                                    name="category_note" id="efektif" {{ $item->category_note == 'Efektif' ?
                                'checked' :
                                '' }} {{ $disabledFormTindakLanjut }} />
                                <label for="efektif">Efektif</label>
                                <br />
                                <input type="radio" class="form-check-input check-position" value="Belum Efektif"
                                    name="category_note" {{ $item->category_note == 'Belum Efektif' ? 'checked' : ''
                                }}
                                id="belum_efektif" {{ $disabledFormTindakLanjut }} />
                                <label for="belum_efektif">Belum
                                    Efektif</label>
                            </div>
                            <div class="col-sm-9">
                                <label class="col-sm-10 col-form-label">Catatan Rekomendasi Lanjutan</label>
                                <div class="col-sm-12">

                                    <div class="mb-3">
                                        <textarea class="form-control" rows="4" id="comment"
                                            placeholder="Masukan Perbaikan / Tindakan Sementara (Jika ada)"
                                            name="recomendation_note" {{ $disabledFormTindakLanjut
                                            }}>{{ $item->recomendation_note }}</textarea>
                                    </div>

                                </div>
                            </div>
                        </div>
                        {{-- <div class="mb-3 row mt-5">
                            @foreach ($ptppPhotoAfter as $photo)
                            <div class="col-lg-4 text-center" id="photoVerificationDatabase{{ $photo->id }}">
                                <input type="hidden" name="photo_verification_database[]" value="{{ $photo->photo }}">
                                <div
                                    style="width: auto;height: 600px;background-image: url({{ asset('storage/'.$photo->photo) }});background-size: cover;text-align: center;">
                                </div>


                                <br />

                                <button type="button" class="btn btn-danger text-center mt-3 mb-5"
                                    onclick="deleteVerificationPhotoDatabase({{ $photo->id }})" {{
                                    $disabledFormPermohonan }}>
                                    <i class="fa fa-trash"></i> Hapus
                                </button>

                            </div>
                            @endforeach
                        </div> --}}
                        {{-- di ubah dengan light Gallery --}}
                        <div class="row mt-5 mb-3" id="photoVerificationLightgallery">
                            @foreach ($ptppPhotoAfter as $photo)
                            <div class="col-lg-3 col-md-4 col-6 mb-4 text-center"
                                id="photoVerificationDatabase{{ $photo->id }}">
                                <input type="hidden" name="photo_verification_database[]" value="{{ $photo->photo }}">
                                <div class="position-relative">
                                    <a href="{{ asset('storage/'.$photo->photo) }}" data-lg-size="1400-800">
                                        <img src="{{ asset('storage/'.$photo->photo) }}" class="img-fluid img-thumbnail"
                                            style="height: 150px; object-fit: cover;" />
                                    </a>

                                    @if(Auth::user()->role == 'teknik')
                                    <button type="button" class="btn btn-danger btn-sm mt-2"
                                        style="position: absolute; top: 150px; right: 50px;"
                                        onclick="deleteVerificationPhotoDatabase({{ $photo->id }})">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                    @endif
                                </div>

                            </div>
                            @endforeach
                        </div>


                        <div class="mb-3 row mt-5">
                            <label class="col-sm-2 col-form-label">Foto Verifikasi</label>
                            <div class="col-sm-10">
                                <input type="file" class="form-control" name="verification_photos[]" {{
                                    $disabledFormPermohonan }}>
                            </div>
                        </div>

                        <div id="element-add-verification-photo"></div>

                        <button type="button" class="btn btn-primary mb-5 btn-add-verification-photo"
                            onclick="addVerificationPhoto()" {{ $disabledFormPermohonan }}>
                            <i class="fa fa-plus"></i> Tambah Foto Verifikasi
                        </button>

                        @if ($disabledFormTindakLanjut !== 'disabled')
                        <div class="mb-3 row">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary btn-submit">
                                    <i class="fa fa-database"></i> Simpan Perubahan
                                </button>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        {{-- end conten --}}
    </div>
    @endif
</form>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/lightgallery@2.7.2/lightgallery.umd.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        lightGallery(document.getElementById('photoVerificationLightgallery'), {
            selector: 'a',
            download: true,
            thumbnail: true
        });
         lightGallery(document.getElementById('photoDatabase'), {
        selector: 'a',
        download: true,
        thumbnail: true
    });
    });
</script>
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

    ClassicEditor
    .create( document.querySelector( '#temporary_measure' ), {
    // toolbar: [ 'heading', '|', 'bold', 'italic', 'link' ]
    } )
    .then( editor => {
    window.editor = editor;
    } )
    .catch( err => {
    console.error( err.stack );
    } );
    
    ClassicEditor
    .create( document.querySelector( '#causal_analysis' ), {
        // toolbar: [ 'heading', '|', 'bold', 'italic', 'link' ]
    } )
    .then( editor => {
        window.editor = editor;
    } )
    .catch( err => {
        console.error( err.stack );
    } );

    ClassicEditor
    .create( document.querySelector( '#preventive_measure' ), {
        // toolbar: [ 'heading', '|', 'bold', 'italic', 'link' ]
    } )
    .then( editor => {
        window.editor = editor;
    } )
    .catch( err => {
        console.error( err.stack );
    } );

    function storeChecklist()
    {
        const data = new FormData(document.getElementById('formPermohonanPtpp'));

        $.ajax({
            url: "{{ route('permohonan-ptpp.update', $item->id) }}",
            data: data,
            type: 'POST',
            contentType: 'multipart/form-data',
            cache: false,
            contentType: false,
            processData: false,
            beforeSend: function(f) {
                $(".btn-submit").prop('disabled', true)
                $(".btn-submit").html('<i class="fa fa-spinner fa-spin"></i> Menunggu mengirim data...')
            },
            success: function (data) {
                if(data.success == true) {
                    swal("Berhasil", data.message, "success").then(() => {
                    window.location.href = "{{ route('permohonan-ptpp.index') }}";
                    });
                } else {
                    swal("Gagal", data.message, "error");
                    $(".btn-submit").prop('disabled', false)
                    $(".btn-submit").html('<i class="fa fa-database"></i> Simpan Data Perubahan')
                }
                
            },
            error: function (data) {
                swal("Gagal", 'Gagal mengirim data', "error");
                $(".btn-submit").prop('disabled', false)
                $(".btn-submit").html('<i class="fa fa-database"></i> Simpan Data Perubahan')
            }
        });
        
        event.preventDefault();
    }

    function approvePermohonan() {
        $.ajax({
            url: "{{ url('/approve-permohonan/' . $item->id . '/edit') }}",
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
                    window.location.href = "{{ route('permohonan-ptpp.index') }}";
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
            url: "{{ url('/cancel-permohonan/' . $item->id ) }}",
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
                    window.location.href = "{{ route('permohonan-ptpp.edit', $item->id) }}";
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
    

    let indexVerificationPhoto = 0;
    function addVerificationPhoto() {
        $("#element-add-verification-photo").append(`
            <div class="mb-3 row" id="add-verification-photo${indexVerificationPhoto}">
                <label class="col-sm-2 col-form-label">Foto Verifikasi</label>
                <div class="col-sm-10">
                    <div class="row">
                        <div class="col-lg-9">
                            <input type="file" class="form-control" name="verification_photos[]">
                        </div>
                        <div class="col-lg-3">
                            <button type="button" class="btn btn-danger btn-block" onclick="deleteVerificationPhoto(${indexVerificationPhoto})">
                                <i class="fa fa-trash"></i> Hapus
                        </div>
                    </div>
                </div>
            
            </div>
        `)
        indexVerificationPhoto++
    }

    function deleteVerificationPhoto(id) {
        $(`#add-verification-photo${id}`).remove();
    }

    function deleteVerificationPhotoDatabase(id) {
        $(`#photoVerificationDatabase${id}`).remove();
    }




    $(document).ready(function(){
		$('#smartwizard').smartWizard();
	});
</script>
@endpush