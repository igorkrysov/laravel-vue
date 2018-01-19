@extends('layouts.master')

@section('title', 'Edit new')

@section('content')
  <div class="row">
    <div class="col-md-6 col-md-offset-2">
      <h1 class="text-center">Edit news</h1><br>
      <form class="" action="{{ route('news.update', $news->id) }}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        {{ method_field('PATCH') }}

        <input type="hidden" class="form-control Error" id="user_id" name="user_id" value="{{ (Session::get('user'))->id }}">

        <div class="form-group">
          <label for="group_id">Category of news:</label>

          <select class="form-control" id="category_id" name="category_id">
            @foreach ($categories as $category)
              <option value="{{ $category->id }}" {!! ($news->category_id == $category->id) ? 'selected' : '' !!}>{{ $category->category }}</option>
            @endforeach
          </select>
        </div>

        <div class="form-group {!! ($errors->has('title') ? 'has-error' : '') !!}">
          <label for="title">Title:</label>
          <input type="text" class="form-control" id="title" name="title" placeholder="Enter title" value="{{ $news->title }}">
          <span class="help-block">
            @foreach ($errors->get('title') as $title)
                <strong>{{ $title }}</strong><br>
            @endforeach
          </span>
        </div>
        <div class="form-group {!! ($errors->has('text') ? 'has-error' : '') !!}">
          <label for="text">Text:</label>
          <textarea name="text" id="text" class="form-control">{{ $news->text }}</textarea>

          <span class="help-block">
            @foreach ($errors->get('text') as $text)
                <strong>{{ $text }}</strong><br>
            @endforeach
          </span>
        </div>

        <div class="form-group {!! ($errors->has('img') ? 'has-error' : '') !!}">
          <label for="attach">Attach Image:</label>
          <input type="file" class="form-control" id='attach' name='attach' accept=".jpg,.png,.jpeg">


          <span class="help-block">
            @foreach ($errors->get('attach') as $attach)
                <strong>{{ $attach }}</strong><br>
            @endforeach
          </span>
        </div>

        <input type="submit" value="Update" class="btn btn-primary col-md-12">
      </form>
    </div>
  </div>
@endsection

@push("scripts")
  <script src="https://cdn.ckeditor.com/4.8.0/standard/ckeditor.js"></script>
  <script>
			CKEDITOR.replace( 'text' );
	</script>
@endpush
