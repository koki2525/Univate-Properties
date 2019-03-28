@extends('master')

@section('title', 'Residential' )

@section('description', 'Uni-Vate Properties provides clients with a simple and efficient way to list and sell or rent their residential property.')

@section('keywords', 'where to sell my residential property, where to place my property for rent, free property listing sites, Uni-Vate Properties, estate agent services, list my rental')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1 class="my-4">Residential Properties</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <form id="mainForm" method="POST" action="/residential" accept-charset="UTF-8" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="for" id="forSale" value='Sale'>
                        <label class="form-check-label mr-3 large-text" for="forSale">
                            For Sale
                        </label>
                        <input class="form-check-input" type="radio" name="for" id="forRent" value='rental'>
                        <label class="form-check-label large-text" for="forRent">
                            For Rent
                        </label>
                    </div>
                </div>

                <div class="form-row">
                    <div class="col-md-3">
                        <label>Region</label>
                        <select class="form-control" name="region">
                            <option value="">Please Select</option>
                            <option value="">Any</option>
                            <option value="gauteng">Gauteng</option>
                            <option value="Kwazulu Natal">Kwazulu Natal</option>
                            <option value="mpumalanga">Mpumalanga</option>
                            <option value="north west">North West</option>
                            <option value="free state">Free State</option>
                            <option value="eastern cape">Eastern Cape</option>
                            <option value="western cape">Western Cape</option>
                            <option value="northern cape">Northern Cape</option>
                            <option value="limpopo">Limpopo</option>
                        </select> 
                    </div>
                    <div class="col-md-3">
                        <label>Town</label>
                        <select class="form-control" data-trigger="" name="town">
                            <option placeholder="" value="">Please Select</option>
                            <option value="">Any</option>
                            <option value="Pretoria">Pretoria</option>
                            <option value="Johannesburg">Johannesburg</option>
                            <option value="Centurion">Centurion</option>
                            <option value="Durban">Durban</option>
                            <option value="Cape Town">Cape Town</option>
                            <option value="Knysna">Knysna</option>
                            <option value="Durban">Sedgefield</option>
                            <option value="Midrand">Midrand</option>
                        </select>    
                    </div>
                    <div class="col-md-3">
                        <label>Suburb</label>
                        <select class="form-control" data-trigger="" name="surburb">
                            <option placeholder="" value="">Please Select</option>
                            <option value="">Any</option>
                            <option value="Carlswald">Carlswald</option>
                            <option value="Silver Lakes">Silver Lakes</option>
                            <option value="Mooikloof">Mooikloof</option>
                            <option value="Monument Park">Monument Park</option>
                            <option value="Zwavelpoort">Zwavelpoort</option>
                            <option value="Pretoria North">Pretoria North</option>
                            <option value="Pretoria East">Pretoria East</option>
                            <option value="Pretoria South">Pretoria South</option>
                        </select> 
                    </div>
                    <div class="col-md-3">
                        <label>Property Type</label>
                        <select class="form-control" data-trigger="" name="propertType">
                            <option placeholder="" value="">Please Select</option>
                            <option value="">Any</option>
                            <option value="Vacant land">Vacant land</option>
                            <option value="Flat">Flat</option>
                            <option value="Townhouse">Townhouse</option>
                            <option value="Agriculture">Agriculture</option>
                            <option value="House">House</option>
                            <option value="Home in Estate">Home in Estate</option>
                        </select> 
                    </div>
                </div>
                <div class="form-group mt-4">
                    <button class="btn btn-blue" type="submit">Search</button>
                </div>
            </form>
        </div>
    </div>
    <div class="row my-5">
        <div class="col-md-6">
            <p class="text-center"><img class="img-fluid" src="{{ asset('/images/residential.jpg') }}" alt="Residential"></p>
        </div>
        <div class="col-md-6">
            <h2>About Residential</h2>
            <p>
                Uni-Vate Properties understands the necessity in property-seekers to find that perfect fit; a home that meets, and exceeds the individual's needs. That is why, our dedicated team sources a range of property types, whether that home is a rental option near a University for a student just starting out, or a family home fit for entertaining.
            </p>
            <p>
                Looking to sell your residential property, instead? Uni-Vate Properties prides itself on professionalism and the right expertise, to help you secure the best possible deal for your home. 
            </p>
            <p>
                <a href="/list-residential-rental">Click here</a> to rent out. <a href="/list-residential-sale">Click here</a> to sell
            </p>
        </div>
    </div>
</div>
@stop