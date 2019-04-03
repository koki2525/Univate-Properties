@extends('master')

@section('title', 'List Commercial Sale')

@section('description', 'Uni-Vate Properties provides clients with a simple and efficient way to list and sell or rent their commercial property.')

@section('keywords', 'where to sell my commercial property, where to place my property for rent, free property listing sites, Uni-Vate Properties, estate agent services, list my rental')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1 class="my-4">List Commercial Sale Property</h1>
        </div>
    </div>
    <div class="row mb-4">
        <div class="col-md-12">
            <form id="mainForm" method="POST" action="/list-commercial-sale" accept-charset="UTF-8" enctype="multipart/form-data">
            @csrf

                <div class="form-row">
                    <div class="col-md-6">
                        <label>Property Name</label>
                        <input class="form-control" type="text" name="name" />
                    </div>
                    <div class="col-md-6">
                        <label>Reference Number</label>
                        <input class="form-control" type="text" name="ref" />
                    </div>
                </div>

                <div class="form-row">
                    <div class="col-md-4">
                        <label>Size</label>
                        <input class="form-control" type="text" name="size" />
                    </div>
                    <div class="col-md-4">
                        <label>Price</label>
                        <input class="form-control" type="text" name="price" />
                    </div>
                    <div class="col-md-4">
                        <label>Operational Costs</label>
                        <input class="form-control" type="text" name="opCost" />
                    </div>
                </div>

                <div class="form-row">
                    <div class="col-md-6">
                        <label>Region</label>
                        <select class="form-control" name="region">
                            <option value="">Please Select</option>
                            <option value="any">Any</option>
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
                            <option placeholder="" value="">Please Select</option>
                            <option value="any">Any</option>
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
                    <div class="col-md-6">
                        <label>Suburb</label>
                        <select class="form-control" data-trigger="" name="surburb">
                            <option placeholder="" value="">Please Select</option>
                            <option value="any">Any</option>
                            <option value="Carlswald">Carlswald</option>
                            <option value="Silver Lakes">Silver Lakes</option>
                            <option value="Mooikloof">Mooikloof</option>
                            <option value="Zwavelpoort">Zwavelpoort</option>
                            <option value="Pretoria North">Pretoria North</option>
                            <option value="Pretoria East">Pretoria East</option>
                            <option value="Pretoria South">Pretoria South</option>
                        </select> 
                    </div>
                    <div class="col-md-6">
                        <label>Property Type</label>
                        <select class="form-control" data-trigger="" name="propertType">
                            <option placeholder="" value="">Please Select</option>
                            <option value="any">Any</option>
                            <option value="Commercial">Commercial</option>
                            <option value="Industrial">Industrial</option>
                            <option value="Vacant land">Vacant land</option>
                            <option value="Retail">Retail</option>
                        </select> 
                    </div>
                </div>

                <div class="form-row">
                    <div class="col-md-4">
                        <label>Contact Person</label>
                        <input class="form-control" type="text" name="contact_person" />
                    </div>
                    <div class="col-md-4">
                        <label>Contact Email</label>
                        <input class="form-control" type="text" name="contact_email" />
                    </div>
                    <div class="col-md-4">
                        <label>Contact Contact Number</label>
                        <input class="form-control" id="mobile" type="text" name="contact_mobile" />
                    </div>
                </div>

                <div class="form-row">
                    <div class="col-md-12">
                        <label>Property Description</label>
                        <textarea class="form-control editor" name="description"></textarea>
                    </div>
                </div>

                <div class="form-row">
                    <div class="col-md-4">
                        <label>Image 1</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="image1" name="image1" multiple="multiple">
                            <label class="custom-file-label" for="image1" aria-describedby="image1" id="image1Label">Choose file</label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label>Image 2</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="image2" name="image2">
                            <label class="custom-file-label" for="image2" aria-describedby="image2" id="image2Label">Choose file</label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label>Image 3</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="image3" name="image3">
                            <label class="custom-file-label" for="image3" aria-describedby="image3" id="image3Label">Choose file</label>
                        </div>
                    </div>
                </div>

                <button class="btn btn-blue btn-lg" id="submit" type="submit">SUBMIT</button>                
               
            </form>
        </div>
    </div>
</div> 

@stop