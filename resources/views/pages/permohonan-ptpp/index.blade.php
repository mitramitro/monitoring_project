@extends('layouts.default')

@section('content')
<div class="container-fluid">

    <div class="row page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Permohonan PTPP</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)">Permohonan PTPP</a></li>
        </ol>
    </div>
    <!-- row -->

    <div class="row">

        <div class="col-xl-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Filter</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('permohonan-ptpp.export') }}" target="_blank">
                        <div class="row">
                            <div class="col-lg-3 mb-3">
                                <div class="example">
                                    <input type="text" class="form-control input-daterange-timepicker" name="daterange"
                                        id="daterange" onchange="updateTable()" placeholder="Pilih Rentang Tanggal"
                                        value="" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-lg-3 mb-3">
                                <div class="test">
                                    <select class="single-select" id="status" onchange="updateTable()">
                                        <option value="">Pilih Status</option>
                                        <option value="WAITING APPROVAL">WAITING APPROVAL</option>
                                        <option value="OPEN">OPEN</option>
                                        <option value="IN PROGRESS">IN PROGRESS</option>
                                        <option value="PENDING">PENDING</option>
                                        <option value="COMPLETED">COMPLETED</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3 mb-3">
                                <div class="test">
                                    <select class="single-select" id="location_id" onchange="updateTable()">
                                        <option value="">Pilih Lokasi</option>
                                        @foreach ($locations as $location)
                                        <option value="{{ $location->id }}">{{ $location->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3 mb-3">
                                <div class="test">
                                    <select class="single-select" id="function" onchange="updateTable()">
                                        <option value="">Fungsi Pengusul</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-auto mb-3">
                                <button class="btn btn-success reset-btn" name="excel" value="excel"
                                    title="Click here to remove filter" type="submit">Export Excel</button>
                            </div>
                            <div class="col-lg-auto mb-3">
                                <button class="btn btn-danger reset-btn" name="pdf" value="pdf"
                                    title="Click here to remove filter" type="submit">Export PDF</button>
                            </div>
                            <div class="col-lg-auto mb-3">
                                <button class="btn btn-warning reset-btn" title="Click here to remove filter"
                                    type="button" id="reset_filter">Reset Filter</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Permohonan PTPP</h4>
                </div>
                <div class="card-body">

                    <div class="table-responsive">
                        <table id="tabel" class="display" style="min-width: 845px">
                            <thead>
                                <tr>
                                    <th>Aksi</th>
                                    <th>No PTPP</th>
                                    <th>Pengusul</th>
                                    <th>Judul Temuan</th>
                                    <th>Lokasi Temuan</th>
                                    <th>Sumber Ketidaksesuaian</th>
                                    <th>Status</th>
                                    <th>Tanggal Dibuat</th>
                                    <th>Target Selesai</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>
                                <th>Aksi</th>
                                <th>No PTPP</th>
                                <th>Pengusul</th>
                                <th>Judul Temuan</th>
                                <th>Lokasi Temuan</th>
                                <th>Sumber Ketidaksesuaian</th>
                                <th>Status</th>
                                <th>Tanggal Dibuat</th>
                                <th>Target Selesai</th>
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
    $('#reset_filter').click(function() {
        window.location.reload();
    })

    @if(session('success'))
    swal("Yeyy Berhasil", "{{ session('success') }}", "success")
    @endif

    $('#daterange').daterangepicker({
        timePicker: true,
        timePicker24Hour: false,
        locale: {
            format: 'MM/DD/YYYY'
        }
    });

    $('#daterange').val('');

    function updateTable(){
        table.draw()
    }

    var table = $('#tabel').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        ajax: {
            url: "{{ route('permohonan-ptpp.index') }}",
            data: function(d) {
                d.daterange = $('#daterange').val();  
                d.status = $('#status').val();  
                d.location_id = $('#location_id').val();  
                d.function = $('#function').val();  
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
                data: 'from_function',
                name: 'from_function',
            },
            {
                data: 'title',
                name: 'title',
            },
            {
                data: 'location.name',
                name: 'location.name',
            },
            {
                data: 'potential_source',
                name: 'potential_source',
            },
            {
                data: 'status',
                name: 'status',
            },
            {
                data: 'date',
                name: 'date',
            },
            {
                data: 'completion_date',
                name: 'completion_date',
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
                    url: "{{ url('/permohonan-ptpp') }}/"+user_id,
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