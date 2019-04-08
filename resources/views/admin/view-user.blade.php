@extends('master')

@section('title', 'User Details')

@section('description', '')

@section('keywords', '')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1 class="my-4">User details</h1>
        </div>
    </div>

        <div class="form-row">
            <div class="col-md-6">
                <label style="font-weight:bolder;">Name</label>
                <input class="form-control" type="text" name="name" value="{{ $user->name }}" readonly/>
            </div>
            <div class="col-md-6">
                <label style="font-weight:bolder;">Surname</label>
                <input class="form-control" type="text" name="surname" value="{{ $user->surname }}" readonly/>
            </div>
        </div>

        <div class="form-row">
            <div class="col-md-6">
                <label>Username</label>
                <input class="form-control" type="text" name="username" value="{{ $user->username }}" readonly/>
            </div>
            <div class="col-md-6">
                <label>Email</label>
                <input class="form-control" type="text" name="email" value="{{ $user->email }}" readonly/>
            </div>
        </div>
        <div class="form-row">
            <div class="col-md-6">
                <label>Phone</label>
                <input class="form-control" type="text" name="phone" value="{{ $user->phone }}" readonly/>
            </div>
            <div class="col-md-6">
                <label>Mobile</label>
                <input class="form-control" type="text" name="mobile" value="{{ $user->mobile }}" readonly/>
            </div>
        </div>

        <div class="form-row">
            <div class="col-md-6">
                <a class="btn btn-blue" href="javascript:history.back()">BACK</a>
            </div>
        </div>
</div>
@stop
