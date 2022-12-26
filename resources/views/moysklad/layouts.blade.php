<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="robots" content="noindex, nofollow">
    <title>TIS KZ - @yield('title')</title>
    <style>
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Selectivity.js/2.1.0/selectivity-full.min.css">
    <link rel="stylesheet" href="/assets/css/uikit.css">
    <link rel="stylesheet" href="/assets/css/style.css">
    <script src="/assets/js/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Selectivity.js/2.1.0/selectivity-full.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="/assets/js/uikit.js"></script>
    @yield('styles')
    @yield('js')
</head>
<body>
<div class="container">
    @yield('content')
</div>
<script type="text/javascript"
        src="https://online.moysklad.ru/js/ns/appstore/app/v1/moysklad-iframe-expand-2.js"></script>
</body>
</html>
