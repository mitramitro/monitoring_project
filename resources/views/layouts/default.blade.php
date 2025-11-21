@php
$controller = DzHelper::controller();
$action = DzHelper::action();
@endphp

<!DOCTYPE html>
<html lang="en">

<head>

    <!-- All Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="author" content="DexignLab">
    <meta name="robots" content="">
    <meta name="keywords" content="Goship - Fuel Terminal REO">
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

    @php
    $current_page = isset($action) ? $action : '';
    $action = isset($action) ? $controller.'_'.$action : 'dashboard_1';
    @endphp
    @if(!empty(config('dz.public.pagelevel.css.'.$action)))
    @foreach(config('dz.public.pagelevel.css.'.$action) as $style)
    <link href="{{ asset($style) }}" rel="stylesheet" type="text/css" />
    @endforeach
    @endif

    @if(!empty(config('dz.public.global.css')))
    @foreach(config('dz.public.global.css') as $style)
    <link href="{{ asset($style) }}" rel="stylesheet" type="text/css" />
    @endforeach
    @endif

    @stack('styles')

</head>

<body>
    <div id="main-wrapper">

        <div class="nav-header">
            <a href="{{ url('home') }}" class="brand-logo">
                <img src="{{ asset('templateadmin/images/logo.png') }}" width="60">
            </a>
            <div class="nav-control">
                <div class="hamburger">
                    <span class="line"></span><span class="line"></span><span class="line"></span>
                </div>
            </div>
        </div>

        @include('elements.header')

        @include('elements.sidebar')

        @php
        $content_body = '' ;
        if ($current_page == 'ui_badge') { $content_body = 'badge-demo'; }
        if ($current_page == 'ui_button') { $content_body = 'btn-page'; }
        @endphp

        <div class="content-body {{ $content_body }}">
            @yield('content')
        </div>

        @include('elements.footer')
    </div>
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