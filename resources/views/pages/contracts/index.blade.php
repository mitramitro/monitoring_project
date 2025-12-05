@extends('layouts.default')

@section('content')
<div class="container-fluid">

    <div class="row page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active">Contracts</li>
        </ol>
    </div>

  
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Contract</h4>
                </div>

                <div class="card-body">
                    <div class="row">
                                <div class="col-12">
                                    <a href="{{ route('contracts.create') }}" class="btn btn-primary mb-4 float-end">
                                        <i class="fas fa-plus-circle"></i>
                                        Add Contract
                                    </a>
                                </div>
                            </div>
                    <div class="table-responsive">
                    {{-- <table id="contractsTable" class="table table-bordered table-striped"> --}}
                    <table id="contractsTable" class="display" style="min-width: 845px">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Contract Number</th>
                                <th>Company</th>
                                <th>Job Title</th>
                                <th>Budget</th>
                                <th>PIC</th>
                                <th>Safety Man</th>
                                <th>Handphone</th>
                                <th>Status</th>
                                <th width="120px">Action</th>
                            </tr>
                        </thead>
                    </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    @if(session('success'))
        swal("Berhasil", "{{ session('success') }}", "success");
    @endif
$(function() {
    let table = $('#contractsTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('contracts.index') }}",
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'contract_number', name: 'contract_number' },
            { data: 'company_name', name: 'company_name' },
            { data: 'job_title', name: 'job_title' },
            { data: 'budget', name: 'budget' },
            { data: 'pic', name: 'pic' },
            { data: 'safety_man', name: 'safety_man' },
            { data: 'handphone', name: 'handphone' },
            { data: 'status', name: 'status' },
            { data: 'action', name: 'action', orderable: false, searchable: false },
        ],
        columnDefs: [
        { width: "5%",  targets: 0 },
        { width: "15%", targets: 1 },
        { width: "15%", targets: 2 },
        { width: "15%", targets: 3 },
        { width: "8%", targets: 4 },
        { width: "10%", targets: 5 },
        { width: "10%", targets: 6 },
        { width: "10%", targets: 7 },
        { width: "10%", targets: 8 },
        { width: "8%", targets: 9 },
    ],
    // Tambahan untuk tombol export
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'excelHtml5',
                title: 'Contracts Data',
                text: 'Export Excel'
            }
        ]
    });

    // Delete
    $(document).on('click', '.btn-delete', function() {
        let id = $(this).data('id');

        Swal.fire({
            title: "Hapus data?",
            text: "Data ini tidak bisa dikembalikan.",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Ya, hapus",
            cancelButtonText: "Batal"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "/contracts/" + id,
                    type: "DELETE",
                    data: { _token: "{{ csrf_token() }}" },
                    success: function() {
                        table.ajax.reload();
                        Swal.fire("Berhasil", "Data berhasil dihapus.", "success");
                    }
                });
            }
        });
    });

});
</script>
@endpush
