@extends('layouts.master')

@section('title', 'Login')

@section('content')
  <div class="row">
    <div class="col-md-4 col-md-offset-4">
      <h1>Login to Your Account</h1><br>
      <form method="post" action="{{ route('login.login') }}">
        {{ csrf_field() }}
        <div class="form-group">
          <label for="email">Email:</label>
          <input type="email" class="form-control" id="email" name="email" placeholder="Enter email">
        </div>
        <div class="form-group">
          <label for="password">Password:</label>
          <input type="password" class="form-control" id="password" name="password" placeholder="Enter password">
        </div>
        <input type="submit" class="btn btn-primary col-md-12" aria-label="Left Align" value="Login">
      </form>
    </div>
  </div>
@endsection
