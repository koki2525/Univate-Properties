@extends('master')

@section('title', 'Resort' )

@section('description', '{{ $resort->meta_Description }}')

@section('keywords', '{{ $resort->meta_Keywords }}')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-7 offset-md-1">
            <h1 class="my-4">{{ $resort->resort }}</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-7 offset-md-1">
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr>
                                <th><span>Unit</span></th>
                                <th><span>Week</span></th>
                                <th><span>Module</span></th>
                                <th><span>Bedrooms</span></th>
                                <th><span>Season</span></th>
                                <th><span>Price ex VAT</span></th>
                                <th><span>Status</span></th>
                                <th><span>Interested?</span></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($timeshares as $timeshare)
                            <tr>
                                <td>{{ $timeshare->unit }}</td>
                                <td>{{ $timeshare->week }}</td>
                                <td>{{ $timeshare->module }}</td>
                                <td>{{ $timeshare->bedrooms }}</td>
                                <td>{{ $timeshare->season }}</td>
                                <td>R{{ $timeshare->setPrice }}</td>
                                <td>{{ $timeshare->status }}</td>
                                <td><a href="#interestedModal/{{ $timeshare->id }}" data-toggle="modal" data-target="#interestedModal"><i class="fa fa-flag" aria-hidden="true"></i> Enquire Now</a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <?php echo $timeshares->links(); ?>
                </div>
                <div class="col-md-12 mb-4">
                    <a class="btn btn-blue" href="/to-buy">Back to Regions</a>
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

            <div class="row my-4">
                <div class="col-md-12">
                    <p>{!! $resort->information !!}</p>
                    @if($resort->url!=NULL)
                    <p class="mb-0"><a href="http://{{ $resort->url }}" target="_blank">{{ $resort->url }}</a></p>
                    @endif
                </div>
            </div>
                
            <div class="row mb-5">
                @if($resort->advisor!=NULL)
                <div class="col-md-3 mb-4 mb-md-0">
                    <a href="{{ $resort->advisor }}" target="_blank">
                        <img class="img-fluid" src="/images/awards/2018_COE_Logos_white-bkg_translations_en-US-UK.JPG" alt="Awards" />
                    </a>     
                </div>
                @endif
                
                @foreach($awards as $award)

                <div class="col-md-3 mb-4 mb-md-0">
                @if($award=='Gold Crown')
                    <img class="img-fluid" src="/images/awards/2011-Gold-Crown-Logo.png" alt="Awards" />
                @endif
                @if($award=='RCI Hospitality')
                    @if($resort->advisor!=NULL)
                        <img class="img-fluid" src="/images/awards/RCI_hospitality.jpg" alt="Awards" />

                    @else
                        <img class="img-fluid" src="/images/awards/RCI_hospitality.jpg" alt="Awards" />
                    @endif
                @endif
                @if($award=='Silver Crown')
                    <img class="img-fluid" src="/images/awards/2011 Silver Crown Logo.png" alt="Awards" />
                @endif
                </div>

                @endforeach
            </div>

            <div class="row">
                <div class="col-md-12 mb-4">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="directions-tab" data-toggle="tab" href="#directions" role="tab" aria-controls="directions" aria-selected="false">Directions</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="resort-layout-tab" data-toggle="tab" href="#resort-layout" role="tab" aria-controls="resort-layout" aria-selected="true">Resort Lay-Out</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="directions" role="tabpanel" aria-labelledby="directions-tab">
                            <iframe src="{{ $resort->map }}" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
                        </div>
                        <div class="tab-pane fade" id="resort-layout" role="tabpanel" aria-labelledby="resort-layout-tab">
                            <img class="img-fluid" src="{{ $resort->layout }}" alt="Resort Layout" />
                            <p class="mt-3"><a href="{{ $resort->layout }}" target="_blank">Download Resort Lay-Out</a></p>
                        </div>
                    </div>
                </div> 
            </div>
        </div>
        <div class="col-md-3 pl-3 pl-md-5 sidebar">
            @include('partials.sidebar')
        </div>
    </div>
</div>

<!-- interested -->
@include('partials.interested')

@stop