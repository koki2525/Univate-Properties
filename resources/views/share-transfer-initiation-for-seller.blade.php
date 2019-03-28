@extends('master')

@section('title', 'Share Transfer Initiation for Seller')

@section('description', '')

@section('keywords', '')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1 class="my-4">Share Transfer Initiation for Seller</h1>

            <p>
                Please Complete The Information Below In Order For The Share Block Company To Complete The Agreement Of Sale. Please Return The Completed Form To <a href="mailto:info@univateproperties.co.za">info@univateproperties.co.za</a> the information is needed to complete the agreement and will be kept confidential. Please call (012) 941 8521 should you require any further assistance.
            </p>
            <p>
                1. WITH RESPECT TO MY TIMESHARE MODULE/WEEK, I CONFIRM THAT:
            </p>
        </div>
    </div>
    <div class="row mb-4">
        <div class="col-md-12">
            <form id="mainForm" method="POST" action="/share-transfer-initiation-for-seller" accept-charset="UTF-8" enctype="multipart/form-data">
                @csrf

                <div class="form-group row">
                    <label for="paid" class="col-form-label col-md-8">
                       1.1 All Levy Amounts for the current cycle have been paid in full\
                    </label>
                    <div class="col-md-4">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="paid" value='Yes'>
                            <label class="form-check-label" for="paid">
                                Yes
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="paid" value='No'>
                            <label class="form-check-label" for="paid">
                                No
                            </label>
                        </div>
                    </div>
                </div>

                <hr>

                <div class="form-group row">
                    <label for="spaceBanked" class="col-form-label col-md-8">
                        1.2 My week is Space banked for the current year:
                    </label>
                    <div class="col-md-2">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="spaceBanked" value='Yes'>
                            <label class="form-check-label" for="spaceBanked">
                                Yes
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="spaceBanked"  value='No'>
                            <label class="form-check-label" for="spaceBanked">
                                No
                            </label>
                        </div>
                    </div>
                </div>

                <hr>

                <div class="form-group row">
                    <label for="name" class="col-form-label col-md-8">
                        1.3 My week is placed for Rental this year
                    </label>
                    <div class="col-md-4">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="rental" value='Yes'>
                            <label class="form-check-label" for="paidyes">
                                Yes
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="rental" value='No'>
                            <label class="form-check-label" for="paidno">
                                No
                            </label>
                        </div>
                    </div>
                </div>

                <hr>

                <div class="form-group row">
                    <div class="col-md-8">
                        1.4 I/We bought the timeshare module/week on the following date:
                    </div>
                    <div class="col-md-4">
                        <input class="form-control" id="datepicker" name="date"  />
                    </div>
                </div>

                <hr>

                <div class="form-group row">
                    <label for="name" class="col-form-label col-md-8">
                        1.5 The Purchase Price for which I/We bought timeshare module/week was:
                    </label>
                    <div class="col-md-4">
                         <input class="form-control" type="text" name="purchasePrice" placeholder="R" />
                    </div>
                </div>

                <hr>

                <div class="form-group row">
                    <label for="name" class="col-form-label col-md-8">
                        1.6 The Selling Price for the timeshare module/week for which I/We want to sell is: (Including Vat)
                    </label>
                    <div class="col-md-4">
                         <input class="form-control" type="text" name="sellingPrice" placeholder="R" />
                    </div>
                </div>

                <hr>

                <div class="form-group row">
                    <label for="name" class="col-form-label col-md-8">
                        1.7 Name of Estate Agency:
                    </label>
                    <div class="col-md-4">
                        <input class="form-control" type="text" name="estateAgency" />
                    </div>
                </div>

                <hr>

                <div class="form-group row">
                    <label for="name" class="col-form-label col-md-8">
                        1.8 Estate Agent’s commission agreed to (state Rand value)
                    </label>
                    <div class="col-md-4">
                        <input class="form-control" type="text" name="commission" placeholder="R" />
                    </div>
                </div>
                           
            </form>
            
            <button class="btn btn-blue btn-lg" id="submit" type="submit">SUBMIT</button>
            
        </div>
    </div>
</div> 
@stop