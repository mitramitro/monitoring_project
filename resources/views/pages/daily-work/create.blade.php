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
                            <a href="{{ route('daily-work.index') }}" class="btn btn-secondary mb-4 float-end">
                                <i class="fas fa-arrow-left"></i>
                                Back to Daily Work
                            </a>
                        </div>
                    </div>
                    <form action="{{ route('daily-work.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="date" class="form-label">Date</label>
                            <input type="date" class="form-control" id="date" name="date" required>
                        </div>
                        <div class="mb-3">
                            <label for="note" class="form-label">Note</label>
                            <textarea class="form-control" id="note" name="note" rows="4" ></textarea>
                        </div>
                        <button type="submit" class="btn btn-success">Submit</button>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>     
@endsection 