<html>
    <head>
        <title>@yield('title')</title>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    </head>
    <body>
        <div class="container">
            <div class="row">
              <div class="col-md-1 col-md-offset-11">
                @if(Session::has('user'))
                  <a href="{{ route('login.logout') }}">Logout</a>
                @else
                  <a href="{{ route('login.index') }}">Login</a>
                @endif
              </div>
            </div>
            <div class="row">
              <div class="message">
                @if(session()->has('message_danger'))
                  <div class="alert alert-danger">
                    {{ session()->get('message_danger') }}
                  </div>
                @endif

                @if(session()->has('message_success'))
                  <div class="alert alert-success">
                    {{ session()->get('message_-success') }}
                  </div>
                @endif
              </div>
            </div>

            @yield('content')
        </div>
    </body>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</html>
