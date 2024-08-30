<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Dynamic Page Title -->
    <title>@yield('title', '') | Banking Application</title>

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('assets/img/favicon.png') }}" type="image/x-icon">

    <!-- Main CSS -->
    <link href="{{ asset('assets/css/main.css') }}" rel="stylesheet">

    <!-- Additional CSS Files -->
    @stack('styles')
</head>

<body>
    <div id="app">
        @include('components.common.header')

        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <!-- Additional JS Files -->
    @stack('scripts')
</body>

</html>