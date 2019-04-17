@extends('master')

@section('title', 'Edit Timeshare')

@section('description', '')

@section('keywords', '')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1 class="my-4">Edit Timeshare details</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <h2>Seller Information</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <label>Seller</label><br>
            {{ $timeshare->owner }}
        </div>
        <div class="col-md-3">
            <label>Email</label><br>
            {{ $timeshare->email }}	
        </div>
        <div class="col-md-3">
            <label>Phone</label><br>
            {{ $timeshare->phone }}	
        </div>
        <div class="col-md-3">
            <label>Mobile</label><br>
            {{ $timeshare->mobile }}	
        </div>
    </div>

    <hr>
    
    <form  enctype="multipart/form-data" role="form" method="POST" action="/edit-timeshare/{{ $timeshare->id }}">
        @csrf
        <div class="form-row">
            <div class="col-md-6">
                <label style="font-weight:bolder;">Resort</label>
                <input class="form-control" type="text" name="resort" value="{{ $timeshare->resort }}" />
            </div>
            <div class="col-md-6">
                <label style="font-weight:bolder;">Module</label>
                <input class="form-control" type="text" name="module" value="{{ $timeshare->module }}" />
            </div>
        </div>

        <div class="form-row">
            <div class="col-md-6">
                <label style="font-weight:bolder;">Arrival Date : {{ $timeshare->fromDate }}</label>
                <input type="date" class="form-control" name="fromDate"   />
            </div>
            <div class="col-md-6">
                <label style="font-weight:bolder;">Depature Date : {{ $timeshare->toDate }}</label>
                <input type="date" type="date" class="form-control" name="toDate"   />
            </div>
        </div>

        <div class="form-row">
            <div class="col-md-6">
                <label>Week</label>
                <input class="form-control" type="text" name="week" value="{{ $timeshare->week }}"/>
            </div>
            <div class="col-md-6">
                <label>Bedrooms</label>
                <input class="form-control" type="text" name="bedrooms" value="{{ $timeshare->bedrooms }}" />
            </div>
        </div>
        <div class="form-row">
            <div class="col-md-6">
                <label>Sleeps Maximum</label>
                <input class="form-control" type="text" name="sleeps" value="{{ $timeshare->sleeps }}" />
            </div>
            <div class="col-md-6">
                <label>Unit Number</label>
                <input class="form-control" type="text" name="unit" value="{{ $timeshare->unit }}" />
            </div>
        </div>
        <div class="form-row">
            <div class="col-md-6">
                <label>Owner</label>
                <input class="form-control" type="text" name="owner" value="{{ $timeshare->owner }}" />
            </div>
            <div class="col-md-6">
                    <label>Levy</label>
                    <input class="form-control" type="number" step="any" name="levy" value="{{ $timeshare->levy }}" />
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-6">
                    <label>Has your week been spacebanked this year?</label>
                    <input class="form-control" type="text" name="spacebankedyear" value="{{ $timeshare->spacebankedyear }}" />
                </div>
                <div class="col-md-6">
                    <label>If yes, please confirm with whom</label>
                    <input class="form-control" type="text" name="spacebankOwner" value="{{ $timeshare->spacebankOwner }}" />
                </div>
            </div>

        <div class="form-row">
            <div class="col-md-6">
                <label>Season</label>
                <input class="form-control" type="text" name="season" value="{{ $timeshare->season }}" />
            </div>
            <div class="col-md-6">
                <label>Region</label>
                <input class="form-control" type="text" name="region" value="{{ $timeshare->region }}" />
            </div>
        </div>

        <div class="form-row">
            <div class="col-md-6">
                <label>Asking Price</label>
                <input class="form-control" type="number" step="any" name="price" value="{{ $timeshare->price }}" />
            </div>
            <div class="col-md-6">
                <label>Final Price</label>
                <input class="form-control" type="number" step="any" name="setPrice" value="{{ $timeshare->setPrice }}" />
            </div>
        </div>

        <div class="form-row">
            <div class="col-md-4">
                <label>Status <em>(current : {{ $timeshare->status }})</em></label>
                <select class="form-control" name="status">
                    <option value='NULL'>Please Select</option>
                    <option value="Publish">Publish</option>
                    <option value="Cancelled">Cancelled</option>
                    <option value='Awaiting payment'>Awaiting payment</option>
                    <option value="Authorization needed">Authorization needed</option>
                    <option value="For Sale">For Sale</option>
                    <option value="Offer Pending">Offer Pending</option>
                    <option value="Lengen">Lengen</option>
                    <option value="Offer Accepted">Offer Accepted</option>
                    <option value="Contract in progress">Contract in progress</option>
                    <option value="Contract Complete">Contract Complete</option>
                    <option value="Sold">Sold</option>
                </select>
            </div>
            <div class="col-md-4">
                <label>Publish</label>
                <select class="form-control" name="publish">
                    <option value='NULL'>Please Select</option>
                    <option value=1>Yes</option>
                    <option value=2>No</option>
                </select>
            </div>
            <div class="col-md-4">
                <label>Date : {{ \Carbon\Carbon::parse($timeshare->statusDate)->format('jS F Y') }}</label>
                <input type="date" class="form-control" name="statusDate"  />
            </div>
        </div>

        <div class="form-row">
            <div class="col-md-6">
                <a class="btn btn-blue" href="/admin">BACK</a>
            </div>
            <div class="col-md-6">
                <button class="btn btn-blue" id="submit" type="submit">SAVE</button>
            </div>
        </div>
    </form>
</div> 
<script>
        $(document).ready(function(){
          var date_input=$('input[name="date"]'); //our date input has the name "date"
          var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
          var options={
            format: 'mm/dd/yyyy',
            container: container,
            todayHighlight: true,
            autoclose: true,
          };
          date_input.datepicker(options);
        })
    </script>
@stop