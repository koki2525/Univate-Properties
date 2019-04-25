@extends('master')

@section('title', 'Edit Timeshare')

@section('description', '')

@section('keywords', '')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1 class="my-4">Edit My Timeshare details</h1>
        </div>
    </div>

    <form  enctype="multipart/form-data" role="form" method="POST" action="/edit-my-timeshare/{{ $timeshare->id }}">
        @csrf
        @if($timeshare->verified==0)
        <div class="form-row">
            <div class="col-md-6">
                <label style="font-weight:bolder;">Resort</label>
                <input class="form-control" type="text" name="resort" value="{{ $timeshare->resort }}" readonly/>
            </div>
            <div class="col-md-6">
                <label style="font-weight:bolder;">Module</label>
                <input class="form-control" type="text" name="module" value="{{ $timeshare->module }}" readonly/>
            </div>
        </div>

        <div class="form-row">
            <div class="col-md-6">
                <label>Week</label>
                <input class="form-control" type="text" name="week" value="{{ $timeshare->week }}" readonly/>
            </div>
            <div class="col-md-6">
                <label>Bedrooms</label>
                <input class="form-control" type="text" name="bedrooms" value="{{ $timeshare->bedrooms }}" readonly/>
            </div>
        </div>
        <div class="form-row">
            <div class="col-md-6">
                <label>Sleeps Maximum</label>
                <input class="form-control" type="text" name="sleeps" value="{{ $timeshare->sleeps }}" readonly/>
            </div>
            <div class="col-md-6">
                <label>Unit Number</label>
                <input class="form-control" type="text" name="unit" value="{{ $timeshare->unit }}" readonly/>
            </div>
        </div>
        <div class="form-row">
            <div class="col-md-4">
                <label>Owner</label>
                <input class="form-control" type="text" name="owner" value="{{ $timeshare->owner }}" readonly/>
            </div>
            <div class="col-md-4">
                <label>Has your week been spacebanked this year?</label>
                <input class="form-control" type="text" name="spacebankedyear" value="{{ $timeshare->spacebankedyear }}" readonly/>
            </div>
            <div class="col-md-4">
                <label>If yes, please confirm with whom</label>
                <input class="form-control" type="text" name="spacebankOwner" value="{{ $timeshare->spacebankOwner }}" readonly/>
            </div>
        </div>

        <div class="form-row">
            <div class="col-md-6">
                <label>Season</label>
                <input class="form-control" type="text" name="season" value="{{ $timeshare->season }}" readonly/>
            </div>
            <div class="col-md-6">
                <label>Region</label>
                <input class="form-control" type="text" name="region" value="{{ $timeshare->region }}" readonly/>
            </div>
        </div>

        <div class="form-row">
            <div class="col-md-6">
                <label>Asking Price</label>
                <input class="form-control" type="number" step="any" name="price" value="{{ $timeshare->price }}" />
            </div>
            <div class="col-md-6">
                <label>Final Price</label>
                <input class="form-control" type="text" name="setPrice" value="{{ $timeshare->setPrice }}" readonly/>
            </div>
        </div>

        <div class="form-row">
            <div class="col-md-6">
                <label>Status <em>(current : {{ $timeshare->status }})</em></label>
                <!-- <select class="form-control" name="status">
                    <option value='NULL'>Please Select</option>
                    <option value="Offer Pending">Offer Pending</option>
                    <option value="Lengen">Lengen</option>
                    <option value="Sold">Sold</option>
                    <option value="For Sale">For Sale</option>
                </select> -->
            </div>
            <!-- <div class="col-md-4">
                <label>Publish</label>
                <!-- <select class="form-control" name="publish">
                    <option value='NULL'>Please Select</option>
                    <option value=1>Yes</option>
                    <option value=2>No</option>
                </select> 
            </div>
            <div class="col-md-6">
                <label>Date</label>
                <input id="statusDate" class="form-control" name="statusDate"  />
            </div> -->
        </div>

        <div class="form-row">
            <div class="col-md-6">
                <a class="btn btn-blue" href="/my-timeshares">BACK</a>
            </div>
            <div class="col-md-6">
                <button class="btn btn-blue" id="submit" type="submit">SAVE</button>
            </div>
        </div>
        @else
        <div class="form-row">
            <div class="col-md-6">
                <label style="font-weight:bolder;">Resort</label>
                <input class="form-control" type="text" name="resort" value="{{ $timeshare->resort }}" readonly/>
            </div>
            <div class="col-md-6">
                <label style="font-weight:bolder;">Module</label>
                <input class="form-control" type="text" name="module" value="{{ $timeshare->module }}" readonly/>
            </div>
        </div>

        <div class="form-row">
            <div class="col-md-6">
                <label>Week</label>
                <input class="form-control" type="text" name="week" value="{{ $timeshare->week }}" readonly/>
            </div>
            <div class="col-md-6">
                <label>Bedrooms</label>
                <input class="form-control" type="text" name="bedrooms" value="{{ $timeshare->bedrooms }}" readonly/>
            </div>
        </div>
        <div class="form-row">
            <div class="col-md-6">
                <label>Sleeps Maximum</label>
                <input class="form-control" type="text" name="sleeps" value="{{ $timeshare->sleeps }}" readonly />
            </div>
            <div class="col-md-6">
                <label>Unit Number</label>
                <input class="form-control" type="text" name="unit" value="{{ $timeshare->unit }}" readonly />
            </div>
        </div>
        <div class="form-row">
            <div class="col-md-4">
                <label>Owner</label>
                <input class="form-control" type="text" name="owner" value="{{ $timeshare->owner }}"  readonly/>
            </div>
            <div class="col-md-4">
                <label>Has your week been spacebanked this year?</label>
                <input class="form-control" type="text" name="spacebankedyear" value="{{ $timeshare->spacebankedyear }}" readonly />
            </div>
            <div class="col-md-4">
                <label>If yes, please confirm with whom</label>
                <input class="form-control" type="text" name="spacebankOwner" value="{{ $timeshare->spacebankOwner }}" readonly />
            </div>
        </div>

        <div class="form-row">
            <div class="col-md-6">
                <label>Season</label>
                <input class="form-control" type="text" name="season" value="{{ $timeshare->season }}" readonly />
            </div>
            <div class="col-md-6">
                <label>Region</label>
                <input class="form-control" type="text" name="region" value="{{ $timeshare->region }}" readonly />
            </div>
        </div>

        <div class="form-row">
            <div class="col-md-6">
                <label>Asking Price</label>
                <input class="form-control" type="text" name="price" value="{{ $timeshare->price }}" />
            </div>
            <div class="col-md-6">
                <label>Final Price</label>
                <input class="form-control" type="text" name="setPrice" value="{{ $timeshare->setPrice }}" readonly />
            </div>
        </div>

        <div class="form-row">
            <div class="col-md-6">
                <label>Status <em>(current : {{ $timeshare->status }})</em></label>
            </div>
        </div>

        <div class="form-row">
            <div class="col-md-6">
                <a class="btn btn-blue" href="/my-timeshares">BACK</a>
            </div>
            <div class="col-md-6">
                <button class="btn btn-blue" id="submit" type="submit">SAVE</button>
            </div>
        </div>

    @endif
    </form>
</div>
@stop
