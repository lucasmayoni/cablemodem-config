<!doctype html>
<html>
<head>
    @include('includes.head')
</head>
<body>
<div id="wrapper">

    <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">

        @include('includes.header')
        <div class="navbar-default sidebar" role="navigation">
            @include('includes.sidebar')
        </div>
    </nav>
    <div id="page-wrapper">

        @yield('content')

    </div>


    @include('includes.footer')


</div>
</body>
</html>
