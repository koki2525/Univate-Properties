@extends('master')

@section('title', 'Residential Property' )

@section('description'){{ $property->meta_Description }}@stop

@section('keywords'){{ $property->meta_Keywords }}@stop

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-7 offset-md-1">
            @if($property->for=='rental')
            <h1 class="my-4">{{ $property->name }}@if($property->status2!=NULL)@endif</h1>
            @elseif($property->for=='Sale')
            <h1 class="my-4">{{ $property->name }}@if($property->status2!=NULL)@endif</h1>
            @endif
        </div>
    </div>
    <div class="row mb-4">
        <div class="col-md-7 offset-md-1">
            <div class="row mb-4">
                @if($property->image1)
                <div class="col-md-4">
                    <img class="img-fluid mb-3 mb-md-0" src="{{ $property->image1 }}" alt="Property Image" />
                </div>
                @endif
                @if($property->image1)
                <div class="col-md-4">
                    <img class="img-fluid mb-3 mb-md-0" src="{{ $property->image2 }}" alt="Property Image" />
                </div>
                @endif
                @if($property->image1)
                <div class="col-md-4">
                    <img class="img-fluid mb-3 mb-md-0" src="{{ $property->image3 }}" alt="Property Image" />
                </div>
                @endif
            </div>
            
            <div class="row my-4">
                <div class="col-md-12">
                    <p>{!! $property->description !!}</p>
                </div>
            </div>
            
    
            @if($property->directions)
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="directions-tab" data-toggle="tab" href="#directions" role="tab" aria-controls="directions" aria-selected="false">Directions</a>
                </li>
            </ul>
            <div class="tab-content mb-4" id="myTabContent">
                <div class="tab-pane fade show active" id="directions" role="tabpanel" aria-labelledby="directions-tab">
                    <iframe src="{{ $property->directions }}" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
                </div>
            </div>
            @endif
            
            <div class="row">
                <div class="col-md-6">
                    <a class="btn btn-blue even-width btn-lg mb-3 mb-md-0" href="#interestedPropertyModal" data-toggle="modal" data-target="#interestedPropertyModal">Interested</a>
                </div>
                <div class="col-md-6">
                    <a class="btn btn-blue even-width btn-lg mb-3 mb-md-0" href="javascript:history.back()">Back</a>
                </div>
            </div>
        </div>
        <div class="col-md-3 pl-3 pl-md-5 sidebar">
            @include('partials.propertySideBar')
        </div>
    </div>

    <!-- interested -->
    @include('partials.interested-property2')

</div>
@stop