<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <meta name="csrf-token" content={{ csrf_token() }}>
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}"/>
    @yield('meta')
    <title>@yield('title')</title>
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
@yield('styles')

</head>
<body class="animsition">
