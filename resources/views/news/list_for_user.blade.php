@extends('layouts.master')

@section('title', 'News categories')

@section('content')
<div class="row">
  <div class="col-md-10 col-md-offset-1">
    <div class="row">
      <div class="col-md-12">
        <div class="form-inline">
          <form class="" id="filter" action="{{ route('news.index') }}" method="get">
            <input type="text" placeholder="Search" id="search" name="search" class="form-control" value="{{ Request::get('search') }}">
            <button class="btn btn-default" id="find"><i class="fa fa-search" aria-hidden="true"></i></button>
            <div class="form-group">
              <label for="category">Category: </label>
              <select name="category" id="category" class="form-control">
                <option value="0" selected>All</option>
                @foreach($categories as $category)
                  <option value="{{ $category->id }}" {{ (Request::get('category') == $category->id) ? 'selected' : '' }}>{{ $category->category }}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label for="sort">Sort by: </label>

              <select name="sortby" id="sortby" class="form-control">
                <option value="dateup" {{ (Request::get('sortby') == "dateup") ? 'selected' : '' }}>Date Up</option>
                <option value="datedown" {{ (Request::get('sortby') == "datedown") ? 'selected' : '' }}>Date Down</option>
                <option value="titleup" {{ (Request::get('sortby') == "titleup") ? 'selected' : '' }}>Alphabet Up</option>
                <option value="titledown" {{ (Request::get('sortby') == "titledown") ? 'selected' : '' }}>Alphabet Down</option>
              </select>

            </div>

            <label>
              <input type="checkbox" name="onlyphoto" id="onlyphoto" value="1" {{ (Request::get('onlyphoto') == "1") ? 'checked' : '' }}>
              <span class="checkbox-custom"></span>
              Only with photoes
            </label>
          </form>

        </div>
      </div>
    </div>
  </div>

    <div class="row">
      <div class="col-md-12 news">
        @foreach($list_news as $news)
        <div class="row new">
          <div class="col-md-12 ">
            <div class="row">
              <div class="col-md-12 category">
                <h5 class="text-left addtion-information">Category: <span style="font-style:italic">: {{ $news->category->category }}</span></h5>
              </div>
            </div>
            <div class="row">
               <div class="col-md-3 col-xs-3 col-sm-3 col-md-offset-0 col-xs-offset-4 col-sm-offset-4">
                 <img src="{{ isset($news->img) ? asset('storage/'.$news->img) : 'img/news.jpg' }}" class="preview" alt="">
               </div>
               <div class="col-md-9 col-xs-12 col-sm-12">
                 <div class="row">
                   <div class="col-md-12">
                     <h2 class="tite-new-preview">{{ $news->title }}</h2>
                   </div>
                 </div>
                 <div class="row">
                   <div class="col-md-12">
                     {!! substr($news->text,0,498) !!}
                     <span>
                       ... <a href="{{ route('news.show', $news->id) }}">read more</a>
                     </span>
                   </div>
                 </div>
                 <div class="row">
                   <div class="col-md-12">

                   </div>
                 </div>
               </div>
            </div>
            <div class="row">
              <div class="col-md-4">
                <h5 class="text-left addtion-information">Author: <span style="font-style:italic">{{ $news->user->name }}<span></h5>
              </div>
              <div class="col-md-8">
                <h5 class="text-right addtion-information">Date:  <span style="font-style:italic">{{ date("d/m/Y", strtotime($news->created_at)) }}</span></h5>
              </div>

            </div>
          </div>
        </div>
        @endforeach

      <div class="row">
        <div class="col-md-12">
          <div class="text-center" id="paginator">
            {{ $list_news->links() }}
          </div>
        </div>
      </div>
    </div>

  </div>
@endsection

@push('css')
  <link href="{{ asset('css/news.css') }}" rel="stylesheet">
@endpush

@push('scripts')
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>

<script>
  $(document).ready(function(){
    $('#sortby').on('change', function() {
      $( "form#filter" ).submit();
    });

    $('#category').on('change', function() {
      $( "form#filter" ).submit();
    });

    $('#onlyphoto').on('change', function() {
      $( "form#filter" ).submit();
    });

    $('button#find').on('click', function( event ) {
       $( "form#filter" ).submit();
    });

  });
</script>
@endpush
