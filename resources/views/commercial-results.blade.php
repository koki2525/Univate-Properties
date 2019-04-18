@extends('master')

@section('title', 'Commercial Results' )

@section('content')
<div class="container mb-4">
    <div class="row">
        <div class="col-md-12">
            @if($for=='rental')
            <h1 class="my-4">Commercial Properties To Rent</h1><br>
            @elseif($for=='Sale')
            <h1 class="my-4">Commercial Properties For Sale</h1><br>
            @endif
        </div>
    </div>

    @if($commercials!=NULL)
    @foreach($commercials as $commercial)
    @if($commercial->name=='Lombardy Business Park')
            <div class="row mb-4">
            <div class="col-md-3">
                <a href="/lombardy">
                    <img class="img-fluid" src="/images/commercial_rentals/lombardy1.jpg" alt="Lombardy"> 
                </a>   
            </div>
            <div class="col-md-6">
                <h2>{{ $commercial->name }}</h2>
                <p class="description">{{ $commercial->intro }}</p>
            </div>
            <div class="col-md-3 text-center d-flex justify-content-center flex-column">
                <a href="/lombardy"><button class="btn btn-blue btn-lg">View Details</button></a>
            </div>
        </div>
        <hr>
        @elseif($commercial->name=='Mooikloof Office Park')
        <div class="row mb-4">
            <div class="col-md-3">
                <a href="/mooikloof">
                    <img class="img-fluid" src="/images/commercial_rentals/mooikloof1.jpg" alt="Mooikloof"> 
                </a>   
            </div>
            <div class="col-md-6">
                <h2>{{ $commercial->name }}</h2>
                <p class="description">{{ $commercial->intro }}</p>
            </div>
            <div class="col-md-3 text-center d-flex justify-content-center flex-column">
                <a href="/mooikloof"><button class="btn btn-blue btn-lg">View Details</button></a>
            </div>
        </div>
        <hr>
        @else
            <div class="row mb-4">
            <div class="col-md-3">
                <a href="/commercial-property/{{ $commercial->id }}">
                    <img class="img-fluid" src="{{ $commercial->image1 }}"> 
                </a>   
            </div>
            <div class="col-md-6">
                <h2>{{ $commercial->name }}</h2>
                <p class="description">{{ $commercial->intro }}</p>
            </div>
            <div class="col-md-3 text-center d-flex justify-content-center flex-column">
                <a href="/commercial-property/{{ $commercial->id }}"><button class="btn btn-blue btn-lg">View Details</button></a>
            </div>
        </div>
        @endif
    @endforeach
    @endif

    <div class="row">
        <div class="col-md-12">
            <a href="/commercial"><button class="btn btn-blue btn-lg">Back</button></a>
        </div>
    </div>
</div>
@stop