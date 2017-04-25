<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="token" content="{{csrf_token()}}">
    @yield('title')
    <link rel="stylesheet" href="/lib/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/lib/toastr/toastr.min.css">
    <link rel="stylesheet" href="/css/app.min.css">
</head>
<body>
    @include('layouts.navbar')
    @yield('content')

    <script src="/lib/jquery/dist/jquery.min.js"></script>
    <script src="/lib/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="/lib/bootbox.js/bootbox.js"></script>
    <script src="/lib/toastr/toastr.min.js"></script>
    <script src="/js/app.js"></script>
</body>
</html>