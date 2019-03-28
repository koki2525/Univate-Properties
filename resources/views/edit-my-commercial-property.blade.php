@extends('master')

@section('title', 'Edit Commercial Property')

@section('description', '')

@section('keywords', '')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1 class="my-4">Edit my Commercial Property Details</h1>
        </div>
    </div>

    <form  enctype="multipart/form-data" role="form" method="POST" action="/edit-my-commercial/{{ $commercial->id }}">
        @csrf
        <div class="form-row">
                <div class="col-md-6">
                  <label>Property Name</label>
                  <input class="form-control" type="text" name="name" value="{{ $commercial->name }}" />
                </div>
                <div class="col-md-6">
                  <label>Address</label>
                  <input class="form-control" type="text" name="address" value="{{ $commercial->address }}" />
                </div>
            </div>

            <div class="form-row">
                <div class="col-md-4">
                  <label>Unit Number</label>
                  <input class="form-control" type="text" name="unit" value="{{ $commercial->unit }}" />
                </div>
                <div class="col-md-4">
                  <label>Size</label>
                  <input class="form-control" type="text" name="size" value="{{ $commercial->size }}" />
                </div>
                <div class="col-md-4">
                  <label>Price</label>
                  <input class="form-control" type="text" name="price" value="{{ $commercial->price }}" />
                </div>

            </div>

            <div class="form-row">
                <div class="col-md-12">
                    <label>Description</label>
                    <textarea name="description" class="editor form-control" value="{{ $commercial->description }}">{{ $commercial->description }}</textarea>
                </div>
            </div>

            <div class="form-row">
                <div class="col-md-6">
                <label>Region</label>
                    <select class="form-control" name="region">
                        <option value="{{ $commercial->region }}">{{ $commercial->region }}</option>
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
                        <option value="{{ $commercial->town }}">{{ $commercial->town }}</option>
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
                        <option value="{{ $commercial->surburb }}">{{ $commercial->surburb }}</option>
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
                        <option value="{{ $commercial->propertType }}">{{ $commercial->propertType }}</option>
                        <option value="Commercial">Commercial</option>
                        <option value="Industrial">Industrial</option>
                        <option value="Vacant land">Vacant land</option>
                        <option value="Retail">Retail</option>
                    </select> 
                </div>
                <div class="col-md-4">
                    <label style="font-weight:bolder;">Status</label>
                        <select class="form-control" name="status2">
                            <option value='{{ $commercial->status2 }}'>{{ $commercial->status2 }}</option>
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
                  <input class="form-control" type="text" name="contact_person" value="{{ $commercial->contact_person }}" />
                </div>
                <div class="col-md-4">
                  <label>Contact Email</label>
                  <input class="form-control" type="text" name="contact_email" value="{{ $commercial->contact_email }}" />
                </div>
                <div class="col-md-4">
                  <label>Contact Contact Number</label>
                  <input class="form-control" type="text" name="contact_mobile" value="{{ $commercial->contact_mobile }}" />
                </div>
            </div>

        <div class="form-row">
            <div class="col-md-6">
                <a class="btn btn-blue" href="/my-commercial-properties">BACK</a>
            </div>
            <div class="col-md-6">
                <button class="btn btn-blue" id="submit" type="submit">SAVE</button>
            </div>
        </div>
    </form>
</div> 

@stop