@extends('master')

@section('title', 'Register')

@section('description', '')

@section('keywords', '')

@section('content')
<div class="container">

    <div class="row">
        <div class="col-md-12">
            <h1 class="my-4">Register as an agent</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mb-4">
            <form id="mainForm" method="POST" action="/register" accept-charset="UTF-8" enctype="multipart/form-data">
                <div class="form-row">
                    <div class="col-md-6">
                        <input class="form-control" type="text" name="name" placeholder="Name">
                    </div>
                    <div class="col-md-6">
                        <input class="form-control" type="text" name="surname" placeholder="Surname">
                    </div> 
                </div>
                <div class="form-row">
                    <div class="col-md-4">
                        <input class="form-control" type="email" name="email" placeholder="Email">
                    </div>
                    <div class="col-md-4">
                        <input class="form-control" type="text" name="tel" placeholder="Telephone Number">
                    </div>
                    <div class="col-md-4">
                        <input class="form-control" type="text" name="cell" placeholder="Cell Number">
                    </div>
                </div>
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

                <button class="btn btn-blue btn-lg" id="submit" type="submit">SUBMIT</button>
            </form>
        </div>  
    </div>
    
</div> 
@stop