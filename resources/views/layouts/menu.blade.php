<nav class="navbar  navbar-inverse">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Brand</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a href="{{ route('users.index') }}">Users</a></li>
        <li><a href="{{ route('category.index') }}">Categories</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        @if(Session::has('user'))
          <li><a href="{{ route('login.logout') }}">Logout {{ (Session::get('user'))->name }}</a></li>
        @else
          <li><a href="{{ route('login.index') }}">Login</a></li>
        @endif
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
