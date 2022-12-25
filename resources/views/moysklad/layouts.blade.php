<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="robots" content="noindex, nofollow">
    <title>TIS KZ - @yield('title')</title>
    <style>
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Selectivity.js/2.1.0/selectivity-full.min.css">
    <link rel="stylesheet" href="{{asset('assets/css/uikit.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
    <script src="{{asset('assets/js/jquery.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Selectivity.js/2.1.0/selectivity-full.min.js"></script>
    <script src="{{asset('assets/js/uikit.js')}}"></script>
</head>
<body>
<div class="container">
    @yield('content')
</div>
<script type="text/javascript"
        src="https://online.moysklad.ru/js/ns/appstore/app/v1/moysklad-iframe-expand-2.js"></script>
</body>
</html>
