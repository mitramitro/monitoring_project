@extends('layouts.default')

@section('content')
<div class="container-fluid">

    <div class="row page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Management User</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)">Management User</a></li>
        </ol>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Management User</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <a href="{{ route('management-users.create') }}" class="btn btn-primary mb-4 float-end">
                                <i class="fas fa-plus-circle"></i>
                                Tambah User
                            </a>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table id="tabel" class="display" style="min-width: 845px">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Username</th>
                                    <th>No HP</th>
                                    <th>Perusahaan</th>
                                    <th>Role</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                            <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Username</th>
                                    <th>No HP</th>
                                    <th>Perusahaan</th>
                                    <th>Role</th>
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
        swal("Yeyy Berhasil", "{{ session('success') }}", "success");
    @endif

    var table = $('#tabel').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        ajax: "{{ route('management-users.index') }}",
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'name', name: 'name' },
            { data: 'username', name: 'username' },
            { data: 'handphone', name: 'handphone' },
            { data: 'company', name: 'company' },
            { data: 'role', name: 'role' },
            { data: 'action', name: 'action', orderable: false, searchable: false },
        ],
        columnDefs: [{ width: '22%', targets: 4 }],
        language: {
            paginate: {
                next: '<i class="fa fa-angle-double-right" aria-hidden="true"></i>',
                previous: '<i class="fa fa-angle-double-left" aria-hidden="true"></i>'
            }
        }
    });

    // Hapus user
    $(document).on('click', '.delete', function() {
        var user_id = $(this).attr('id');
        swal({
            title: "Apakah Anda yakin akan menghapusnya?",
            text: "Data pengguna ini akan dihapus permanen!",
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
                    url: "{{ url('/management-users') }}/" + user_id,
                    success: function() {
                        table.ajax.reload();
                        swal("Berhasil", "Data pengguna berhasil dihapus.", "success");
                    },
                    error: function() {
                        swal("Gagal", "Terjadi kesalahan saat menghapus data!", "error");
                    }
                });
            }
        });
    });
</script>
@endpush
