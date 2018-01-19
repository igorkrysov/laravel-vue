@extends('layouts.master')

@section('title', 'News categories')

@section('content')
  <div class="row">
    <div class="col-md-6 col-md-offset-3">
      <h1 class="text-center">List news</h1><br>
        <table class="table table-bordered table-striped table-hover">
          <thead>
            <tr>
              <th>#</th>
              <th>Title</th>
              <th>news</th>
              <th>Author</th>
              <th>category</th>
              <th>Date</th>
              <th>img</th>
              <th>Edit</th>
              <th>Delete</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($news as $new)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $new->title}}</td>
                <td>{!! $new->text !!}</td>
                <td>{{ $new->user->name }}</td>
                <td>{{ $new->category->category }}</td>
                <td>{{ date('d-m-Y', strtotime($new->created_at)) }}</td>
                <td>{{ $new->img }}</td>
                @if((Session::get('user'))->is_admin() || (Session::get('user'))->id == $new->user_id)
                  <td><a href="{{ route('news.edit', $new->id) }}" class="btn btn-default"><i class="fa fa-pencil" aria-hidden="true"></i></a></td>
                  <td>
                    <form action="{{ route('news.destroy', $new->id) }}" method="POST">
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
