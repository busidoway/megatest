<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('meta-title')</title>
    <link rel="stylesheet" href="css/app.css">
</head>
<body>
    @include('includes.header')
    <div class="container p-3 my-5">
        @yield('content')
    </div>
    <script src="js/app.js"></script>
</body>
</html>