@extends('layouts.master')

@section('title', 'Login')

@section('content')
  <div class="row">
    <div class="col-md-4 col-md-offset-4">
      <h1>Login to Your Account</h1><br>
      <form method="post" action="{{ route('login.login') }}">
        {{ csrf_field() }}


          <div class="form-group {!! ($errors->has('email') ? 'has-error' : '') !!}">
            <label for="email">Email:</label>
            <input type="text" class="form-control Error" id="email" name="email" placeholder="Enter email" value="{{ old('email') }}">
            <span class="help-block">
              @foreach ($errors->get('email') as $message)
                  <strong>{{ $message }}</strong><br>
              @endforeach
            </span>
          </div>


        <div class="form-group {!! ($errors->has('password') ? 'has-error' : '') !!}">
          <label for="password">Password:</label>
          <input type="password" class="form-control" id="password" name="password" placeholder="Enter password">
          <span class="help-block">
            @foreach ($errors->get('password') as $password)
                <strong>{{ $password }}</strong><br>
            @endforeach
          </span>
        </div>
        <input type="submit" class="btn btn-primary col-md-12" aria-label="Left Align" value="Login">
      </form>
    </div>
  </div>
@endsection
