@extends('master')

@section('title', 'Edit Residential Property')

@section('description', '')

@section('keywords', '')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1 class="my-4">Edit Residential Property Details</h1>
        </div>
    </div>

<div style="padding-left:0 !important;padding-right:0 !important;width: 100% !important;max-width: 100% !important;" id="t3-mainbody" class="t3-mainbody">
		<!-- MAIN CONTENT -->
		<form  enctype="multipart/form-data" role="form" method="POST" action="/edit-residential/{{ $residential->id }}">
        @csrf				
						<div class="form-row">
                            <div class="col-md-6">
                              <label>Property Name</label>
                              <input class="form-control" type="text" name="name" value="{{ $residential->name }}" />
							</div>
							<div class="col-md-6">
                              <label>Address</label>
                              <input class="form-control" type="text" name="address" value="{{ $residential->address }}" />
                            </div>
                        </div>
                        
                        <div class="form-row">
                            <div class="col-md-4">
                              <label>Unit Number</label>
                              <input class="form-control" type="text" name="unit" value="{{ $residential->unit }}" />
                            </div>
                            <div class="col-md-4">
                              <label>Size</label>
                              <input class="form-control" type="text" name="size" value="{{ $residential->size }}" />
                            </div>
                            <div class="col-md-4">
                              <label>Price</label>
                              <input class="form-control" type="text" name="price" value="{{ $residential->price }}" />
							</div>
                        </div>

                        <div class="form-row">
                            <div class="col-md-6">
                              <label>Bedrooms</label>
                              <input class="form-control" type="text" name="bedrooms" value="{{ $residential->bedrooms }}" />
                            </div>
                            <div class="col-md-6">
                              <label>Bathrooms</label>
                              <input class="form-control" type="text" name="bathrooms" value="{{ $residential->bathrooms }}" />
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-md-12">
                                <label>Description</label>
                              <textarea name="description" class="editor" value="{{ $residential->description }}">{{ $residential->description }}</textarea>
                            </div>
                        </div>
                        
                        <div class="form-row">
                            <div class="col-md-6">
                            <label>Region</label>
                                <select class="form-control" name="region">
                                    <option value="{{ $residential->region }}">{{ $residential->region }}</option>
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
							<div class="col-md-6">
                            <label>Town</label>
                                <select class="form-control" data-trigger="" name="town">
                                    <option value="{{ $residential->town }}">{{ $residential->town }}</option>
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
                        </div>
                        
                        <div class="form-row">
                            <div class="col-md-4">
                            <label>Suburb</label>
                                <select class="form-control" data-trigger="" name="surburb">
                                    <option value="{{ $residential->surburb }}">{{ $residential->surburb }}</option>
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
							<div class="col-md-4">
                            <label>Property Type</label>
                            <select class="form-control" data-trigger="" name="propertType">
                                <option value="{{ $residential->propertType }}">{{ $residential->propertType }}</option>
                                <option value="">Any</option>
                                <option value="Vacant land">Vacant land</option>
                                <option value="Flat">Flat</option>
                                <option value="Townhouse">Townhouse</option>
                                <option value="Agriculture">Agriculture</option>
                                <option value="House">House</option>
                                <option value="Home in Estate">Home in Estate</option>
                            </select> 
                            </div>
                            <div class="col-md-4">
                                <label style="font-weight:bolder;">Status</label>
                                    <select class="form-control" name="status2">
                                        <option value='{{ $residential->status2 }}'>{{ $residential->status2 }}</option>
                                        <option value="Available For Rent">Available For Rent</option>
                                        <option value="Rented Out">Rented Out</option>
                                        <option value="For Sale">For Sale</option>
                                        <option value="Sold">Sold</option>
                                    </select>
                            </div>
                        </div>
                        
                        <div class="form-row">
                            <div class="col-md-4">
                              <label>Contact Person</label>
                              <input class="form-control" type="text" name="contact_person" value="{{ $residential->contact_person }}" />
							</div>
							<div class="col-md-4">
                              <label>Contact Email</label>
                              <input class="form-control" type="email" name="contact_email" value="{{ $residential->contact_email }}" />
                            </div>
                            <div class="col-md-4">
                              <label>Contact Contact Number</label>
                              <input class="form-control" type="text" name="contact_mobile" value="{{ $residential->contact_mobile }}" />
                            </div>
                        </div>
						
                        <div class="form-row">
                            <div class="col-md-6">
                                <a class="btn btn-blue" href="/residential-admin">BACK</a>
                            </div>
                            <div class="col-md-6">
                                <button class="btn btn-blue" id="submit" type="submit">SAVE</button>
                            </div>
                        </div>
                        
                        </form>
           

</div> 
</div>

@stop