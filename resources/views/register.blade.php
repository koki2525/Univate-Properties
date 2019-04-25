@extends('master')

@section('title', 'Register')

@section('description', '')

@section('keywords', '')

@section('content')
<div class="container">

    <div class="row">
        <div class="col-md-12">
            <h1 class="my-4">Register as a private seller/buyer</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mb-4">
            <form id="mainForm" method="POST" action="/register" accept-charset="UTF-8" enctype="multipart/form-data">
                @csrf
                <div class="form-row">
                    <div class="col-md-6">
                        <input class="form-control" type="text" name="name" placeholder="Name" value="{{ old('name') }}">
                    </div>
                    <div class="col-md-6">
                        <input class="form-control" type="text" name="surname" placeholder="Surname" value="{{ old('surname') }}">
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-6">
                        <input class="form-control" type="email" name="email" placeholder="Email" value="{{ old('email') }}">
                    </div>
                    <div class="col-md-6">
                        <input class="form-control" type="text" name="mobile" id="mobile" placeholder="Contact Number" value="{{ old('mobile') }}">
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-4">
                        <input class="form-control" type="text" name="username" placeholder="Username" value="{{ old('username') }}">
                    </div>
                    <div class="col-md-4">
                        <input class="form-control" type="password" name="password" placeholder="Password" value="{{ old('password') }}">
                    </div>
                    <div class="col-md-4">
                        <input class="form-control" type="password" name="password1" placeholder="Confirm Password" value="{{ old('password1') }}">
                    </div>
                </div>

                <button class="btn btn-blue btn-lg" id="submit" type="submit">SUBMIT</button>
            </form>
        </div>
    </div>

</div>
@stop
