{{-- Extends layout --}}
@extends('layouts.fullwidth')

{{-- Content --}}
@section('content')
<div class="row h-100 align-items-center">
    <div class="col-lg-6 col-sm-12">
        <div class="form-input-content  error-page">
            <h1 class="error-text text-primary">419</h1>
            <h4>Page Expired!</h4>
            <p>You may have mistyped the address or the page may have moved.</p>
            <a class="btn btn-primary" href="{{ url('/') }}">Back to Home</a>

        </div>
    </div>
    <div class="col-lg-6 col-sm-12">
        <img class="w-100 move-2" src="{{ asset('templateadmin/images/error.png') }}" alt="">
    </div>
</div>
@endsection