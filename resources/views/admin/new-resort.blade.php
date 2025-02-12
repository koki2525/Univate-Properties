@extends('master')

@section('title', 'Resort' )

@section('description')@stop

@section('keywords')@stop

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-7 offset-md-1">
            <h1 class="my-4">Add a new resort</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-7 offset-md-1">
            <form id="mainForm" method="POST" action="" accept-charset="UTF-8" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                                
                        </div> 
                    </div>
                </div>
            </form>
            <div class="col-md-12">
                    <form id="mainForm" method="POST" action="/new-resort" accept-charset="UTF-8" enctype="multipart/form-data">
                    @csrf
                    <div class="form-row">
                        <div class="col-md-6">
                            <label>Resort Name *</label>
                            <input class="form-control" type="text" name="resort" value="{{ old('resort') }}" />
                        </div>
                        <div class="col-md-6">
                                <label>Region *</label>
                                <select class="form-control" name="region" id="region">
                                    <option value="">Please Select</option>
                                    <option value="gauteng" {{ old('region') ==  'gauteng' ? 'selected' : '' }}>Gauteng</option>
                                    <option value="Kwazulu Natal" {{ old('region') ==  'Kwazulu Natal'  ? 'selected' : '' }}>Kwazulu Natal</option>
                                    <option value="mpumalanga" {{ old('region') ==  'mpumalanga'  ? 'selected' : '' }}>Mpumalanga</option>
                                    <option value="north west" {{ old('region') ==  'north west'  ? 'selected' : '' }}>North West</option>
                                    <option value="free state" {{ old('region') ==  'free state'  ? 'selected' : '' }}>Free State</option>
                                    <option value="eastern cape" {{ old('region') ==  'eastern cape'  ? 'selected' : '' }}>Eastern Cape</option>
                                    <option value="western cape" {{ old('region') ==  'western cape'  ? 'selected' : '' }}>Western Cape</option>
                                    <option value="northern cape" {{ old('region') ==  'northern cape'  ? 'selected' : '' }}>Northern Cape</option>
                                    <option value="limpopo" {{ old('region') ==  'limpopo'  ? 'selected' : '' }}>Limpopo</option>
                                </select>
                        </div>
                    </div>
        
                    <div class="form-row">
                        <div class="col-md-12">
                            <label>Property Description *</label>
                            <textarea class="form-control editor" name="information" value="{{ old('information') }}"></textarea>
                        </div>
                    </div>
        
                    <div class="form-row">
                        <div class="col-md-6">
                            <label>Resort Website Link </label>
                            <input class="form-control" type="text" name="url" value="{{ old('url') }}" />    
                        </div>
                        <div class="col-md-6">
                            <label>Trip Advisor Link <em>(if available)</em></label>
                            <input class="form-control" type="text" name="advisor" value="{{ old('advisor') }}" />  
                        </div>
                    </div>
        
                    <div class="form-row">
                        <div class="col-md-6">
                            <label>Awards</label><br>
                            <input type="checkbox" name="awards[]" value="RCI Hospitality"> RCI Hospitality
                            <input type="checkbox" name="awards[]" value="Gold Crown"> Gold Crown
                            <input type="checkbox" name="awards[]" value="Silver Crown"> Silver Crown
                        </div>
                        <div class="col-md-6">
                            <label>Upload Resort Layout *</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="layout" name="layout" multiple="multiple" value="{{ old('layout') }}">
                                <label class="custom-file-label" for="layout" aria-describedby="layout" id="layout">Choose file</label>
                            </div>    
                        </div>
                    </div>
        
                    <hr>
                    <p><strong>Please upload 3 resort images</strong></p>
        
                    <div class="form-row">
                        <div class="col-md-4">
                            <label>Image 1 *</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="image1" name="image1" multiple="multiple" value="{{ old('image1') }}">
                                <label class="custom-file-label" for="image1" aria-describedby="image1" id="image1Label">Choose file</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>Image 2 *</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="image2" name="image2" value="{{ old('image2') }}">
                                <label class="custom-file-label" for="image2" aria-describedby="image2" id="image2Label">Choose file</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>Image 3 *</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="image3" name="image3" value="{{ old('image3') }}">
                                <label class="custom-file-label" for="image3" aria-describedby="image3" id="image3Label">Choose file</label>
                            </div>
                        </div>
                    </div>
        
                    <button class="btn btn-blue btn-lg" id="submit" type="submit">SUBMIT</button>

        </div>
    </div> 
        
        <div class="col-md-3 pl-3 pl-md-5 sidebar">
            @include('partials.add-facilities')
        </div>
    </div>
</div>

@stop
