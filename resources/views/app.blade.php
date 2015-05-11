<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My First App</title>
    <link rel="stylesheet" href="/css/all.css"/>
</head>
<body>
    <div class="container">
        @include('flash::message')

        @yield('content')
    </div>

    <!--<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>-->
    <script src="/js/all.js"></script>


    @yield('footer')
</body>
</html>