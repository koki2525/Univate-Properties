@extends('master')

@section('title', 'Edit Agency Profile')

@section('description', '')

@section('keywords', '')

@section('content')
<div class="container">

    <div class="row">
        <div class="col-md-12">
            <h1 class="my-4">Edit Agency details</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mb-4">
            <form id="mainForm" method="POST" action="/update-agency-profile/{{ Auth::user()->agency }}" accept-charset="UTF-8" enctype="multipart/form-data">
            @csrf
                <div class="form-row">
                    <div class="col-md-4">
                        <label>Agency Name</label>
                        <input class="form-control" type="text" name="agency" placeholder="Agency Name" value="{{ $agency->agency }}">
                    </div>
                    <div class="col-md-4">
                        <label>Registration Number</label>
                        <input class="form-control" type="text" name="registrationNum" placeholder="Registration Number" value="{{ $agency->registrationNum }}">
                    </div>
                   <div class="col-md-4">
                       <label>EAAB FFC Number</label>
                        <input class="form-control" type="text" name="EAAB_FFC_Number" placeholder="EAAB FFC Number" value="{{ $agency->EAAB_FFC_Number }}">
                    </div> 
                </div>
                
                <button class="btn btn-blue btn-lg" id="submit" type="submit">SUBMIT</button>
            </form>
        </div>  
    </div>
    
</div> 
@stop