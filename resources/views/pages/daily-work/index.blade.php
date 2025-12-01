@extends('layouts.default')

@section('content')
<div class="container-fluid">

    <div class="row page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Daily Work</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)">Daily Work</a></li>
        </ol>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Daily Work</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            @if(auth()->check() && auth()->user()->role === 'mps')
                                <a href="{{ route('daily-work.create') }}" class="btn btn-primary mb-3">
                                    Add Daily Work
                                </a>
                            @endif
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table id="tabel" class="display" style="min-width: 845px">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Date</th>
                                    {{-- <th>Username</th> --}}
                                    <th>Note</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                            <tfoot>
                                <tr>
                                   <th>No</th>
                                    <th>Date</th>
                                    {{-- <th>Username</th> --}}
                                    <th>Note</th>
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
// console.log('--- debug start ---');
// console.log('Is #tabel present?', !!document.querySelector('#tabel'));
// console.log('jQuery present?', typeof jQuery !== 'undefined');
// console.log('DataTable plugin present?', typeof jQuery !== 'undefined' && typeof jQuery.fn.DataTable !== 'undefined');

    @if(session('success'))
        swal("Yeyy Berhasil", "{{ session('success') }}", "success");
    @endif

    // Tabel Data
    // var table = $('#tabel').DataTable({
    //     processing: true,
    //     serverSide: true,
    //     ajax: "{{ route('daily-work.index') }}",
    //     columns: [
    //         { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
    //         { data: 'date', name: 'date' },
    //         { data: 'username', name: 'username' },
    //         { data: 'note', name: 'note' },
    //         { data: 'action', name: 'action', orderable: false, searchable: false },
    //     ]
    // });

     var table = $('#tabel').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
         ajax: "{{ route('daily-work.index') }}",
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'date', name: 'date' },
            // { data: 'username', name: 'username' },
            { data: 'note', name: 'note' },
            { data: 'action', name: 'action', orderable: false, searchable: false },
        ],
        columnDefs: [{ width: '22%', targets: 3 }],
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
