@extends('master')

@section('title', 'Little Eden')

@section('description', '')

@section('keywords', '')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-7 offset-md-1">
            <h1 class="my-4">Little Eden</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-7 offset-md-1">
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr>
                                <th><span>Resort</span></th>
                                <th><span>Unit Number</span></th>
                                <th><span>Week Number</span></th>
                                <th><span>Module</span></th>
                                <th><span>Bedrooms</span></th>
                                <th><span>Season</span></th>
                                <th><span>Price</span></th>
                                <th><span>Status</span></th>
                                <th><span>Interested</span></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($timeshares as $timeshare)
                            <tr>
                                <td class="lalign">{{ $timeshare->resort }}</td>
                                <td>{{ $timeshare->unit }}</td>
                                <td>{{ $timeshare->week }}</td>
                                <td>{{ $timeshare->module }}</td>
                                <td>{{ $timeshare->bedrooms }}</td>
                                <td>{{ $timeshare->season }}</td>
                                <td>R {{ $timeshare->setPrice }}</td>
                                <td>{{ $timeshare->status }}</td>
                                <td><a href="#interestedModal/{{ $timeshare->id }}" data-toggle="modal" data-target="#interestedModal"><i class="fa fa-flag" aria-hidden="true"></i></a></td>
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
                    <img class="img-fluid" src="{{ $resort->image1 }}" alt="Resort Image" />
                </div>
            </div>

            <div class="row my-4">
                <div class="col-md-12 mb-4">
                    <p>{{ $resort->information }}</p>
                    <p><a href="#" target="_blank">www.example.com</a></p>
                </div>
                @if($resort->advisor!=NULL)
                <div class="col-md-12 mb-4">
                    <a href="{{ $resort->advisor }}" target="_blank">
                        <img class="img-fluid" src="/images/awards/2018_COE_Logos_white-bkg_translations_en-US-UK.JPG" alt="Awards" />
                    </a>     
                </div>
                @endif

                @foreach($awards as $award)

                    @if($award=='Gold Crown')
                    <div class="col-md-12 mb-4">
                        <img class="img-fluid" src="/images/awards/2011-Gold-Crown-Logo.png" alt="Awards" />
                    </div>
                    @endif
                    @if($award=='RCI Hospitality')
                        @if($resort->advisor!=NULL)
                        <div class="col-md-12 mb-4">
                            <img class="img-fluid" src="/images/awards/RCI_hospitality.jpg" alt="Awards" />
                        </div>

                        @else
                        <div class="col-md-12 mb-4">
                            <img class="img-fluid" src="/images/awards/RCI_hospitality.jpg" alt="Awards" />
                        </div>
                        @endif
                    @endif
                    @if($award=='Silver Crown')
                    <div class="col-md-12 mb-4">
                        <img class="img-fluid" src="/images/awards/2011 Silver Crown Logo.png" alt="Awards" />
                    </div>
                    @endif

                @endforeach
            </div>

            <div class="row">
                <div class="col-md-12 mb-4">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="directions-tab" data-toggle="tab" href="#directions" role="tab" aria-controls="directions" aria-selected="false">Directions</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="resort-layout-tab" data-toggle="tab" href="#resort-layout" role="tab" aria-controls="resort-layout" aria-selected="true">Resort Layout</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="directions" role="tabpanel" aria-labelledby="directions-tab">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3598.84482660366!2d28.57348355078195!3d-25.576828844892443!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1e955632ffc327ff%3A0x4af94419c97e91ff!2sLittle+Eden+Resort!5e0!3m2!1sen!2sza!4v1538397512607" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
                        </div>
                        <div class="tab-pane fade" id="resort-layout" role="tabpanel" aria-labelledby="resort-layout-tab">
                            <img class="img-fluid" src="/images/resort_layouts/little-eden.jpg" alt="Resort Layout" />
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
@stop

<!-- interested -->
@include('partials.interested')