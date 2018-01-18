@extends('layouts.master')

@section('title', 'Login')

@section('content')
<div class="row">
  <div class="col-md-4 col-md-offset-4">
    <h1>Change password</h1><br>
  	<form method="post" action="{{ route('store_password.store') }}">
      {{ csrf_field() }}
      <div class="form-group {!! ($errors->has('email') ? 'has-error' : '') !!}">
        <label for="password">Password:</label>
        <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" required>
        @foreach ($errors->get('password') as $message)
            <strong>{{ $message }}</strong><br>
        @endforeach
      </div>
      <div class="form-group {!! ($errors->has('email') ? 'has-error' : '') !!}">
        <label for="password_confirmation">Password:</label>
        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Enter password" required>
        @foreach ($errors->get('password_confirmation') as $message)
            <strong>{{ $message }}</strong><br>
        @endforeach
      </div>
      <input type="submit" class="btn btn-primary col-md-12" aria-label="Left Align" value="Update password">
  	</form>
  </div>
</div>
@endsection
