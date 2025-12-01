@extends('layouts.default')

@section('content')
<div class="container-fluid">

    <div class="row page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('daily-work.index') }}">Daily Work</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Daily Work Items</a></li>
        </ol>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h4 class="card-title">Daily Work Items — {{ optional($dailyWork)->date ?? '-' }} 
                       <small class="text-muted">({{ optional(auth()->user())->username }})</small>
                    </h4>

                    <div>
                        <a href="{{ route('daily-work-item.create', ['dailyWork' => $dailyWork->id]) }}"class="btn btn-primary mb-4">
                            <i class="fas fa-plus-circle"></i> Add Item
                        </a>
                        <a href="{{ route('daily-work.index') }}" class="btn btn-secondary mb-4">
                            <i class="fas fa-arrow-left"></i> Back
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table id="table-items" class="table table-striped table-bordered" style="min-width: 1000px">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Job Title</th>
                                    <th>Budget</th>
                                    <th>Company Name</th>
                                    <th>Time In</th>
                                    <th>Time Out</th>
                                    <th>Overtime Plan</th>
                                    <th>Total Workers</th>
                                    <th>Approval</th>
                                    <th>Absen Reason</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                            <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>Job Title</th>
                                    <th>Budget</th>
                                    <th>Company Name</th>
                                    <th>Time In</th>
                                    <th>Time Out</th>
                                    <th>Overtime Plan</th>
                                    <th>Total Workers</th>
                                    <th>Approval</th>
                                    <th>Absen Reason</th>
                                    <th>Aksi</th>
                                </tr>
                            </tfoot>
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

    // Inisialisasi DataTable untuk daily work items
    var table = $('#table-items').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        ajax: "{{ route('daily-work-item.index', $dailyWork->id) }}",
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },

            // contract data: job_title, budget, company
            { data: 'job_title', name: 'contract.job_title' },
            { data: 'budget', name: 'contract.budget' },
            { data: 'company_name', name: 'company.name' },

            { data: 'time_in', name: 'time_in' },
            { data: 'time_out', name: 'time_out' },
            { data: 'overtime_until_plan', name: 'overtime_until_plan' },

            { data: 'total_workers', name: 'total_workers' },

            { data: 'approval', name: 'approval' },
            { data: 'absen_reason', name: 'absen_reason' },

            { data: 'action', name: 'action', orderable: false, searchable: false },
        ],
        columnDefs: [
            { width: '120px', targets: 10 }
        ],
        language: {
            paginate: {
                next: '<i class="fa fa-angle-double-right" aria-hidden="true"></i>',
                previous: '<i class="fa fa-angle-double-left" aria-hidden="true"></i>'
            }
        }
    });

    // Example: handle click tombol edit/delete/approve via event delegation
    // $(document).on('click', '.btn-edit-item', function(e) {
    //     e.preventDefault();
    //     var url = $(this).data('url');
    //     window.location.href = url;
    // });
// $(document).on('click', '.btn-edit-item', function(e) {
//     e.preventDefault();
//     window.location.href = $(this).attr('href');
// });
    // Hapus item (jika butuh)
    // $(document).on('click', '.btn-delete-item', function(e) {
    //     e.preventDefault();
    //     var id = $(this).data('id');
    //     var url = "{{ url('daily-work-item') }}/" + "{{ $dailyWork->id }}/"  + id;

    //     swal({
    //         title: "Yakin ingin menghapus?",
    //         text: "Item akan dihapus permanen!",
    //         icon: "warning",
    //         buttons: ["Batal", "Hapus"],
    //         dangerMode: true,
    //     }).then((willDelete) => {
    //         if (willDelete) {
    //             $.ajax({
    //                 url: url,
    //                 type: 'DELETE',
    //                 headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
    //                 success: function(res) {
    //                     table.ajax.reload();
    //                     swal("Berhasil", "Item berhasil dihapus.", "success");
    //                 },
    //                 error: function(err) {
    //                     swal("Gagal", "Terjadi kesalahan saat menghapus.", "error");
    //                 }
    //             });
    //         }
    //     });
    // });


     // Hapus user
     $(document).on('click', '.btn-delete-item', function(e) {
        e.preventDefault();
         var id = $(this).data('id');
         var url = "{{ url('daily-work-item') }}/" + "{{ $dailyWork->id }}/"  + id;
        swal({
            title: "Apakah Anda yakin akan menghapusnya?",
            text: "Data ini akan dihapus permanen!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Ya, hapus!",
            cancelButtonText: "Batal",
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                    type: 'DELETE',
                    url: url,
                    success: function() {
                        table.ajax.reload();
                        swal("Berhasil", "Data berhasil dihapus.", "success");
                    },
                    error: function() {
                        swal("Gagal", "Terjadi kesalahan saat menghapus data!", "error");
                    }
                });
            }
        });
    });

    // Approve item (contoh, harus disesuaikan API)
    $(document).on('click', '.btn-approve-item', function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        var url = "{{ url('daily-work-item') }}/" + "{{ $dailyWork->id }}/" + id + "/approve";

        $.ajax({
            url: url,
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            success: function(res) {
                table.ajax.reload();
                swal("Berhasil", "Item berhasil di-approve.", "success");
            },
            error: function(err) {
                swal("Gagal", "Terjadi kesalahan saat approve.", "error");
            }
        });
    });
</script>
@endpush
