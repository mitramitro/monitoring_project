@extends('layouts.default')

@section('content')
<div class="container-fluid">

    <div class="row page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('daily-work.index') }}">Daily Work</a></li>
            <li class="breadcrumb-item">
                <a href="{{ route('daily-work-item.index', ['dailyWork' => $dailyWork->id]) }}">Daily Work Items</a>
            </li>
            <li class="breadcrumb-item active">Edit Item</li>
        </ol>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h4>Edit Daily Work Item</h4>
                </div>

                <div class="card-body">

                    <form action="{{ route('daily-work-item.update', ['dailyWork' => $dailyWork->id, 'dailyWorkItem' => $dailyWorkItem->id]) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <input type="hidden" name="daily_work_id" value="{{ $dailyWork->id }}">

                        {{-- Contract Select --}}
                        <div class="mb-3">
                            <label for="contract_id" class="form-label">Contract <small class="text-muted">(required)</small></label>
                            <select name="contract_id" id="contract_id" class="form-select select2" required>
                                <option value="">-- Pilih Contract --</option>
                                @foreach($contracts as $c)
                                    <option 
                                        value="{{ $c->id }}" 
                                        data-company="{{ $c->company->name ?? '' }}"
                                        {{ $c->id == $dailyWorkItem->contract_id ? 'selected' : '' }}>
                                        {{ $c->contract_number }} — {{ $c->job_title ?? '-' }} — {{ $c->budget ?? '-' }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Company Name --}}
                        <div class="mb-3">
                            <label class="form-label">Company Name</label>
                            <input type="text" id="company_name" class="form-control" disabled>
                        </div>

                        <hr>

                        {{-- Is Absen --}}
                        <div class="mb-3 form-check">
                            {{-- <input type="hidden" name="is_absen" value="0"> --}}
                            <input type="checkbox" name="is_absen" id="is_absen" class="form-check-input"
                                value="1" {{ $dailyWorkItem->is_absen ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_absen">Tidak masuk / absen hari ini</label>
                        </div>

                        {{-- Absen reason --}}
                        <div class="mb-3" id="div_absen_reason" 
                            style="display: {{ $dailyWorkItem->is_absen ? 'block' : 'none' }};">
                            <label for="absen_reason" class="form-label">Alasan Tidak Masuk</label>
                            <input type="text" name="absen_reason" id="absen_reason" class="form-control"
                                value="{{ $dailyWorkItem->absen_reason }}">
                        </div>

                        {{-- Time In / Out --}}
                        <div id="time_section" style="display: {{ $dailyWorkItem->is_absen ? 'none':'block' }};">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="time_in" class="form-label">Time In</label>
                                    <input type="time" name="time_in" id="time_in" class="form-control"
                                        value="{{ $dailyWorkItem->time_in }}">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="time_out" class="form-label">Time Out</label>
                                    <input type="time" name="time_out" id="time_out" class="form-control"
                                        value="{{ $dailyWorkItem->time_out }}">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="overtime_until_plan" class="form-label">Rencana Lembur Sampai</label>
                                <input type="time" name="overtime_until_plan" id="overtime_until_plan"
                                    class="form-control" value="{{ $dailyWorkItem->overtime_until_plan }}">
                            </div>
                        </div>

                        {{-- Total Workers --}}
                        <div class="mb-3">
                            <label class="form-label">Total Workers</label>
                            <input type="number" name="total_workers" class="form-control"
                                value="{{ $dailyWorkItem->total_workers }}">
                        </div>

                        <hr>

                        {{-- Daily Work Plans --}}
                        <h5>Rencana Kerja (Daily Work Plans)</h5>

                        <div id="plan-wrapper">
                            @foreach($dailyWorkItem->dailyWorkPlan as $i => $plan)
                                <div class="input-group mb-2 plan-item">
                                    <input type="text" name="plan_name[]" class="form-control"
                                        value="{{ $plan->plan_name }}">
                                    <button type="button" class="btn btn-danger btn-remove-plan">X</button>
                                </div>
                            @endforeach
                        </div>

                        <button type="button" class="btn btn-sm btn-success mb-3" id="btn-add-plan">
                            + Tambah Rencana Kerja
                        </button>

                        {{-- Note --}}
                        <div class="mb-3">
                            <label for="note" class="form-label">Catatan</label>
                            <textarea name="note" id="note" rows="3" class="form-control">{{ $dailyWorkItem->note }}</textarea>
                        </div>
                         <input type="hidden" id="approval" name="approval" class="form-control" value="wait">

                        <button type="submit" class="btn btn-primary">Update Item</button>
                        <a href="{{ route('daily-work-item.index', ['dailyWork' => $dailyWork->id]) }}" class="btn btn-secondary">Kembali</a>

                    </form>

                </div>
            </div>
        </div>
         {{-- Info panel --}}
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">Info</div>
                <div class="card-body">
                    <p><strong>Daily Work:</strong> {{ optional($dailyWork)->date ?? '-' }}</p>
                    {{-- <p><strong>Vendor:</strong> {{ optional($dailyWork->user)->username ?? '-' }}</p> --}}
                    <hr>
                    <p class="small text-muted">Jika ingin menambahkan beberapa rencana pekerjaan untuk hari yang sama, ulangi proses add item. Approval dilakukan oleh akun MPS.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {

    // --- Select2 ---
    $('#contract_id').select2();

    // Initial company name
    let selected = $('#contract_id').find(':selected').data('company');
    $('#company_name').val(selected ?? '');

    $('#contract_id').on('change', function() {
        let company = $(this).find(':selected').data('company');
        $('#company_name').val(company ?? '');
    });


    // --- Toggle Absen ---
    $('#is_absen').on('change', function() {
        if ($(this).is(':checked')) {
            $('#div_absen_reason').show();
            $('#time_section').hide();
        } else {
            $('#div_absen_reason').hide();
            $('#time_section').show();
        }
    });


    // --- Dynamic Plans ---
    $('#btn-add-plan').on('click', function() {
        $('#plan-wrapper').append(`
            <div class="input-group mb-2 plan-item">
                <input type="text" name="plan_name[]" class="form-control" placeholder="Rencana kerja">
                <button type="button" class="btn btn-danger btn-remove-plan">X</button>
            </div>
        `);
    });

    $(document).on('click', '.btn-remove-plan', function() {
        $(this).closest('.plan-item').remove();
    });

});
</script>
@endpush
