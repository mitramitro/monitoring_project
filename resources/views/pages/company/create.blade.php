@extends('layouts.default')

@section('content')
<div class="container-fluid">

    <div class="row page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Company</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)">Add Company</a></li>
        </ol>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Add Company</h4>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <a href="{{ route('company.index') }}" class="btn btn-secondary mb-4 float-end">
                                <i class="fas fa-arrow-left"></i>
                                Back to Company List
                            </a>
                        </div>
                    </div>

                    <form action="{{ route('company.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label">Company Name</label>
                            <input type="text" 
                                   class="form-control" 
                                   id="name" 
                                   name="name" 
                                   required>
                        </div>

                        <button type="submit" class="btn btn-success">Submit</button>

                    </form>

                </div>
            </div>
        </div>
    </div>

</div>
@endsection
