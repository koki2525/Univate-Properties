@extends('master')

@section('title', 'To Sell')

@section('description', 'Uni-Vate Properties provides a reliable platform from which to advertise and sell tender weeks within the timeshare industry.')

@section('keywords', 'Timeshare selling, where to sell my timeshare, Uni-Vate Properties, Uni-Vate timeshare, timeshare for sale, tender weeks available, sell my tender week')

@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> 
<style>
    .choose :hover {
        background-color: #72c5ed;
    }
</style>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1 class="my-4">To Sell
                @if(Auth::check() && Auth::user()->agency!=NULL or (Auth::check() && Auth::user()->role=="admin"))
                    <a style="float: right;" class="btn btn-blue btn-lg" href="/bulk-weeks-upload">Bulk Weeks upload</a>
                @endif  
            </h1>
            <hr>
            <p>* You need to be logged in to submit your listing. Please register and log in if you have not done so already.</p>
            <hr>
        </div>
    </div>
    <div class="row mb-4">
        <div class="col-md-12">
            <form id="mainForm" method="POST" action="/to-sell" accept-charset="UTF-8" enctype="multipart/form-data">
            @csrf
            <div class="form-group row">
                    <div class="col-md-4">
                        <label>Were you referred by an agent?</label>
                        <br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" id="referedBy" class="radiogroup" name="referedBy" value='Yes' @if(old('referedBy')) checked @endif>
                            <label class="form-check-label" for="referedBy">
                                Yes
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" id="referedBy" class="radiogroup" name="referedBy" value='No' @if(!old('referedBy')) checked @endif>
                            <label class="form-check-label" for="referedBy">
                                No
                            </label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label>Name of agency <em>(if applicable)</em></label>
                        @if(Auth::check() && (Auth::user()->role == "agency admin" or (Auth::user()->role == "user" && Auth::user()->agency)))
                        <input class="form-control" type="text" id="estateAgency" name="estateAgency" value="{{ Auth::user()->agency }}" readonly />
                        <div id="agencyList">
                        </div>
                        @else
                        <input class="form-control" type="text" id="estateAgency" name="estateAgency" />
                        <div id="agencyList">
                        </div>
                        @endif
                    </div>
                    <div class="col-md-4">
                        <label>Agent name <em>(if applicable)</em></label>
                        @if(Auth::check() && (Auth::user()->role == "agency admin" or (Auth::user()->role == "user" && Auth::user()->agency)))
                        <input class="form-control" type="text" id="agentName" name="agentName" value="{{ Auth::user()->name }}" readonly />
                        <div id="agentList">
                        </div>
                        @else
                        <input class="form-control" type="text" id="agentName" name="agentName" value="{{ old('agentName') }}" />
                        <div id="agentList">
                        </div>
                        @endif
                    </div>

                </div>

                <div class="form-group row">
                    <div class="col-md-6">
                        <label>Resort name</label>
                        <select class="form-control" id="resort" name="resort">
                            <option value="">Please Select</option>
                            @foreach($resorts as $resort)
                            <option value="{{ $resort->resort }}" {{ old('resort') ==  $resort->resort  ? 'selected' : '' }}>{{ $resort->resort }}</option>
                            @endforeach
                            <option value="Other">Other</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label>* If other</label>
                        <input class="form-control" type="text" name="other" value="{{ old('other') }}" />
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-6">
                        <label>Region</label>
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
                    <div class="col-md-6">
                        <label>Season</label>
                        <select class="form-control" name="season">
                            <option value="">Please Select</option>
                            <option value="Peak" {{ old('season') ==  'Peak' ? 'selected' : '' }}>Peak</option>
                            <option value="Red" {{ old('season') ==  'Red' ? 'selected' : '' }}>Red</option>
                            <option value="White" {{ old('season') ==  'White' ? 'selected' : '' }}>White</option>
                            <option value="Blue" {{ old('season') ==  'Blue' ? 'selected' : '' }}>Blue</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-6">
                        <label>Module</label>
                        <input class="form-control" type="text" name="module" value="{{ old('module') }}" />
                    </div>
                    <div class="col-md-6">
                        <label>Week number</label>
                        <input class="form-control" type="text" name="week" value="{{ old('week') }}" />
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-6">
                        <label>Bedrooms</label>
                        <select class="form-control" name="bedrooms">
                            <option value="">Please Select</option>
                            <option value="Studio">Studio</option>
                            <option value="1" {{ old('bedrooms') ==  '1' ? 'selected' : '' }}>1</option>
                            <option value="2" {{ old('bedrooms') ==  '2' ? 'selected' : '' }}>2</option>
                            <option value="3" {{ old('bedrooms') ==  '3' ? 'selected' : '' }}>3</option>
                            <option value="4" {{ old('bedrooms') ==  '4' ? 'selected' : '' }}>4</option>
                            <option value="5" {{ old('bedrooms') ==  '5'? 'selected' : '' }}>5</option>
                            <option value="6" {{ old('bedrooms') ==  '6' ? 'selected' : '' }}>6</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label>Sleeps maximum</label>
                        <select class="form-control" name="sleeps">
                            <option value="">Please Select</option>
                            <option value="2" {{ old('sleeps') ==  '2' ? 'selected' : '' }}>2</option>
                            <option value="4" {{ old('sleeps') ==  '4' ? 'selected' : '' }}>4</option>
                            <option value="6" {{ old('sleeps') ==  '6' ? 'selected' : '' }}>6</option>
                            <option value="8" {{ old('sleeps') ==  '8' ? 'selected' : '' }}>8</option>
                            <option value="10" {{ old('sleeps') ==  '10' ? 'selected' : '' }}>10</option>
                            <option value="12" {{ old('sleeps') ==  '12' ? 'selected' : '' }}>12</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-6">
                        <label>Unit number</label>
                        <input class="form-control" type="text" name="unit" value="{{ old('unit') }}" />
                    </div>
                    <div class="col-md-6">
                        <label>Owner</label>
                        <input class="form-control" type="text" name="owner" value="{{ old('owner') }}" />
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-6">
                            <label>Levy</label>
                            <input class="form-control" type="number" step="any" name="levy" value="{{ old('levy') }}" />
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-6">
                        <legend>Has your week been spacebanked for the current year?</legend>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="spacebankedyear" id="spacebankedyearyes" value='Yes' @if(old('spacebankedyear')) checked @endif>
                            <label class="form-check-label" for="spacebankedyearyes">
                                Yes
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="spacebankedyear" id="spacebankedyearno" value='No' @if(!old('spacebankedyear')) checked @endif>
                            <label class="form-check-label" for="spacebankedyearno">
                                No
                            </label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label>If yes, please confirm with whom</label>
                        <select class="form-control" name="spacebankOwner">
                            <option value="">Please Select</option>
                            <option value="Dial an Exchange" {{ old('spacebankOwner') ==  'Dial an Exchange' ? 'selected' : '' }}>Dial an Exchange</option>
                            <option value="RCI" {{ old('spacebankOwner') ==  'RCI' ? 'selected' : '' }}>RCI</option>
                            <option value="First Exchange" {{ old('spacebankOwner') ==  'First Exchange' ? 'selected' : '' }}>First Exchange</option>
                            <option value="iExchange" {{ old('spacebankOwner') ==  'iExchange' ? 'selected' : '' }}>iExchange</option>
                            <option value="Interval International" {{ old('spacebankOwner') ==  'Interval International' ? 'selected' : '' }}>Interval International</option>
                        </select>
                    </div>
                </div>

                <hr>

                <h3>Share transfer information</h3>

                <p>1. With respect to my timeshare module/week, I confirm that:</p>

                <div class="form-group row">
                    <label for="name" class="col-form-label col-md-8">
                       1.1 All levy amounts for the current cycle have been paid in full
                    </label>
                    <div class="col-md-4">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="paid" value='Yes' @if(old('paid')) checked @endif>
                            <label class="form-check-label" for="paid">
                                Yes
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="paid" value='No' @if(!old('paid')) checked @endif>
                            <label class="form-check-label" for="paid">
                                No
                            </label>
                        </div>
                    </div>
                </div>

                <hr>

                <div class="form-group row">
                    <label for="name" class="col-form-label col-md-8">
                        1.2 My week is placed for rental this year
                    </label>
                    <div class="col-md-4">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="rental" value='Yes' @if(old('rental')) checked @endif>
                            <label class="form-check-label" for="paidyes">
                                Yes
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="rental" value='No' @if(!old('rental')) checked @endif>
                            <label class="form-check-label" for="paidno">
                                No
                            </label>
                        </div>
                    </div>
                </div>

                <hr>

                <div class="form-group row">
                    <label for="name" class="col-form-label col-md-8">
                        1.3 I/We bought the timeshare module/week on the following date:
                    </label>
                    <div class="col-md-4">
                    <input data-date-format="dd-mm-yyyy" id="datepicker1" class="form-control" name="date" value="{{ old('date') }}"  />
                    </div>
                </div>

                <hr>

                <div class="form-group row">
                    <label for="name" class="col-form-label col-md-8">
                        1.4 The purchase price for which I/we bought timeshare module/week was:
                    </label>
                    <div class="col-md-4">
                         <input class="form-control" type="number" step="any" name="purchasePrice" placeholder="R" value="{{ old('purchasePrice') }}" />
                    </div>
                </div>

                <hr>

                <div class="form-group row">
                    <label for="name" class="col-form-label col-md-8">
                        1.5 I/We bought the timeshare module/week for the following dates for the current year:
                    </label>
                    <div class="col-md-4">
                    Arrival Date :
                    <input data-date-format="dd-mm-yyyy" id="datepicker3" class="form-control" name="occupationDate1" value="{{ old('occupationDate1') }}"  />
                    Departure Date :
                    <input data-date-format="dd-mm-yyyy" id="datepicker4" class="form-control" name="occupationDate2" value="{{ old('occupationDate2') }}"  />
                    </div>
                </div>

                <hr>

                <div class="form-group row">
                    <label for="name" class="col-form-label col-md-8">
                        1.6 The selling price for the timeshare module/week for which I/we want to sell is: (Including Vat)
                    </label>
                    <div class="col-md-4">
                         <input class="form-control" type="number" step="any" name="sellingPrice" placeholder="R" value="{{ old('sellingPrice') }}" />
                    </div>
                </div>

                <hr>

                <div class="form-group row">
                    <label for="name" class="col-form-label col-md-8">
                        1.7 Estate agent’s commission agreed to (state Rand value)
                    </label>
                    <div class="col-md-4">
                        <input class="form-control" type="number" step="any" name="commission" placeholder="R" value="{{ old('commission') }}" />
                    </div>
                </div>

                <hr>

                <div class="form-group row">
                        <label for="name" class="col-form-label col-md-8">
                            1.8 Mandate to sell timeshare
                        </label>
                        <div class="col-md-4">
                            <input class="form-control" type="file" name="mandate" value="{{ old('mandate') }}" />
                        </div>
                    </div>

                <button type="submit" class="btn btn-blue btn-lg">SUBMIT</button>

                <hr>

                <p>
                    * A listing fee of R380 including VAT is payable to list your timeshare week/module on the Uni-Vate website<br/>
                    <br>
                    <p style="text-align:center;">To rent your week out  <a href="https://www.tradeunipoint.com/" target="_blank" >click here</a></p>
                </p>
            </form>
        </div>
    </div>
