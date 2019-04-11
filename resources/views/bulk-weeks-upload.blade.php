@extends('master')

@section('title', 'Weeks Upload')

@section('description', '')

@section('keywords', '')

@section('content')

<div class="container-fluid">
    <div class="row mb-4 mt-5">
        <div class="col-md-10 offset-md-1">
            <h1>Upload Weeks Here</h1>
            <p>Please download and use <a href="/images/bulk-upload-template.xlsx">this template</a> to upload your weeks in the correct format.</p>
            <form id="mainForm" method="POST" action="/bulk-weeks-upload" accept-charset="UTF-8" enctype="multipart/form-data">
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

            <h5>Excel Sheet Template</h5>
            <a href="/images/bulk-upload-template.xlsx">Click here to download</a>

            <p>*NB :Do not change or remove the headings and do not leave empty rows on your sheet.</p>

            <!-- <a class="btn btn-primary" href="/pre-list-access">Manage Access to Pre-selected Weeks</a> -->

        </div>
    </div>
</div>


@stop
