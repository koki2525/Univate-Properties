@extends('master')

@section('title', 'Edit Agency Details')

@section('description', '')

@section('keywords', '')

@section('content')
<div class="container">

    <div class="row">
        <div class="col-md-12">
            <h1 class="my-4">Edit Agency Details</h1>
            <hr>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mb-4">
            <form id="mainForm" method="POST" action="/edit-agency/{{ $agency->id }}" accept-charset="UTF-8" enctype="multipart/form-data">
            @csrf
                <p><strong>Agency Details</strong></p>
                <div class="form-row">
                    <div class="col-md-4">
                        <input class="form-control" type="text" name="agency" placeholder="Agency Name" value="{{ $agency->agency }}">
                    </div>
                    <div class="col-md-4">
                        <input class="form-control" type="text" name="EAAB-FFC-Number" placeholder="EAAB FFC Number" value="{{ $agency->EAAB_FFC_Number }}">
                    </div>
                    <div class="col-md-4">
                        <input class="form-control" type="text" name="registrationNum" placeholder="Company Registration Number" value="{{ $agency->registrationNum }}">
                    </div>
                </div>


                <button class="btn btn-blue btn-lg" id="submit" type="submit">SUBMIT</button>
            </form>
        </div>
    </div>

</div>
@stop
