@extends('master')

@section('title', 'Lombardy Business Park' )

@section('description', '')

@section('keywords', '')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-7 offset-md-1">
            <h1 class="my-4">Lombardy Business Park</h1>
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
                                <td>Ref</td>
                                <th>Interested?</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($lombardy as $unit)
                            <tr>
                                <td>{{ $unit->size }}</td>
                                <td>R {{ number_format($unit->price, 2) }}</td>
                                <td>{{ $unit->surburb }}</td>
                                <td>{{ $unit->unit }}</td>
                                <td>{{ $unit->status2 }}</td>
                                <td>{{ $unit->ref }}</td>
                                <td><a href="/lombardy-enquiry/{{ $unit->id }}"><i class="fa fa-flag" aria-hidden="true"></i> More Info</a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <?php echo $lombardy->links(); ?>
                </div>
                <div class="col-md-12 mb-4">
                    <a class="btn btn-blue" href="javascript:history.back()">Back</a>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-md-4">
                    <img class="img-fluid" src="/images/commercial/lom1.jpg" alt="Lombardy Business Park Image1" />
                </div>
                <div class="col-md-4">
                    <img class="img-fluid" src="/images/commercial/lom2.jpg" alt="Lombardy Business Park Image2" />
                </div>
                <div class="col-md-4">
                    <img class="img-fluid" src="/images/commercial/lom3.jpg" alt="Lombardy Business Park Image3" />
                </div>
            </div>

            <div class="row my-4">
                <div class="col-md-12">
                    <p> 
                            These units are filling up quickly, so don’t miss out! Set at the centre of a bustling neighbourhood, these open spaces allow your business to choose a layout fit for your needs. The business park offers 24hr security with gated access and a back-up generator. The perfect address and office for the established professional or for the training centre of your dreams! View by appointment only.<br><br> To arrange a viewing contact Mynie: <strong>012 941 8521</strong> | <strong>076 647 1327</strong> | <a href="mailto:uvprop@oaks.co.za">uvprop@oaks.co.za</a>
                    </p>
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

@stop