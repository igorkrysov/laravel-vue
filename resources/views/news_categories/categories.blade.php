@extends('layouts.master')

@section('title', 'News categories')
@section('content')
  <Category></Category>
@endsection

@push("scripts")
  <script src="{{ asset('js/app.js') }}"></script>
@endpush
