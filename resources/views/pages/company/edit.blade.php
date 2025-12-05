@extends('layouts.default')

@section('content')
<div class="container-fluid">

    <div class="row page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('company.index') }}">Company</a></li>
            <li class="breadcrumb-item active">Edit Company</li>
        </ol>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4>Edit Company</h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('company.update', $company->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label">Company Name</label>
                            <input 
                                type="text" 
                                name="name" 
                                class="form-control" 
                                value="{{ $company->name }}" 
                                required
                            >
                        </div>

                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="{{ route('company.index') }}" class="btn btn-secondary">Back</a>

                    </form>
                </div>

            </div>
        </div>
    </div>

</div>
@endsection
