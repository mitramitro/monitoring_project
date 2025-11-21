@extends('layouts.default')

@section('content')
<div class="container-fluid">
    <div class="row page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('daily-work.index') }}">Daily Work</a></li>
            <li class="breadcrumb-item"><a href="{{ route('daily-work-item.index') }}">Daily Work Items</a></li>
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

                    <form action="{{ route('daily-work-item.store') }}" method="POST">
                        @csrf

                        {{-- Hidden: daily_work_id --}}
                        <input type="hidden" name="daily_work_id" value="{{ $dailyWork->id ?? old('daily_work_id') }}">

                        {{-- Contract --}}
                        <div class="mb-3">
                            <label for="contract_id" class="form-label">Contract <small class="text-muted">(required)</small></label>
                            <select name="contract_id" id="contract_id" class="form-select" required>
                                <option value="">-- Pilih Contract --</option>
                                @foreach($contracts as $c)
                                    <option value="{{ $c->id }}" {{ old('contract_id') == $c->id ? 'selected' : '' }}>
                                        {{ $c->contract_number }} — {{ $c->job_title ?? '-' }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Time In / Time Out --}}
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

                        {{-- Daily work plan / note --}}
                        <div class="mb-3">
                            <label for="daily_work_plan" class="form-label">Rencana Kerja / Deskripsi Pekerjaan</label>
                            <textarea name="daily_work_plan" id="daily_work_plan" rows="3" class="form-control" placeholder="Tuliskan rencana kerja hari ini...">{{ old('daily_work_plan') }}</textarea>
                            <small class="text-muted">Bisa tulis beberapa rencana—jika perlu multiple plan buat item terpisah.</small>
                        </div>

                        {{-- Note --}}
                        <div class="mb-3">
                            <label for="note" class="form-label">Catatan (opsional)</label>
                            <textarea name="note" id="note" rows="2" class="form-control">{{ old('note') }}</textarea>
                        </div>

                        {{-- Total workers --}}
                        <div class="mb-3">
                            <label for="total_workers" class="form-label">Jumlah Pekerja</label>
                            <input type="number" name="total_workers" id="total_workers" class="form-control" min="0" value="{{ old('total_workers', 1) }}">
                        </div>

                        {{-- approval default hidden --}}
                        <input type="hidden" name="approval" value="0">

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="{{ route('daily-work.items.index', $dailyWork->id ?? 0) }}" class="btn btn-light">Batal</a>
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
document.addEventListener('DOMContentLoaded', function () {
    const isAbsen = document.getElementById('is_absen');
    const divAbsen = document.getElementById('div_absen_reason');

    isAbsen.addEventListener('change', function () {
        if (this.checked) {
            divAbsen.style.display = 'block';
        } else {
            divAbsen.style.display = 'none';
            document.getElementById('absen_reason').value = '';
        }
    });
});
</script>
@endpush
