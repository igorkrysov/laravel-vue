@extends('layouts.master')

@section('title', 'Login')

@section('content')
  <Document></Document>
@endsection


@push("scripts")
  <script src="{{ asset('js/app.js') }}"></script>
@endpush
