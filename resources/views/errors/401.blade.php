{{-- Extends layout --}}
@extends('layouts.fullwidth')

{{-- Content --}}
@section('content')
<div class="row h-100 align-items-center">
    <div class="col-lg-6 col-sm-12">
        <div class="form-input-content  error-page">
            <h1 class="error-text text-primary">401</h1>
            <h4> Bad Request</h4>
            <p>Sorry, we are under maintenance!</p>
            <a class="btn btn-primary" href="{{ url('/') }}">Back to Home</a>
        </div>
    </div>
    <div class="col-lg-6 col-sm-12">
        <img class="move-2 error-media" src="{{ asset('templateadmin/images/error-media.png') }}" alt="">
    </div>
</div>
@endsection