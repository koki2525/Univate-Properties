@extends('master')

@section('title', 'Register Commercial Properties Agent')

@section('description', '')

@section('keywords', '')

@section('content')
<div class="container">

    <div class="row">
        <div class="col-md-12">
            <h1 class="my-4">Register as a commercial properties agent</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mb-4">
            <form id="mainForm" method="POST" action="/register-commercial-agent" accept-charset="UTF-8" enctype="multipart/form-data">
            @csrf
            @if(!Auth::check())
              <div class="form-row">
                <div class="col-md-6">
                    <input class="form-control" type="text" name="name" placeholder="Name">
                </div>
                <div class="col-md-6">
                    <input class="form-control" type="email" name="email" placeholder="Email">
                </div>
              </div>
              <div class="form-row">
              <div class="col-md-6">
                    <input class="form-control" type="text" name="phone" placeholder="Phone Number">
                </div>
                <div class="col-md-6">
                    <input class="form-control" type="text" name="mobile" placeholder="Mobile Number">
                </div>
              </div>
              <div class="form-row">
                <div class="col-md-4">
                    <input class="form-control" type="text" name="username" placeholder="Username">
                </div>
                <div class="col-md-4">
                    <input class="form-control" type="password" name="password" placeholder="Password">
                </div>
                <div class="col-md-4">
                    <input class="form-control" type="password" name="password1" placeholder="Confirm Password">
                </div>
              </div>  
            @endif

                <div class="form-row">
                    <div class="col-md-4">
                        <input class="form-control" type="text" name="EAAB-FFC-Number" placeholder="EAAB FFC Number">
                    </div>
                    <div class="col-md-4">
                        <input class="form-control" type="text" name="agency" placeholder="Agency">
                    </div>
                    <div class="col-md-4">
                        <input class="form-control" type="text" name="registrationNum" placeholder="Registration Number">
                    </div>
                </div>
                

                <button class="btn btn-blue btn-lg" id="submit" type="submit">SUBMIT</button>
            </form>
        </div>  
    </div>
    
</div> 
@stop