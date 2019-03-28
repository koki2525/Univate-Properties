@extends('master')

@section('title', 'To Buy')

@section('description', 'Uni-Vate Properties provides a reliable platform from which to advertise and purchase tender weeks within the timeshare industry.')

@section('keywords', 'Timeshare buying, where to buy timeshare, Uni-Vate Properties, Uni-Vate timeshare, timeshare to buy, tender weeks available, purchase a tender week')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1 class="my-4">To Buy</h1>
            <p>
                The resorts have been listed in their relevant provinces. Please select the resort for which you would like to view the available weeks and then select the weeks that interest you on the resort page.
            </p>
            
            <p>Arrival and departure dates are indicated but please note that these dates may vary annually.</p>
 
            <p>As with any property related sale, upon purchasing the holiday of your choice, there will be a transfer fee payable for the change of ownership. This fee will depend on the relevant resort or managing agent.</p>
        
        </div>
    </div>
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="accordion" id="accordionExample">
                @if($gauteng->isEmpty())
                @else
                <div class="card">
                    <a class="btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        <div class="card-header" id="headingOne">
                            <h2 class="mb-0">
                                Gauteng
                            </h2>
                        </div>
                    </a>

                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                        <div class="card-body">
                            <p class="mb-0">
                                @foreach($gauteng as $resort)
                                    <a class="text-capitalize" href="/resort/{{ $resort->slug }}"> - {{  $resort->resort }}</a><br/>
                                @endforeach
                            </p>
                        </div>
                    </div>
                </div>
                @endif
                @if($westerncape->isEmpty())
                @else
                <div class="card">
                    <a class="btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        <div class="card-header" id="headingTwo">
                            <h2 class="mb-0">
                                Western Cape
                            </h2>
                        </div>
                    </a>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                        <div class="card-body">
                            <p class="mb-0">
                                @foreach($westerncape as $resort)
                                    <a class="text-capitalize" href="/resort/{{ $resort->slug }}"> - {{ $resort->resort }}</a><br/>
                                @endforeach
                            </p>
                        </div>
                    </div>
                </div>
                @endif
                @if($limpopo->isEmpty())
                @else
                <div class="card">
                    <a class="btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        <div class="card-header" id="headingThree">
                            <h2 class="mb-0">
                                Limpopo
                            </h2>
                        </div>
                    </a>
                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                        <div class="card-body">
                            <p class="mb-0">
                                @foreach($limpopo as $resort)
                                    <a class="text-capitalize" href="/resort/{{ $resort->slug }}"> - {{ $resort->resort }}</a><br/>
                                @endforeach
                            </p>
                        </div>
                    </div>
                </div>
                @endif
                @if($kwazulunatal->isEmpty())
                @else
                <div class="card">
                    <a class="btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                        <div class="card-header" id="headingFour">
                            <h2 class="mb-0">
                                Kwazulu Natal
                            </h2>
                        </div>
                    </a>
                    <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionExample">
                        <div class="card-body">
                            <p class="mb-0">
                                @foreach($kwazulunatal as $resort)
                                    <a class="text-capitalize" href="/resort/{{ $resort->slug }}"> - {{ $resort->resort }}</a><br/>
                                @endforeach
                            </p>
                        </div>
                    </div>
                </div>
                @endif
                @if($northerncape->isEmpty())
                @else
                <div class="card">
                    <a class="btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                        <div class="card-header" id="headingFive">
                            <h2 class="mb-0">
                                Northern Cape
                            </h2>
                        </div>
                    </a>
                    <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordionExample">
                        <div class="card-body">
                            <p class="mb-0">
                                @foreach($northerncape as $resort)
                                    <a class="text-capitalize" href="/resort/{{ $resort->slug }}"> - {{ $resort->resort }}</a><br/>
                                @endforeach
                            </p>
                        </div>
                    </div>
                </div>
                @endif
                @if($mpumalanga->isEmpty())
                @else
                <div class="card">
                    <a class="btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                        <div class="card-header" id="headingSix">
                            <h2 class="mb-0">
                                Mpumalanga
                            </h2>
                        </div>
                    </a>
                    <div id="collapseSix" class="collapse" aria-labelledby="headingSix" data-parent="#accordionExample">
                        <div class="card-body">
                            <p class="mb-0">
                                @foreach($mpumalanga as $resort)
                                    <a class="text-capitalize" href="/resort/{{ $resort->slug }}"> - {{ $resort->resort }}</a><br/>
                                @endforeach
                            </p>
                        </div>
                    </div>
                </div>
                @endif
                @if($northwest->isEmpty())
                @else
                <div class="card">
                    <a class="btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                        <div class="card-header" id="headingSeven">
                            <h2 class="mb-0">
                                North West
                            </h2>
                        </div>
                    </a>
                    <div id="collapseSeven" class="collapse" aria-labelledby="headingSeven" data-parent="#accordionExample">
                        <div class="card-body">
                            <p class="mb-0">
                                @foreach($northwest as $resort)
                                    <a class="text-capitalize" href="/resort/{{ $resort->slug }}"> - {{ $resort->resort }}</a><br/>
                                @endforeach
                            </p>
                        </div>
                    </div>
                </div>
                @endif
                @if($easterncape->isEmpty())
                @else
                <div class="card">
                    <a class="btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseEight" aria-expanded="false" aria-controls="collapseEight">
                        <div class="card-header" id="headingEight">
                            <h2 class="mb-0">
                                Eastern Cape
                            </h2>
                        </div>
                    </a>
                    <div id="collapseEight" class="collapse" aria-labelledby="headingEight" data-parent="#accordionExample">
                        <div class="card-body">
                            <p class="mb-0">
                                @foreach($easterncape as $resort)
                                    <a class="text-capitalize" href="/resort/{{ $resort->slug }}"> - {{ $resort->resort }}</a><br/>
                                @endforeach
                            </p>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@stop