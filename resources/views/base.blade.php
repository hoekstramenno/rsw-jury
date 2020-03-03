<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="{{ mix('assets/css/admin.css') }}">
    <title>RSW Haarlem {{ $currentYear }}</title>
    @stack('head')
</head>
<body>
<main id="app" class="dashboard-main-wrapper">
    @include('Components.navbar')
    @include('Components.left-nav')
    <div class="dashboard-wrapper">
        @yield('content')
    </div>
</main>

{{-------------------------------------------------------------------------------
Scripts
-------------------------------------------------------------------------------}}

<script src="{{ mix('assets/js/app.js') }}"></script>
@stack('scripts')
</body>
</html>
