@extends('layouts.master')

@section('title', 'News categories')

@section('content')
  <div class="row">
    <div class="col-md-4 col-md-offset-4">
      <h1 class="text-center">Edit category</h1><br>
      <form class="" action="{{ route('category.update', $category->id) }}" method="post">
        {{ csrf_field() }}
        {{ method_field('PATCH') }}

        <div class="form-group {!! ($errors->has('category') ? 'has-error' : '') !!}">
          <label for="category">Category:</label>
          <input type="text" class="form-control" id="category" name="category" placeholder="Enter category" value="{{ $category->category }}">
          <span class="help-block">
            @foreach ($errors->get('category') as $category)
                <strong>{{ $category }}</strong><br>
            @endforeach
          </span>
        </div>

        <input type="submit" value="Update" class="btn btn-primary col-md-12">
      </form>
    </div>
  </div>
@endsection
