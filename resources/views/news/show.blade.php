@extends('layouts.master')

@section('title', 'News categories')

@section('content')
<div class="row">
  <div class="col-md-6 col-md-offset-3">
    <h1 class="text-center">{{ $news->title }}</h1><br>
  </div>
</div>
<div class="row">
  <div class="col-md-2 col-md-offset-10">
    <h5 class="text-center">{{ $news->user->name }}</h5><br>
  </div>
</div>
<div class="row">
  <div class="col-md-2 col-md-offset-10">
    <h5 class="text-center">{{ date('d/m/Y', strtotime($news->created_at)) }}</h5><br>
  </div>
</div>
<div class="row">
  <div class="col-md-6 col-md-offset-3">
    <img src="{{ isset($news->img) ? asset('storage/'.$news->img) : asset('img/news.jpg') }}" class="img"><br>
  </div>
</div>
<div class="row">
  <div class="col-md-6 col-md-offset-3">
    {!! $news->text !!}
  </div>
</div>
@endsection


@push('css')
  <style>
    .img {
      width: 600px;
      margin-bottom: 25px;
    }
  </style>
@endpush
