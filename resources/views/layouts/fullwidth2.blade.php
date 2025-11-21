@php
$controller = DzHelper::controller();
$action = DzHelper::action();
@endphp

<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <!-- All Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="author" content="DexignLab">
    <meta name="robots" content="">
    <meta name="keywords"
        content="bootstrap admin, card, clean, credit card, dashboard template, elegant, invoice, modern, money, transaction, Transfer money, user interface, wallet">
    <meta name="description" content="@yield('page_description', $page_description ?? '')">
    <meta property="og:title" content="Goship - Fuel Terminal REO">
    <meta property="og:description" content="{{ config('dz.name') }} | @yield('title', $page_title ?? '')">
    <meta property="og:image" content="{{ asset('templateadmin/images/logo.png') }}">
    <meta name="format-detection" content="telephone=no">

    <!-- Mobile Specific -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- favicon -->
    <link rel="shortcut icon" type="image/png" href="{{ asset('templateadmin/images/logo.png') }}">

    <!-- Page Title Here -->
    <title>{{ config('dz.name') }} | @yield('title', $page_title ?? '')</title>

    <link rel="stylesheet" href="{{ asset('templateadmin/vendor/sweetalert2/dist/sweetalert2.min.css') }}">

    <link href="{{ asset('templateadmin/vendor/bootstrap-select/dist/css/bootstrap-select.min.css') }}"
        rel="stylesheet">
    <link href="{{ asset('templateadmin/css/style.css') }}" rel="stylesheet">

</head>

<body class="vh-100">
    <div class="authincation h-100">
        <div class="container-fluid h-100">
            @yield('content')
        </div>
    </div>
    <!--**********************************
    Scripts
***********************************-->
    <!-- Required vendors -->

    @php
    $action = isset($action) ? $controller.'_'.$action : 'dashboard_1';
    @endphp
    @if(!empty(config('dz.public.global.js.top')))
    @foreach(config('dz.public.global.js.top') as $script)
    <script src="{{ asset($script) }}" type="text/javascript"></script>
    @endforeach
    @endif
    @if(!empty(config('dz.public.pagelevel.js.'.$action)))
    @foreach(config('dz.public.pagelevel.js.'.$action) as $script)
    <script src="{{ asset($script) }}" type="text/javascript"></script>
    @endforeach
    @endif
    @if(!empty(config('dz.public.global.js.bottom')))
    @foreach(config('dz.public.global.js.bottom') as $script)
    <script src="{{ asset($script) }}" type="text/javascript"></script>
    @endforeach
    @endif

    @stack('scripts')
</body>

</html>