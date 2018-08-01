<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    {{ css('bootstrap.min') }}
    {{ Html::style('dashboard/font-awesome/css/font-awesome.css') }}
    {{ css('animate') }}
    {{ css('template') }}
    {{ Html::favicon('favicon.ico') }}
</head>
<body class="gray-bg">

    @yield('content')
   
    {{ js('jquery-2.1.1') }}
    {{ js('bootstrap.min') }}
</body>
</html>
