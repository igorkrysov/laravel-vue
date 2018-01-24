@extends('layouts.master')

@section('title', 'News categories')

@section('content')
@php
$name = 'andy'

@endphp
Welcom, {{ $name or 'John' }}
<div class="row">
  <div class="col-md-7 col-md-offset-2">
    <h1 class="text-center">Add categories</h1><br>
    <form method="post" action="{{ route('category.store') }}">
      {{ csrf_field() }}

      <div class="form-group {!! ($errors->has('category') ? 'has-error' : '') !!}">
        <label for="category">Category:</label>
        <input type="text" class="form-control Error" id="category" name="category" placeholder="Enter category" value="{{ old('category') }}">
        <input type="hidden" class="form-control Error" id="user_id" name="user_id" value="{{ (Session::get('user'))->id }}">
        <span class="help-block">
          @foreach ($errors->get('category') as $category)
              <strong>{{ $category }}</strong><br>
          @endforeach
        </span>
      </div>

      <input type="submit" class="btn btn-primary col-md-12" aria-label="Left Align" value="Add category">
    </form>
  </div>
</div>
  <div class="row">
    <div class="col-md-7 col-md-offset-2">
      <h1 class="text-center">List categories</h1><br>
        <table class="table table-bordered table-striped table-hover">
          <thead>
            <tr>
              <th>#</th>
              <th>Category</th>
              <th>Author</th>
              <th>Date</th>
              <th>Edit</th>
              <th>Delete</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($categories as $category)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $category->category}}</td>
                <td>{{ $category->user->name }}</td>
                <td>{{ date('d-m-Y', strtotime($category->created_at)) }}</td>
                @if((Session::get('user'))->is_admin() || (Session::get('user'))->id == $category->user_id)
                  <td><a href="{{ route('category.edit', $category->id) }}" class="btn btn-default"><i class="fa fa-pencil" aria-hidden="true"></i></a></td>
                  <td>
                    <form action="{{ route('category.destroy', $category->id) }}" method="POST">
                      {{ csrf_field() }}
                      {{ method_field('DELETE') }}
                      <button class="btn btn-default"><i class="fa fa-trash" aria-hidden="true"></i></button>
                    </form>
                  </td>
                @else
                  <td><button class="btn btn-default disabled"><i class="fa fa-lock" aria-hidden="true"></i></button></td>
                  <td><button class="btn btn-default disabled"><i class="fa fa-lock" aria-hidden="true"></i></button></td>
                @endif
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
  </div>
@endsection
