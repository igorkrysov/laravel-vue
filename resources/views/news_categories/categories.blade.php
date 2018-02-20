@extends('layouts.master')

@section('title', 'News categories')
@section('content')
  <Category ref="foo"></Category>
@endsection

@push("scripts")
  <script src="{{ asset('js/app.js') }}"></script>
@endpush
