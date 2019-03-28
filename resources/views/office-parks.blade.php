@extends('master')

@section('title', 'Office Parks')

@section('description', '')

@section('keywords', '')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1 class="my-4">Office Parks</h1>
            <p>
                The resorts have been listed in their relevant regions. Please select the resort for which you would like to view the available weeks and then select the weeks that interest you on the resort page
            </p>
        </div>
    </div>
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="accordion" id="accordionExample">
                @if($lombardy->isEmpty())
                @else
                <div class="card">
                    <a class="btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        <div class="card-header" id="headingOne">
                            <h2 class="mb-0">
                                Lombardy
                            </h2>
                        </div>
                    </a>

                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                        <div class="card-body">
                            <p class="mb-0">
                                @foreach($lombardy as $unit)
                                    <a class="text-capitalize" href="/lombardy/{{ $unit->id }}"> - {{  $unit->name }}</a><br/>
                                @endforeach
                            </p>
                        </div>
                    </div>
                </div>
                @endif
                @if($mooikloof->isEmpty())
                @else
                <div class="card">
                    <a class="btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        <div class="card-header" id="headingTwo">
                            <h2 class="mb-0">
                                Mooikloof
                            </h2>
                        </div>
                    </a>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                        <div class="card-body">
                            <p class="mb-0">
                                @foreach($mooikloof as $unit)
                                    <a class="text-capitalize" href="/mooikloof/{{ $unit->id }}"> - {{ $unit->name }}</a><br/>
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