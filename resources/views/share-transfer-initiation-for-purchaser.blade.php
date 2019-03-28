@extends('master')

@section('title', 'Share Transfer Initiation for Purchaser')

@section('description', '')

@section('keywords', '')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1 class="my-4">Share Transfer Initiation for Purchaser</h1>
            <p>
                We kindly request that you peruse this document and thereafter carefully complete same to the best of your knowledge, as the information you provide will form part of the Transfer Agreement with respect to the timeshare module/week.
            </p>
            <p>
                1. PURCHASER'S DETAILS TO CONCLUDE TRANSFER OF THE TIMESHARE MODULE/WEEK 
                (If the purchaser is married in-community of property, the purchaser and his/her spouse must complete this document)
            </p>
        </div>
    </div>
    <div class="row mb-4">
        <div class="col-md-12">
            <form id="mainForm" method="POST" action="/share-transfer-initiation-for-purchaser/{{ $timeshare->id }}" accept-charset="UTF-8" enctype="multipart/form-data">
            @csrf

                <div class="form-group row">
                    <label for="name" class="col-form-label col-md-8">
                        1.1 Name(s) and Surname (or) Company Name: 
                    </label>
                    <div class="col-md-4">
                         <input class="form-control" type="text" name="name" value="{{ $name }}" readonly />
                    </div>
                </div>

                <hr>

                <div class="form-group row">
                    <label for="IDNumber" class="col-form-label col-md-8">
                        1.2 Identity No(s) (or) Company Reg. No:
                    </label>
                    <div class="col-md-4">
                         <input class="form-control" type="text" name="IDNumber" />
                    </div>
                </div>

                <hr>

                <div class="form-group row">
                    <label for="PassportNumber" class="col-form-label col-md-8">
                        1.3 Passport Number(s) (and) Country:
                    </label>
                    <div class="col-md-4">
                         <input class="form-control" type="text" name="PassportNumber" />
                    </div>
                </div>

                <hr>

                <div class="form-group row">
                    <label for="maritalStatus" class="col-form-label col-md-8">
                        1.4 Marital status
                    </label>
                    <div class="col-md-4">
                        <select class="form-control" name="maritalStatus">
                            <option>Select One</option>
                            <option value="Married">Married</option>
                            <option value="Single">Single</option>
                            <option value="Divorced">Divorced</option>
                        </select>
                    </div>
                </div>

                <hr>

                <div class="form-group row">
                    <label for="marriedIn" class="col-form-label col-md-8">
                        1.5 Married in community of property:
                    </label>
                    <div class="col-md-4">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="marriedIn" value='Yes'>
                            <label class="form-check-label" for="paidyes">
                                Yes
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="marriedIn"  id="paidno" value='No'>
                            <label class="form-check-label" for="paidno">
                                No
                            </label>
                        </div>
                    </div>
                </div>

                <hr>

                <div class="form-group row">
                    <label for="otherMeans" class="col-form-label col-md-8">
                        1.6 Married by other means:
                    </label>
                    <div class="col-md-4">
                         <input class="form-control" type="text" name="otherMeans"  />
                    </div>
                </div>

                <hr>

                <div class="form-group row">
                    <label for="tax" class="col-form-label col-md-8">
                        1.7 Income Tax No(s) (or) VAT No:
                    </label>
                    <div class="col-md-4">
                        <input class="form-control" type="text" name="tax" />
                    </div>
                </div>

                <hr>

                <div class="form-group row">
                    <label for="annualIncome" class="col-form-label col-md-8">
                        1.8 If not registered for Income Tax, kindly state your annual income from all sources:  R
                    </label>
                    <div class="col-md-4">
                        <input class="form-control" type="text" name="annualIncome"/>
                    </div>
                </div>

                <hr>

                <div class="form-group row">
                    <label for="physicalAddress" class="col-form-label col-md-8">
                        1.9 Physical (Residential) Address:
                    </label>
                    <div class="col-md-4">
                        <input class="form-control" type="text" name="physicalAddress" />
                    </div>
                </div>

                <hr>

                <div class="form-group row">
                    <label for="postalAddress" class="col-form-label col-md-8">
                        1.10 Postal Address:
                    </label>
                    <div class="col-md-4">
                        <input class="form-control" type="text" name="postalAddress" />
                    </div>
                </div>

                <hr>

                <div class="form-group row">
                    <label for="telephone1" class="col-form-label col-md-8">
                        1.11 Telephone Number(s):
                    </label>
                    <div class="col-md-2">
                        <input class="form-control" type="text" name="telephone1" placeholder="H" value="{{ $phone }}" readonly />
                    </div>
                    <div class="col-md-2">
                        <input class="form-control" type="text" name="telephone2" placeholder="W" />
                    </div>
                </div>

                <hr>

                <div class="form-group row">
                    <label for="phone1" class="col-form-label col-md-8">
                        1.12 Cell phone number(s): 
                    </label>
                    <div class="col-md-2">
                        <input class="form-control" type="text" name="phone1" placeholder="1" value="{{ $cell }}" readonly />
                    </div>
                    <div class="col-md-2">
                        <input class="form-control" type="text" name="phone2" placeholder="2" />
                    </div>
                </div>

                <hr>

                <div class="form-group row">
                    <label for="fax1" class="col-form-label col-md-8">
                        1.13 Fax Number(s): 
                    </label>
                    <div class="col-md-2">
                        <input class="form-control" type="text" name="fax1" placeholder="1" />
                    </div>
                    <div class="col-md-2">
                        <input class="form-control" type="text" name="fax2" placeholder="2" />
                    </div>
                </div>

                <hr>

                <div class="form-group row">
                    <label for="email1" class="col-form-label col-md-8">
                        1.14 E-mail(s):
                    </label>
                    <div class="col-md-2">
                        <input class="form-control" type="text" name="email1" placeholder="1" value="{{ $email }}" readonly />
                    </div>
                    <div class="col-md-2">
                        <input class="form-control" type="text" name="email2" placeholder="2" />
                    </div>
                </div>

                <hr>

                <p>2. DETAILS OF TIMESHARE MODULE/WEEK</p>

                <div class="form-group row">
                    <label for="resort" class="col-form-label col-md-8">
                        2.1 Resort:
                    </label>
                    <div class="col-md-4">
                         <input class="form-control" type="text" name="resort" value="{{ $timeshare->resort }}" />
                    </div>
                </div>

                <div class="form-group row">
                    <label for="unit" class="col-form-label col-md-8">
                        2.2 Unit/Chalet:
                    </label>
                    <div class="col-md-4">
                         <input class="form-control" type="text" name="unit" value="{{ $timeshare->unit }}" />
                    </div>
                </div>

                <div class="form-group row">
                    <label for="module" class="col-form-label col-md-8">
                        2.3 Module/Week:
                    </label>
                    <div class="col-md-4">
                         <input class="form-control" type="text" name="module" value="{{ $timeshare->module }}" />
                    </div>
                </div>

                <div class="form-group row">
                    <label for="price" class="col-form-label col-md-8">
                        2.4 Purchase Price:
                    </label>
                    <div class="col-md-4">
                         <input class="form-control" type="text" name="price" value="{{ $timeshare->price }}" />
                    </div>
                </div>

                <div class="form-group row">
                    <label for="year" class="col-form-label col-md-8">
                        2.5 First year of occupation:
                    </label>
                    <div class="col-md-4">
                         <input class="form-control" type="text" name="year" />
                    </div>
                </div>

                <hr>

                <p>3. VERIFICATION</p>

                <div class="form-group row">
                    <label for="confirmInfo" class="col-form-label col-md-8">
                        3.1 I/We confirm that the information contained herein are both true and correct.
                    </label>
                    <div class="col-md-4">
                        <input class="form-control" type="checkbox" name="confirmInfo" value="yes">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="sign" class="col-form-label col-md-8">
                        3.2 I/We will sign the necessary re-sale (transfer) documents as soon as I/we receive them from the Managing Agent.
                    </label>
                    <div class="col-md-4">
                        <input class="form-control" type="checkbox" name="sign" value="yes">
                    </div>
                </div>
               
            </form>

            <button class="btn btn-blue btn-lg" id="submit" type="submit">SUBMIT</button>
            <a class="btn btn-blue btn-lg" href="javascript:history.back()">BACK</a>
        </div>
    </div>
</div> 
@stop