</div>

<script>
        $(document).ready(function () {
            $("#resort").change(function () {
                var val = $(this).val();
                if (val == "Little Eden") {
                    $("#region").html("<option value='gauteng'>Gauteng</option>");
                } else if (val == "Manzi Monate") {
                    $("#region").html("<option value='gauteng'>Gauteng</option>");
                }
                else if (val == "Kagga Kamma Nature Reserve") {
                    $("#region").html("<option value='western cape'>Western Cape</option>");
                }
                else if (val == "Mabalingwe Nature Reserve") {
                    $("#region").html("<option value='limpopo'>Limpopo</option>");
                }
                else if (val == "Margate Beach Club") {
                    $("#region").html("<option value='Kwazulu Natal'>Kwazulu Natal</option>");
                }
                else if (val == "Sandy Place") {
                    $("#region").html("<option value='Kwazulu Natal'>Kwazulu Natal</option>");
                }
                else if (val == "Uvongo River Resort") {
                    $("#region").html("<option value='Kwazulu Natal'>Kwazulu Natal</option>");
                }
                else if (val == "Jackalberry Ridge") {
                    $("#region").html("<option value='mpumalanga'>Mpumalanga</option>");
                }
                else if (val == "Ngwenya Lodge") {
                    $("#region").html("<option value='mpumalanga'>Mpumalanga</option>");
                }
                else if (val == "Sudwala Lodge") {
                    $("#region").html("<option value='mpumalanga'>Mpumalanga</option>");
                }
                else if (val == "Verlorenkloof") {
                    $("#region").html("<option value='mpumalanga'>Mpumalanga</option>");
                }
            })
        }
        );

    </script>
    <script>
            $(document).ready(function(){
        $('#referedBy').change(function(){
            if($(this).val()=="Yes"){
                $(input[name="estateAgency"]).val('');
            }
            else if($(this).val()=="No"){
                $(input[name="estateAgency"]).val('Uni-Broker Resales');
            }
            
        });
    });
    </script>

    <script>
            $(document).ready(function(){
            
             $('#estateAgency').keyup(function(){ 
                var query = $(this).val();
                if(query != '')
                {
                    var _token = $('input[name="_token"]').val();
                    $.ajax({
                    url:"{{ route('autocomplete.fetch') }}",
                    method:"POST",
                    data:{query:query, _token:_token},
                    success:function(data){
                    $('#agencyList').fadeIn();  
                                $('#agencyList').html(data);
                    }
                    });
                }
                });
            
                $(document).on('click', 'li', function(){  
                    $('#estateAgency').val($(this).text());  
                    $('#agencyList').fadeOut();  
                });  
            
            });
    </script>
    <script>
        $(document).ready(function(){
        
         $('#agentName').keyup(function(){ 
            var query = $(this).val();
            var estateAgency = $('#estateAgency').val(); 
            if(query != '')
            {
                var _token = $('input[name="_token"]').val();
                $.ajax({
                url:"{{ route('autocompleteAgent.fetch') }}",
                method:"POST",
                data:{query:query, _token:_token, estateAgency},
                success:function(data){
                $('#agentList').fadeIn();  
                        $('#agentList').html(data);
                }
                });
                }
            });
        
            $(document).on('click', 'span', function(){  
                $('#agentName').val($(this).text());  
                $('#agentList').fadeOut();  
            });  
        
        }); 
</script>

@stop
