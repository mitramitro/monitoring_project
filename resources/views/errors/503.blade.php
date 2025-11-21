{{-- Extends layout --}}
@extends('layouts.fullwidth')

{{-- Content --}}
@section('content')
<div class="row h-100 align-items-center">
    <div class="col-lg-6 col-sm-12">
        <div class="form-input-content  error-page">
            <h1 class="error-text text-primary">503</h1>
            <h4> Service Unavailable</h4>
            <p>Sorry, we are under maintenance!</p>
            <a class="btn btn-primary" href="{{ url('index') }}">Back to Home</a>

        </div>
    </div>
    <div class="col-lg-6 col-sm-12">
        <img class="w-100 move-2" src="{{ asset('templateadmin/images/error.png') }}" alt="">
    </div>
</div>
@endsection