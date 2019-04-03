@extends('master')

@section('title', 'Mooikloof Enquiry')

@section('description', 'Uni-Vate Properties is a reputable and reliable timeshare reseller, equipped with the best experience and knowledge in providing customers of fast, efficient and personal service.')

@section('keywords', 'Timeshare selling, where to sell my timeshare, Uni-Vate Properties, Uni-Vate timeshare, timeshare for sale, tender weeks available, sell my tender week')

@section('content')
<div class="container">

    <div class="row mb-4">
        <div class="col-md-12">
            <h1 class="my-4">{{ $unit->name }}</h1>
        </div>
        <div class="col-md-6">
            {!! $unit->description !!}
        </div>
        <div class="col-md-6">
            <form id="mainForm" method="POST" action="/mooikloof-enquiry/{{ $unit->id }}" accept-charset="UTF-8" enctype="multipart/form-data">
            @csrf
                 <div class="form-row">
                    <div class="col-md-6">
                        <lable for="unit">Unit</lable>
                        <input class="form-control" type="text" id="unit" name="unit" value="{{ $unit->unit }}" disabled>
                    </div>
                    <div class="col-md-6">
                        <lable for="resortWeek">Price</lable>
                        <input class="form-control" type="text" id="price" name="price" value="{{ number_format($unit->price, 2) }}" disabled>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-6">
                        <lable for="module">Size</lable>
                        <input class="form-control" type="text" id="size" name="size" value="{{ $unit->size }}" disabled>
                    </div>
                    <div class="col-md-6">
                        <lable for="price">Suburb</lable>
                        <input class="form-control" type="text" name="surburb" id="surburb" value="{{ $unit->surburb }}" disabled>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-12">
                        <input class="form-control" type="text" name="name" placeholder="Name">
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-12">
                        <input class="form-control" type="text" id="mobile" name="mobile" placeholder="Contact Number">
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-12">
                        <input class="form-control" type="email" name="email" placeholder="Email">
                    </div>
                </div>

                <button class="btn btn-blue even-width mr-auto" id="submit" type="submit">ENQUIRE NOW</button>
                <a class="btn btn-blue even-width mr-auto" href="javascript:history.back()">BACK</a>
            </form>
        </div>
    </div>
    <div class="row mb-4">
        <div class="col-md-4">
            <img class="img-fluid" src="{{ $unit->image1 }}" alt="Resort Image" />
        </div>
        <div class="col-md-4">
            <img class="img-fluid" src="{{ $unit->image2 }}" alt="Resort Image" />
        </div>
        <div class="col-md-4">
            <img class="img-fluid" src="{{ $unit->image3 }}" alt="Resort Image" />
        </div>
    </div>
        
</div>
@stop