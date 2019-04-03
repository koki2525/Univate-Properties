@extends('master')

@section('title', 'Commercial Property' )

@section('description', '')
 
@section('keywords', '')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-7 offset-md-1">
            @if($property->for=='rental')
            <h1 class="my-4">{{ $property->name }}@if($property->status2!=NULL) - {{ $property->status2 }}@endif</h1>
            @elseif($property->for=='Sale')
            <h1 class="my-4">{{ $property->name }}@if($property->status2!=NULL) - {{ $property->status2 }}@endif</h1>
            @endif
        </div>
    </div>
    <div class="row mb-4">
        <div class="col-md-7 offset-md-1">
        <div class="row">
                <div class="col-md-12">
                    <table class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr>
                                <th>Size</th>
                                <th>Price ex VAT</th>
                                <th>Suburb</th>
                                <th>Unit</th>
                                <th>Status</th>
                                <td>Ref</td>
                                <th>Interested?</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $property->size }}</td>
                                <td>R {{ number_format($property->price, 2) }}</td>
                                <td>{{ $property->surburb }}</td>
                                <td>{{ $property->unit }}</td>
                                <td>{{ $property->status2 }}</td>
                                <td>{{ $property->ref }}</td>
                                <td><a href="#interestedPropertyModal" data-toggle="modal" data-target="#interestedPropertyModal"><i class="fa fa-flag" aria-hidden="true"></i> More Info</a></td>
                            </tr>
                        </tbody>
                    </table>

                </div>
                <div class="col-md-12 mb-4">
                    <a class="btn btn-blue" href="javascript:history.back()">Back</a>
                </div>
            </div>
            <div class="row mb-4">
                @if($property->image1)
                <div class="col-md-4">
                    <img class="img-fluid mb-3 mb-md-0" src="{{ $property->image1 }}" alt="Commercial Image" />
                </div>
                @endif
                @if($property->image2)
                <div class="col-md-4">
                    <img class="img-fluid mb-3 mb-md-0" src="{{ $property->image2 }}" alt="Commercial Image" />
                </div>
                @endif
                @if($property->image3)
                <div class="col-md-4">
                    <img class="img-fluid mb-3 mb-md-0" src="{{ $property->image3 }}" alt="Commercial Image" />
                </div>
                @endif
            </div>
            
            <div class="row my-4">
                <div class="col-md-12">
                    <h2>Status : <strong>{{ $property->status2 }}</strong></h2>
                    <p>{!! $property->description !!}</p>
                </div>
            </div>
            
    
            
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                @if($property->virtualtour)
                <li class="nav-item">
                    <a class="nav-link active" id="virtual-tour-tab" data-toggle="tab" href="#virtual-tour" role="tab" aria-controls="virtual-tour" aria-selected="true">Virtual Tour</a>
                </li>
                @endif
                @if($property->directions)
                <li class="nav-item">
                    <a class="nav-link @if($property->virtualtour == null) active @endif" id="directions-tab" data-toggle="tab" href="#directions" role="tab" aria-controls="directions" aria-selected="false">Directions</a>
                </li>
                @endif
            </ul>
            <div class="tab-content mb-4" id="myTabContent">
                @if($property->virtualtour)
                <div class="tab-pane fade show active" id="virtual-tour" role="tabpanel" aria-labelledby="virtual-tour-tab">
                    <div class="embed-responsive embed-responsive-16by9">
                        <iframe class="embed-responsive-item" src="{{ $property->virtualtour }}" allowfullscreen></iframe>
                    </div>
                </div>
                @endif
                @if($property->directions)
                <div class="tab-pane fade @if($property->virtualtour == null) show active @endif" id="directions" role="tabpanel" aria-labelledby="directions-tab">
                    <iframe src="{{ $property->directions }}" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
                </div>
                @endif
            </div>
            
            <!--<div class="row">
                <div class="col-md-6">
                    <a class="btn btn-blue even-width btn-lg mb-3 mb-md-0" href="#interestedPropertyModal" data-toggle="modal" data-target="#interestedPropertyModal">Interested</a>
                </div>
                <div class="col-md-6">
                    <a class="btn btn-blue even-width btn-lg mb-3 mb-md-0" href="javascript:history.back()">Back</a>
                </div>
            </div> -->
        </div>
        <div class="col-md-3 pl-3 pl-md-5 sidebar">
            @include('partials.commercialSideBar')
        </div>
    </div>

    <!-- interested -->
    @include('partials.interested-property')

</div>
@stop