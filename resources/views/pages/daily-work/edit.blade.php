@extends('layouts.default')

@section('content')
<div class="container-fluid">
    <div class="row page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('daily-work.index') }}">Daily Work</a></li>
            <li class="breadcrumb-item active">Edit Daily Work</li>
        </ol>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4>Edit Daily Work</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('daily-work.update', $dailyWork->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="date" class="form-label">Date</label>
                            <input type="date" name="date" id="date" class="form-control" value="{{ $dailyWork->date }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="note" class="form-label">Note</label>
                            <textarea name="note" id="note" class="form-control" rows="3">{{ $dailyWork->note }}</textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="{{ route('daily-work.index') }}" class="btn btn-secondary">Back</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
