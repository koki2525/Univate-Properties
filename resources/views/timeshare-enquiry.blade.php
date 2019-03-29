@extends('master')

@section('title', 'Timeshare Enquiry')

@section('description', 'Uni-Vate Properties is a reputable and reliable timeshare reseller, equipped with the best experience and knowledge in providing customers of fast, efficient and personal service.')

@section('keywords', 'Timeshare selling, where to sell my timeshare, Uni-Vate Properties, Uni-Vate timeshare, timeshare for sale, tender weeks available, sell my tender week')

@section('content')
<div class="container">

    <div class="row mb-4">
        <div class="col-md-12">
            <h1 class="my-4">{{ $timeshare->resort }}</h1>
        </div>
        <div class="col-md-6">
            <p>
                {!! $resort->information !!}
            </p>
        </div>
        <div class="col-md-6">
            <form id="mainForm" method="POST" action="/interested-timeshare/{{ $timeshare->id }}" accept-charset="UTF-8" enctype="multipart/form-data">
            @csrf
                <input id="resort" type="hidden" value="{{ $timeshare->resort }}">
                 <div class="form-row">
                    <div class="col-md-6">
                        <label for="resortName">Unit</label>
                        <input class="form-control" type="text" id="resort" name="resortName" value="{{ $timeshare->unit }}" disabled>
                    </div>
                    <div class="col-md-6">
                        <label for="resortWeek">Week</label>
                        <input class="form-control" type="text" id="week" name="resortWeek" value="{{ $timeshare->week }}" disabled>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-6">
                        <label for="resortModule">Module</label>
                        <input class="form-control" type="text" id="module" name="resortModule" value="{{ $timeshare->module }}" disabled>
                    </div>
                    <div class="col-md-6">
                        <label for="price">Price</label>
                        <input class="form-control" type="text" name="price" id="price" value="R {{ number_format($timeshare->price, 2) }}" disabled>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-6">
                        <label for="resortModule">Current Year Levy</label>
                        <input class="form-control" type="text" id="module" name="levy" value="R {{ number_format($timeshare->levy, 2) }}" disabled>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-12">
                        <input class="form-control" type="text" name="name" placeholder="Name">
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-12">
                        <input class="form-control" type="text" name="mobile" placeholder="Contact Number">
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-12">
                        <input class="form-control" type="email" name="email" placeholder="Email">
                    </div>
                </div>

                <button class="btn btn-blue even-width mr-auto" id="submit" type="submit">ENQUIRE NOW</button>
                @if(Auth::check())
                <a class="btn btn-blue even-width mr-auto" href="/share-transfer-initiation-for-purchaser/{{ $timeshare->id }}">MAKE AN OFFER</a>
                @else
                <a class="btn btn-blue even-width mr-auto" href="#" data-toggle="modal" data-target="#loginModal">MAKE AN OFFER</a>
                @endif
                <a class="btn btn-blue even-width mr-auto" href="javascript:history.back()">BACK</a>
            </form>
        </div>
    </div>
    <div class="row mb-4">
        <div class="col-md-4">
            <img class="img-fluid" src="{{ $resort->image1 }}" alt="Resort Image" />
        </div>
        <div class="col-md-4">
            <img class="img-fluid" src="{{ $resort->image2 }}" alt="Resort Image" />
        </div>
        <div class="col-md-4">
            <img class="img-fluid" src="{{ $resort->image3 }}" alt="Resort Image" />
        </div>
    </div>

</div>
@stop
