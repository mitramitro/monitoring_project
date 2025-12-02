@extends('layouts.fullwidth2')

@section('content')
<div class="row h-100">

    <div class="col-lg-6 col-md-12 col-sm-12 mx-auto align-self-center">
        <div class="login-form" style="background-color: white; 0 1%9box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); padding: 30px; border-radius:8px">
            <div class="text-center">
                <img src="{{ asset('/templateadmin/images/logo-pertamina-patraniaga.png') }}"
                    style="width: 300px;margin-bottom: 20px" alt="">
                <h3 class="title">Sign In</h3>
                <p>Sign in to your account to start using {{ config('dz.name') }}</p>
            </div>
            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="mb-1 text-dark">Username</label>
                    <input type="text" class="form-control form-control" name="username" placeholder="Masukan Username"
                        value="">
                </div>
                <div class="mb-4 position-relative">
                    <label class="mb-1 text-dark">Password</label>
                    <input type="password" id="dlab-password" class="form-control form-control" name="password"
                        placeholder="Masukan Passwod">
                    <span class="show-pass eye">

                        <i class="fa fa-eye-slash"></i>
                        <i class="fa fa-eye"></i>

                    </span>
                </div>

                <div class="text-center mb-4">
                    <button type="submit" class="btn btn-primary btn-block">Sign In</button>

                </div>
            </form>
        </div>
    </div>
    {{-- <div class="col-xl-6 col-lg-6">
        <div class="pages-left h-100"
            style="background-image: url({{ asset('templateadmin/images/background-login.png') }}); background-repeat:no-repeat; background-size:cover;">
            <div class="login-content">

            </div>
            <div class="login-media text-center">

            </div>
        </div>
    </div> --}}
</div>
@endsection

@push('scripts')
<script>
    @if(session('errors'))
        sweetAlert("Gagal Login", "Kombinasi username dan password salah", "error")
    @endif
</script>
@endpush