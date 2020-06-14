<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        {{-- <link rel="stylesheet" type="text/css" href="{{asset('css/app.css')}}"> --}}
        {{-- <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.min.css')}}"> --}}
        <title>@yield('title')</title>
    </head>
    <body>
        <div class="container">
            {{-- @include('includes/messages') --}}
            @yield('content')
        </div>
    </body>
</html>
