@extends('master')

@section('title', 'Welcome')

@section('description', '')

@section('keywords', '')

@section('content')
<div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="{{ asset('/images/home-banner.jpg') }}"  class="d-block w-100" alt="Home Banner">
        </div>
    </div>
</div>
@stop