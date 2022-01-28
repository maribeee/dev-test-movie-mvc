<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- FAVICONS AND PHONE / WINDOWS ICONS -->
{{--    <link rel="apple-touch-icon" sizes="180x180" href=" {{ asset('/apple-touch-icon.png?v=2') }}">--}}
{{--    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('/favicon-32x32.png?v=2') }}">--}}
{{--    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('/favicon-16x16.png?v=2') }}">--}}
    <link rel="shortcut icon" href="{{ asset('/favicon.ico?v=2') }}">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">

    <title>@yield('title')</title>

    <!-- Styles -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div id="app">
    @yield('content')
</div>
<script src="{{ mix('js/app.js') }}"></script>
</body>
</html>
