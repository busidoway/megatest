<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('meta-title')</title>
    <link rel="stylesheet" href="/vendor/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="/css/app.css">
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/print.css">
</head>
<body>
    @include('includes.header')
    <div class="container px-4 py-5 my-3">
        @yield('content')
    </div>
    <script src="/js/app.js" defer></script>
    <!-- <script src="/vendor/@popperjs/core/dist/umd/popper.min.js"></script> -->
    <script src="/vendor/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- <script async defer src="https://buttons.github.io/buttons.js"></script> -->
    <script src="/vendor/notyf/notyf.min.js"></script>
</body>
</html>