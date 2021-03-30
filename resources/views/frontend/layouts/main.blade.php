<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="@yield('description')">
    <meta name="author" content="@yield('author')">
    <title>@yield('title', config('app.name'))</title>

    @include('frontend.layouts.styles')
</head>
<body>
    <div id="preloader">
        <div id="loader" class="dots-fade">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>

    <div id="top" class="s-wrap site-wrapper">

        @include('frontend.layouts.header')

        <div class="s-content">

             @yield('content')

        </div>

        @include('frontend.layouts.footer')

    </div>

    @include('frontend.layouts.scripts')

</body>
</html>
