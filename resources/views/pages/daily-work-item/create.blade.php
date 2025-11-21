@extends('layouts.default')

@section('content')
<div class="container-fluid">
    <div class="row page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('daily-work.index') }}">Daily Work</a></li>
            <li class="breadcrumb-item"><a href="{{ route('daily-work-item.index', ['dailyWork' => $dailyWork->id]) }}">Daily Work Items</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Add Item</a></li>
        </ol>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title mb-0">Add Daily Work Item — {{ optional($dailyWork)->date ?? '-' }}</h4>
                    <a href="{{ url()->previous() }}" class="btn btn-secondary btn-sm">Back</a>
                </div>

                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $err)
                                    <li>{{ $err }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('daily-work-item.store',['dailyWork'=>$dailyWork->id]) }}" method="POST">
                        @csrf

                        {{-- Hidden: daily_work_id --}}
                        <input type="hidden" name="daily_work_id" value="{{ $dailyWork->id ?? old('daily_work_id') }}">

                        {{-- Contract --}}
                        <div class="mb-3">
                            <label for="contract_id" class="form-label">Contract <small class="text-muted">(required)</small></label>
                            <select name="contract_id" id="contract_id" class="form-select select2" required>
                                <option value="">-- Pilih Contract --</option>
                                @foreach($contracts as $c)
                                    <option value="{{ $c->id }}" data-company="{{ $c->company->name ?? '-' }}"  data-status="{{ $c->status ?? '-' }}" {{ old('contract_id') == $c->id ? 'selected' : '' }}  >
                                        {{ $c->contract_number }} — {{ $c->job_title ?? '-' }} — {{ $c->budget ?? '-' }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="row">
                            {{-- Company Name --}}
                            <div class="col-md-6 mb-3">
                                <label for="company_name" class="form-label">Company Name</label>
                                <input type="text" id="company_name" class="form-control" disabled>
                            </div>

                            {{-- Status --}}
                            <div class="col-md-6 mb-3">
                                <label for="contract_status" class="form-label">Status</label>
                                <input type="text" id="contract_status" class="form-control" disabled>
                            </div>
                        </div>

                        {{-- Is Absen --}}
                        <div class="mb-3 form-check">
                            <input type="checkbox" name="is_absen" id="is_absen" class="form-check-input" value="1" {{ old('is_absen') ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_absen">Tidak masuk / absen hari ini</label>
                        </div>

                         {{-- Absen reason (toggle) --}}
                        <div class="mb-3" id="div_absen_reason" style="display: {{ old('is_absen') ? 'block' : 'none' }};">
                            <label for="absen_reason" class="form-label">Alasan Tidak Masuk</label>
                            <input type="text" name="absen_reason" id="absen_reason" class="form-control" placeholder="Tuliskan alasan" value="{{ old('absen_reason') }}">
                        </div>

                        {{-- Time In / Time Out --}}
                        <div id="div_attendance_fields" style="display: {{ old('is_absen') ? 'none' : 'block' }};">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="time_in" class="form-label">Time In</label>
                                <input type="time" name="time_in" id="time_in" class="form-control" value="{{ old('time_in') }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="time_out" class="form-label">Time Out</label>
                                <input type="time" name="time_out" id="time_out" class="form-control" value="{{ old('time_out') }}">
                            </div>
                        </div>

                        {{-- Overtime plan --}}
                        <div class="mb-3">
                            <label for="overtime_until_plan" class="form-label">Rencana Lembur Sampai (jam)</label>
                            <input type="time" name="overtime_until_plan" id="overtime_until_plan" class="form-control" value="{{ old('overtime_until_plan') }}">
                        </div>
                        </div>

                        
                        {{-- Daily work plan / note --}}
                        {{-- <div class="mb-3">
                            <label for="daily_work_plan" class="form-label">Rencana Kerja / Deskripsi Pekerjaan</label>
                            <textarea name="daily_work_plan" id="daily_work_plan" rows="3" class="form-control" placeholder="Tuliskan rencana kerja hari ini...">{{ old('daily_work_plan') }}</textarea>
                            <small class="text-muted">Bisa tulis beberapa rencana—jika perlu multiple plan buat item terpisah.</small>
                        </div> --}}
                        {{-- Daily Work Plans --}}
                        <div class="mb-3">
                            <label class="form-label">Rencana Kerja Hari Ini</label>

                            <div id="plan-wrapper">

                                @if(old('plan_name'))
                                    @foreach(old('plan_name') as $plan)
                                        <div class="input-group mb-2 plan-row">
                                            <input type="text" name="plan_name[]" class="form-control" 
                                                placeholder="Contoh: Maintenance server, Setup user baru..."
                                                value="{{ $plan }}">
                                            <button type="button" class="btn btn-danger remove-plan">-</button>
                                        </div>
                                    @endforeach
                                @else
                                    {{-- default satu input --}}
                                    <div class="input-group mb-2 plan-row">
                                        <input type="text" name="plan_name[]" class="form-control" 
                                            placeholder="Contoh: Maintenance server, Setup user baru...">
                                        <button type="button" class="btn btn-danger remove-plan">-</button>
                                    </div>
                                @endif

                            </div>

                            <button type="button" class="btn btn-primary btn-sm mt-2" id="add-plan">+ Tambah Rencana</button>

                            <small class="text-muted d-block mt-1">
                                Tambahkan beberapa rencana bila pekerjaan hari ini lebih dari satu.
                            </small>
                        </div>

                        {{-- Note --}}
                        <div class="mb-3">
                            <label for="note" class="form-label">Catatan (opsional)</label>
                            <textarea name="note" id="note" rows="2" class="form-control">{{ old('note') }}</textarea>
                        </div>

                        {{-- Total workers --}}
                        <div class="mb-3">
                            <label for="total_workers" class="form-label">Jumlah Pekerja</label>
                            <input type="text" name="total_workers" id="total_workers" class="form-control" min="0" value="{{ old('total_workers', 1) }}">
                        </div>

                        {{-- approval default hidden --}}
                        <input type="hidden" name="approval" value="0">

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="{{ route('daily-work-item.index', ['dailyWork'=>$dailyWork->id]) }}" class="btn btn-light">Batal</a>
                        </div>
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
                    <p><strong>Vendor:</strong> {{ optional($dailyWork->user)->username ?? '-' }}</p>
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
$('#is_absen').on('change', function () {
    if ($(this).is(':checked')) {
        $('#div_absen_reason').show();
        $('#div_attendance_fields').hide();
    } else {
        $('#div_absen_reason').hide();
        $('#div_attendance_fields').show();
    }
});

    $(document).ready(function() {
        $('#contract_id').select2({
            width: '100%',
            placeholder: '-- Pilih Contract --'
        });

         // initial: kalau ada old value atau edit page
        let selectedOption = $('#contract_id').find(':selected');
        let initialCompany = selectedOption.data('company') || '';
        let initialStatus  = selectedOption.data('status') || '';
        $('#company_name').val(initialCompany);
        $('#contract_status').val(initialStatus);


        // update ketika dropdown berubah
        $('#contract_id').on('change', function() {
            let selected = $(this).find(':selected');
            let company = selected.data('company') || '';
            let status  = selected.data('status') || '';
            $('#company_name').val(company);
            $('#contract_status').val(status);
        });

            // add new plan
        $('#add-plan').click(function () {
                let row = `
                    <div class="input-group mb-2 plan-row">
                        <input type="text" name="plan_name[]" class="form-control"
                            placeholder="Contoh: Maintenance server, Setup user baru...">
                        <button type="button" class="btn btn-danger remove-plan">-</button>
                    </div>
                `;
                $('#plan-wrapper').append(row);
            });

            // remove plan
            $(document).on('click', '.remove-plan', function () {
                $(this).closest('.plan-row').remove();
            });
        });
</script>
@endpush
