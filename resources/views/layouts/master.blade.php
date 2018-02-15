<html>
    <head>
        <title>@yield('title')</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        @stack('css')
        <link href="{{ asset('/css/master.css') }}" rel="stylesheet">
        <link href="{{ asset('/css/font-awesome.min.css') }}" rel="stylesheet">

    </head>
    <body>
        <div class="container" id="app">
            @include('layouts.menu')
            @include('layouts.messages')

            @yield('content')
        </div>
    </body>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    @stack('scripts')
</html>
