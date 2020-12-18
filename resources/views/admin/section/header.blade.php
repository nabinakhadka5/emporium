
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf_token" content={{ csrf_token() }}>
    <meta name="viewport" content="width=device-width initial-scale=1.0">
    <title>@yield('title')</title>

    <!-- THEME STYLES-->
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet" />
    <!-- PAGE LEVEL STYLES-->

    @yield('styles')
</head>

<body class="fixed-navbar">
    <div class="page-wrapper">
