@extends('master')

@section('title', 'Edit Agent Details')

@section('description', '')

@section('keywords', '')

@section('content')
<div class="container">

    <div class="row">
        <div class="col-md-12">
            <h1 class="my-4">Edit agent details</h1>
            <p>{{ $user->name }} from {{ $user->agency }}</p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mb-4">
            <form id="mainForm" method="POST" action="/edit-agent/{{ $user->id }}" accept-charset="UTF-8" enctype="multipart/form-data">
            @csrf
                <div class="form-row">
                    <div class="col-md-6">
                        <input class="form-control" type="text" name="name" placeholder="Name" value="{{ $user->name }}">
                    </div>
                    <div class="col-md-6">
                        <input class="form-control" type="text" name="surname" placeholder="Surname" value="{{ $user->surname }}">
                    </div> 
                </div>
                <div class="form-row">
                    <div class="col-md-4">
                        <input class="form-control" type="email" name="email" placeholder="Email" value="{{ $user->email }}">
                    </div>
                    <div class="col-md-4">
                        <input class="form-control" type="text" name="tel" placeholder="Telephone Number" value="{{ $user->phone }}">
                    </div>
                    <div class="col-md-4">
                        <input class="form-control" type="text" name="cell" placeholder="Cell Number" value="{{ $user->mobile }}">
                    </div>
                </div>
                <!--<div class="form-row">
                    <div class="col-md-4">
                        <input class="form-control" type="text" name="EAAB-FFC-Number" placeholder="EAAB FFC Number" value="{{ $user->EAAB_FFC_Number }}">
                    </div>
                    <div class="col-md-4">
                        <input class="form-control" type="text" name="agency" placeholder="Agency" value="{{ $user->agency }}">
                    </div>
                    <div class="col-md-4">
                        <input class="form-control" type="text" name="registrationNum" placeholder="Registration Number" value="{{ $user->registrationNum }}">
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-4">
                        <input class="form-control" type="text" name="username" placeholder="Username" value="{{ $user->username }}">
                    </div>
                    <div class="col-md-4">
                        <input class="form-control" type="password" name="password" placeholder="Password">
                    </div>
                    <div class="col-md-4">
                        <input class="form-control" type="password" name="password1" placeholder="Confirm Password">
                    </div> 
                </div> -->

                <button class="btn btn-blue btn-lg" id="submit" type="submit">SUBMIT</button>
            </form>
        </div>  
    </div>
    
</div> 
@stop