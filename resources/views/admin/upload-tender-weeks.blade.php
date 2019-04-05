@extends('master')

@section('title', 'Tender Weeks Upload')

@section('description', '')

@section('keywords', '')

@section('content')

<div class="container-fluid">
    <div class="row mb-4 mt-5">
        <div class="col-md-10 offset-md-1">
            <h1>Upload Tender Weeks Here</h1>
            <form id="mainForm" method="POST" action="/upload-tender-weeks" accept-charset="UTF-8" enctype="multipart/form-data">
            @csrf
            <div class="form-row">
                <div class="col-md-6">
                <input class="form-control" type="file" name="ex_file" />
                </div>
                <div class="col-md-6">
                        <input class="btn btn-primary" type="submit" value="Submit">
                </div>
            </div>
            </form>

            <hr>

            <h5>Tender Excel Sheet Template</h5>
            <a href="/images/template.xlsx">Click here to download</a>

            <hr>

            <a class="btn btn-primary" href="/pre-list-access">Manage Access to Pre-selected Weeks</a>

        </div>
    </div>
</div>


@stop
