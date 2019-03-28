@extends('master')

@section('title', 'Edit Timeshare Agent')

@section('description', '')

@section('keywords', '')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1 class="my-4">Edit Timeshare Agent details</h1>
        </div>
    </div>
    
    <form  enctype="multipart/form-data" role="form" method="POST" action="/edit-timeshare-agent/{{ $user->id }}">
        @csrf
        <div class="form-row">
            <div class="col-md-6">
                <label style="font-weight:bolder;">Name</label>
                <input class="form-control" type="text" name="name" value="{{ $user->name }}" />
            </div>
            <div class="col-md-6">
                <label style="font-weight:bolder;">Email</label>
                <input class="form-control" type="email" name="email" value="{{ $user->email }}" />
            </div>
        </div>

        <div class="form-row">
            <div class="col-md-6">
                <label>Phone</label>
                <input class="form-control" type="text" name="phone" value="{{ $user->phone }}"/>
            </div>
            <div class="col-md-6">
                <label>Mobile</label>
                <input class="form-control" type="text" name="mobile" value="{{ $user->mobile }}" />
            </div>
        </div>
        
        <div class="form-row">
            <div class="col-md-6">
                <label>Verified </label>
                <select class="form-control" name="timeshare_publish">
                    <option value='NULL'>Please Select</option>
                    <option value=1>Verify</option>
                </select>
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
@stop