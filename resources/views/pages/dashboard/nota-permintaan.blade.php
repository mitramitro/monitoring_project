@extends('layouts.default')

@section('content')
<div class="container-fluid">

    <div class="row page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Nota Permintaan</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)">Nota Permintaan</a></li>
        </ol>
    </div>
    <!-- row -->

    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Filter</h4>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Nota Permintaan</h4>
                </div>
                <div class="card-body">
                    @if(Auth::user()->role == 'pengusul')
                    <div class="row">
                        <div class="col-12">
                            <a href="{{ route('nota-permintaan.create') }}" class="btn btn-primary mb-4 float-end">
                                <i class="fas fa-plus-circle"></i>
                                Tambah Nota Permintaan
                            </a>
                        </div>
                    </div>
                    @endif
                    <div class="table-responsive">
                        <table id="tabel" class="display" style="min-width: 845px">
                            <thead>
                                <tr>
                                    <th>Aksi</th>
                                    <th>No Nota</th>
                                    <th>Tanggal</th>
                                    <th>Fungsi Pengusul</th>
                                    <th>Perihal</th>
                                    <th>Approval</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>
                                <th>Aksi</th>
                                <th>No Nota</th>
                                <th>Tanggal</th>
                                <th>Fungsi Pengusul</th>
                                <th>Perihal</th>
                                <th>Approval</th>
                                <th>Status</th>
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
    $('#daterange').daterangepicker({
        timePicker: true,
        timePicker24Hour: false,
        locale: {
            format: 'MM/DD/YYYY'
        }
    });

    $('#reset_filter').click(function() {
        window.location.reload();
    })

    $('#daterange').val('');

    function updateTable(){
        table.draw()
    }

    @if(session('success'))
    swal("Yeyy Berhasil", "{{ session('success') }}", "success")
    @endif

    var table = $('#tabel').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        ajax: {
            url: "{{ route('dashboard.nota-permintaan') }}",
            data: function(d) {
                d.daterange = $('#daterange').val();  
                d.status = 'WAITING APPROVAL';  
            }
        },
        columns: [
            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false
            },
            {
                data: 'number',
                name: 'number',
            },
            {
                data: 'date',
                name: 'date',
            },
            {
                data: 'from',
                name: 'from',
            },
            {
                data: 'regarding',
                name: 'regarding',
            },
            {
                data: 'approval',
                name: 'approval',
            },
            {
                data: 'status',
                name: 'status',
            },
            
        ],
        columnDefs: [{ width: '22%', targets: 3 }],
        language: {
            paginate: {
                next: '<i class="fa fa-angle-double-right" aria-hidden="true"></i>',
                previous: '<i class="fa fa-angle-double-left" aria-hidden="true"></i>' 
            }
        }
    });

    $(document).on('click', '.delete', function() {
        var user_id = $(this).attr('id');
        swal({
            title: "Apakah Anda yakin akan menghapusnya?",
            text: "Anda tidak akan dapat memulihkan file data ini!!",
            type: "warning",
            showCancelButton: !0,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, delete it !!",
            closeOnConfirm: !1
        }).then((result) => {
            if(result.value) {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'DELETE',
                    url: "{{ url('/nota-permintaan') }}/"+user_id,
                    success: function(){
                        table.ajax.reload();
                        swal("Berhasil", "Berhasil Menghapus Data", "success")
                    },
                    error:function(){
                        sweetAlert("Gagal", "Gagal Menghapus data !!", "error")
                    }
                })
            }
        })
    });
</script>
@endpush