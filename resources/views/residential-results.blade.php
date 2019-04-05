@extends('master')

@section('title', 'Residential search results' )

@section('description', '')

@section('keywords', '')

@section('content')
<div class="container mb-4">
    <div class="row">
        <div class="col-md-12">
            @if($for=='rental')
            <h1 class="my-4">Residential Properties To Rent</h1><br>
            @elseif($for=='Sale')
            <h1 class="my-4">Residential Properties For Sale</h1><br>
            @endif
        </div>
    </div>

    @if($residentials!=NULL)
        @foreach($residentials as $residential)

        <div class="row mb-4">
            <div class="col-md-3">
                <a href="/residential-property/{{ $residential->id }}">
                    <img class="img-fluid" src="{{ $residential->image1 }}" alt="{{ $residential->name }}"> 
                </a>   
            </div>
            <div class="col-md-6">
                <h2>{{ $residential->name }}</h2>
                <h4>Price R {{ number_format($residential->price, 2) }}</h4>
                <p class="description">{{ $residential->intro }}</p>
            </div>
            <div class="col-md-3 text-center d-flex justify-content-center flex-column">
                <a href="/residential-property/{{ $residential->id }}"><button class="btn btn-blue btn-lg">View Details</button></a>
            </div>
        </div>
        <hr>
        @endforeach
    @endif

    <div class="row">
        <div class="col-md-12">
            <a href="/residential"><button class="btn btn-blue btn-lg">Back</button></a>
        </div>
    </div>
</div>
@stop