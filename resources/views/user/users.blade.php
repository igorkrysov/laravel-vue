@extends('layouts.master')

@section('title', 'Login')

@section('content')

  @if((Session::get('user'))->is_admin())
  <div class="row">
    <div class="col-md-4 col-md-offset-4">
      <h1 class="text-center">Add user</h1><br>
    	<form method="post" action="{{ route('users.store') }}">
        {{ csrf_field() }}

        <div class="form-group {!! ($errors->has('name') ? 'has-error' : '') !!}">
          <label for="name">Name:</label>
          <input type="text" class="form-control" id="name" name="name" placeholder="Enter name" value="{{ old('name') }}">
          <span class="help-block">
            @foreach ($errors->get('name') as $name)
                <strong>{{ $name }}</strong><br>
            @endforeach
          </span>
        </div>
        <div class="form-group {!! ($errors->has('email') ? 'has-error' : '') !!}">
          <label for="mail">Email:</label>
          <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" value="{{ old('email') }}">
          <span class="help-block">
            @foreach ($errors->get('email') as $message)
                <strong>{{ $message }}</strong><br>
            @endforeach
          </span>
        </div>
        <div class="form-group">
          <label for="group_id">Group:</label>
          <select class="form-control" id="group_id" name="group_id">
            @foreach ($groups as $group)
              <option value="{{ $group->id }}" {!! (old('group_id') == $group->id) ? 'selected' : '' !!}>{{ $group->group }}</option>
            @endforeach
          </select>
        </div>
        <input type="submit" class="btn btn-primary col-md-12" aria-label="Left Align" value="Add">
    	</form>
    </div>
  </div>
  @endif
  <div class="row">
    <div class="col-md-4 col-md-offset-4">
      <h1 class="text-center">List users</h1><br>
        <table class="table table-bordered table-striped table-hover">
          <thead>
            <tr>
              <th>#</th>
              <th>Name</th>
              <th>Email</th>
              <th>Group</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($users as $user)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->group->group }}</td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
  </div>
@endsection
