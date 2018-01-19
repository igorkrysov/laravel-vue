@extends('layouts.master')

@section('title', 'News categories')

@section('content')
<div class="row">
  <div class="col-md-6 col-md-offset-3">
    <h1 class="text-center">Add news</h1><br>
    <form method="post" action="{{ route('category.store') }}">
      {{ csrf_field() }}

      <div class="form-group {!! ($errors->has('category') ? 'has-error' : '') !!}">
        <label for="category">Category:</label>
        <input type="text" class="form-control Error" id="category" name="category" placeholder="Enter category" value="{{ old('category') }}">
        <input type="hidden" class="form-control Error" id="user_id" name="user_id" value="{{ (Session::get('user'))->id }}">

        <div class="form-group">
          <label for="group_id">Category:</label>
          <select class="form-control" id="category_id" name="category_id">
            @foreach ($categories as $category)
              <option value="{{ $category->id }}" {!! (old('category_id') == $category->id) ? 'selected' : '' !!}>{{ $category->category }}</option>
            @endforeach
          </select>
        </div>

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

@endsection
