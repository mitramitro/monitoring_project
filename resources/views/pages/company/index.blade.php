@extends('layouts.default')

@section('content')
<div class="container-fluid">

    <div class="row page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Master</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)">Company</a></li>
        </ol>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">

                <div class="card-header">
                    <h4 class="card-title">Company</h4>
                </div>

                <div class="card-body">

                    <div class="row">
                        <div class="col-12">
                            <a href="{{ route('company.create') }}" class="btn btn-primary mb-4 float-end">
                                <i class="fas fa-plus-circle"></i>
                                Add Company
                            </a>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table id="tabel" class="display" style="min-width: 845px">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Company Name</th>
                                    <th>PIC</th>
                                    <th>Safety Man</th>
                                    <th>Handphone</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                            <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>Company Name</th>
                                    <th>PIC</th>
                                    <th>Safety Man</th>
                                    <th>Handphone</th>
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

    // =====================
    // DATATABLE SERVER SIDE
    // =====================
    var table = $('#tabel').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        ajax: "{{ route('company.index') }}",
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'name', name: 'name' },
            { data: 'pic', name: 'pic' },
            { data: 'safety_man', name: 'safety_man' },
            { data: 'handphone', name: 'handphone' },
            { data: 'action', name: 'action', orderable: false, searchable: false },
        ],
        columnDefs: [{ width: '20%', targets: 5 }],
        language: {
            paginate: {
                next: '<i class="fa fa-angle-double-right"></i>',
                previous: '<i class="fa fa-angle-double-left"></i>'
            }
        }
    });

    // ==========================
    // DELETE (SweetAlert + AJAX)
    // ==========================
    $(document).on('click', '.delete', function() {
        var id = $(this).attr('id');

        swal({
            title: "Yakin mau hapus?",
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
                    url: "{{ url('company') }}/" + id,
                    success: function () {
                        table.ajax.reload();
                        swal("Berhasil", "Data berhasil dihapus!", "success");
                    },
                    error: function () {
                        swal("Gagal", "Terjadi kesalahan saat menghapus data!", "error");
                    }
                });
            }
        });
    });

</script>
@endpush
