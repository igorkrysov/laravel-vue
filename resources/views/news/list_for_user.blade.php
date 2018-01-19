@extends('layouts.master')

@section('title', 'News categories')

@section('content')
<div class="row">
  <div class="col-md-10 col-md-offset-1">
    <div class="row">
      <div class="col-md-12">
        <div class="form-inline">
          <input type="text" placeholder="Search" id="search" name="seach" class="form-control">
          <button class="btn btn-default"><i class="fa fa-search" aria-hidden="true"></i></button>

          <select name="" id="" class="form-control">
            <option value="1" selected>Gategory1</option>
            <option value="2">Gategory2</option>
          </select>
          <label><input type="checkbox" value="" class="form-check-input checkbox-primary">Only with photoes</label>
          <div class="form-group">
            <label for="sort">Sort by: </label>
            <select name="sort" id="sort" class="form-control">
              <option value="1" selected>Date Up</option>
              <option value="2">Date Down</option>
              <option value="3">Alphabet Up</option>
              <option value="4">Alphabet Down</option>
            </select>
          </div>


          </div>

        </div>

      </div>
    </div>

    <div class="row news">
      <div class="col-md-12">
        <div class="row new">
          <div class="col-md-12 ">
            <div class="row">
               <div class="col-md-3">
                 <img src="spacex.jpg" class="preview" alt="">
               </div>
               <div class="col-md-9">
                 <div class="row">
                   <div class="col-md-12">
                     <h2 class="tite-new-preview">Title 1</h2>
                   </div>
                 </div>
                 <div class="row">
                   <div class="col-md-12">
                     @php
                      $str = "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Molestiae optio, perferendis et. Provident qui voluptatem, culpa eos sequi voluptatum quibusdam commodi iure vel, laudantium similique eveniet excepturi nihil maiores accusantium numquam rerum enim explicabo, modi odio ullam, adipisci illo quo minima! Molestias asperiores, beatae delectus ad illo dicta optio adipisci molestiae a perferendis, accusamus eligendi atque dolorem officia minus, quas magni quasi voluptas consectetur vero enim!";
                     @endphp

                     {{ substr($str,0,498) }}
                     <span>
                       ... <a href="#">read more</a>
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
                <h5 class="text-left addtion-information">Author: <span style="font-style:italic">Igor Krysov<span></h5>
              </div>
              <div class="col-md-8">
                <h5 class="text-right addtion-information">Date:  <span style="font-style:italic">11/11/2012</span></h5>
              </div>

            </div>
          </div>
        </div>

      <div class="row">
        <div class="col-md-12">
          <ul class="pagination list-inline">
            <li><a href="#">First</a></li>
            <li><a href="#">Back</a></li>
            <li><a href="#">1</a></li>
            <li class="active"><a href="#">2</a></li>
            <li><a href="#">3</a></li>
            <li><a href="#">4</a></li>
            <li><a href="#">5</a></li>
            <li><a href="#">Next</a></li>
            <li class="disabled"><a href="#">Last(936)</a></li>
          </ul>
        </div>
      </div>
    </div>

  </div>
@endsection

@push('css')
  <link href="{{ asset('css/news.css') }}" rel="stylesheet">
@endpush
