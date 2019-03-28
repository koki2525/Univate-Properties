@extends('master')

@section('title', 'Mooikloof Business Park' )

@section('description', '')

@section('keywords', '')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-7 offset-md-1">
            <h1 class="my-4">Mooikloof Business Park</h1>
        </div>
    </div>
    <div class="row">
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
                                <th>Ref</th>
                                <th>Interested?</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($mooikloof as $unit)
                            <tr>
                                <td>{{ $unit->size }}</td>
                                <td>{{ $unit->price }}</td>
                                <td>{{ $unit->surburb }}</td>
                                <td>{{ $unit->unit }}</td>
                                <td>{{ $unit->status2 }}</td>
                                <td>{{ $unit->ref }}</td>
                                <td><a href="/mooikloof-enquiry/{{ $unit->id }}"><i class="fa fa-flag" aria-hidden="true"></i> Enquire Now</a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <?php echo $mooikloof->links(); ?>
                </div>
                <div class="col-md-12 mb-4">
                    <a class="btn btn-blue" href="javascript:history.back()">Back</a>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-md-4">
                    <img class="img-fluid" src="/images/commercial/mk1.jpg" alt="Mooikloof Business Park Image1" />
                </div>
                <div class="col-md-4">
                    <img class="img-fluid" src="/images/commercial/mk2.jpg" alt="Mooikloof Business Park Image2" />
                </div>
                <div class="col-md-4">
                    <img class="img-fluid" src="/images/commercial/mk3.jpg" alt="Mooikloof Business Park Image3" />
                </div>
            </div>

            <div class="row my-4">
                <div class="col-md-12">
                    <p> One of the best locations for businesses in the East of Pretoria. This neat, well maintained, secure office park has an office available in Building 2 on the ground floor. Mooikloof Office Park provides tenants with a secure and calm working environment within the East of Pretoria. The beautiful big windows look out onto green pastures, allowing the office space to feel open and spacious. Connectivity and telephone systems are available, so your office can be operational almost immediately. CCTC cameras add extra security to keep you and your employees safe. This Unit is air-conditioned and wheel-chair friendly. Available: Immediately.</p>
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
        </div>
        
        <div class="col-md-3 pl-3 pl-md-5 sidebar">
            @include('partials.sidebar2')
        </div>
    </div>
</div>

<!-- interested -->
@include('partials.interestedMooikloof')

@stop