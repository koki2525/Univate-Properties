@extends('master')

@section('title', 'To Buy')

@section('description', 'Uni-Vate Properties provides a reliable platform from which to advertise and purchase tender weeks within the timeshare industry.')

@section('keywords', 'Timeshare buying, where to buy timeshare, Uni-Vate Properties, Uni-Vate timeshare, timeshare to buy, tender weeks available, purchase a tender week')

@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<div class="container">
    <div class="row">
            <div class="col-md-3 pl-3 pl-md-5 sidebar">
                <br>
                @include('partials.filter2')
                <br>
            </div>
        <div class="col-md-9 offset-md-0">
                <div class="row">
        <div class="col-md-12"> 
            <h1 class="my-4">To Buy</h1>
            <p>
                The resorts have been listed in their relevant provinces. Please select the resort for which you would like to view the available weeks and then select the weeks that interest you on the resort page.
            </p>
            
            <p>Arrival and departure dates are indicated but please note that these dates may vary annually.</p>
 
            <p>As with any property related sale, upon purchasing the holiday of your choice, there will be a transfer fee payable for the change of ownership. This fee will depend on the relevant resort or managing agent.</p>
        
        </div>
    </div>
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="accordion" id="accordionExample">
                @if($gauteng!=NULL)
                <div class="card">
                    <a class="btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        <div class="card-header" id="headingOne">
                            <h2 class="mb-0">
                                Gauteng
                            </h2>
                        </div>
                    </a>

                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                        <div class="card-body">
                            <p class="mb-0">
                                @foreach($gauteng as $resort)
                                    <a class="text-capitalize" href="/resort/{{ $resort->slug }}"> - {{  $resort->resort }}</a><br/>
                                @endforeach
                            </p>
                        </div>
                    </div>
                </div>
                @endif
                @if($westerncape!=NULL)
                <div class="card">
                    <a class="btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        <div class="card-header" id="headingTwo">
                            <h2 class="mb-0">
                                Western Cape
                            </h2>
                        </div>
                    </a>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                        <div class="card-body">
                            <p class="mb-0">
                                @foreach($westerncape as $resort)
                                    <a class="text-capitalize" href="/resort/{{ $resort->slug }}"> - {{ $resort->resort }}</a><br/>
                                @endforeach
                            </p>
                        </div>
                    </div>
                </div>
                @endif
                @if($limpopo!=NULL)
                <div class="card">
                    <a class="btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        <div class="card-header" id="headingThree">
                            <h2 class="mb-0">
                                Limpopo
                            </h2>
                        </div>
                    </a>
                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                        <div class="card-body">
                            <p class="mb-0">
                                @foreach($limpopo as $resort)
                                    <a class="text-capitalize" href="/resort/{{ $resort->slug }}"> - {{ $resort->resort }}</a><br/>
                                @endforeach
                            </p>
                        </div>
                    </div>
                </div>
                @endif
                @if($kwazulunatal!=NULL)
                <div class="card">
                    <a class="btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                        <div class="card-header" id="headingFour">
                            <h2 class="mb-0">
                                Kwazulu Natal
                            </h2>
                        </div>
                    </a>
                    <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionExample">
                        <div class="card-body">
                            <p class="mb-0">
                                @foreach($kwazulunatal as $resort)
                                    <a class="text-capitalize" href="/resort/{{ $resort->slug }}"> - {{ $resort->resort }}</a><br/>
                                @endforeach
                            </p>
                        </div>
                    </div>
                </div>
                @endif
                @if($northerncape!=NULL)
                <div class="card">
                    <a class="btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                        <div class="card-header" id="headingFive">
                            <h2 class="mb-0">
                                Northern Cape
                            </h2>
                        </div>
                    </a>
                    <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordionExample">
                        <div class="card-body">
                            <p class="mb-0">
                                @foreach($northerncape as $resort)
                                    <a class="text-capitalize" href="/resort/{{ $resort->slug }}"> - {{ $resort->resort }}</a><br/>
                                @endforeach
                            </p>
                        </div>
                    </div>
                </div>
                @endif
                @if($mpumalanga!=NULL)
                <div class="card">
                    <a class="btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                        <div class="card-header" id="headingSix">
                            <h2 class="mb-0">
                                Mpumalanga
                            </h2>
                        </div>
                    </a>
                    <div id="collapseSix" class="collapse" aria-labelledby="headingSix" data-parent="#accordionExample">
                        <div class="card-body">
                            <p class="mb-0">
                                @foreach($mpumalanga as $resort)
                                    <a class="text-capitalize" href="/resort/{{ $resort->slug }}"> - {{ $resort->resort }}</a><br/>
                                @endforeach
                            </p>
                        </div>
                    </div>
                </div>
                @endif
                @if($northwest!=NULL)
                <div class="card">
                    <a class="btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                        <div class="card-header" id="headingSeven">
                            <h2 class="mb-0">
                                North West
                            </h2>
                        </div>
                    </a>
                    <div id="collapseSeven" class="collapse" aria-labelledby="headingSeven" data-parent="#accordionExample">
                        <div class="card-body">
                            <p class="mb-0">
                                @foreach($northwest as $resort)
                                    <a class="text-capitalize" href="/resort/{{ $resort->slug }}"> - {{ $resort->resort }}</a><br/>
                                @endforeach
                            </p>
                        </div>
                    </div>
                </div>
                @endif
                @if($easterncape!=NULL)
                <div class="card">
                    <a class="btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseEight" aria-expanded="false" aria-controls="collapseEight">
                        <div class="card-header" id="headingEight">
                            <h2 class="mb-0">
                                Eastern Cape
                            </h2>
                        </div>
                    </a>
                    <div id="collapseEight" class="collapse" aria-labelledby="headingEight" data-parent="#accordionExample">
                        <div class="card-body">
                            <p class="mb-0">
                                @foreach($easterncape as $resort)
                                    <a class="text-capitalize" href="/resort/{{ $resort->slug }}"> - {{ $resort->resort }}</a><br/>
                                @endforeach
                            </p>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
    </div>
    </div>
</div>

<script>
        $(document).ready(function () {
            $("#region").change(function () {
                var val = $(this).val();
                if (val == "gauteng") {
                    $.getJSON("https://www.tradeunipoint.com/unibackend/seam/resource/rest/products/resorts/GA/", function(json){
                        $('#resort').empty();
                        $('#resort').append($('<option>').text("Resort"));
                        $.each(json, function(i, obj){
                                $('#resort').append($('<option>').text(obj.resortName).attr('value', obj.resortName));
                        });
                    });
                }
                
                else if (val == "western cape") {
                    $.getJSON("https://www.tradeunipoint.com/unibackend/seam/resource/rest/products/resorts/WC/", function(json){
                        $('#resort').empty();
                        $('#resort').append($('<option>').text("Resort"));
                        $.each(json, function(i, obj){
                                $('#resort').append($('<option>').text(obj.resortName).attr('value', obj.resortName));
                        });
                    });
                }
                
                else if (val == "limpopo") {
                    $.getJSON("https://www.tradeunipoint.com/unibackend/seam/resource/rest/products/resorts/LI/", function(json){
                        $('#resort').empty();
                        $('#resort').append($('<option>').text("Resort"));
                        $.each(json, function(i, obj){
                                $('#resort').append($('<option>').text(obj.resortName).attr('value', obj.resortName));
                        });
                    });
                }
                
                else if (val == "Kwazulu Natal") {
                    $.getJSON("https://www.tradeunipoint.com/unibackend/seam/resource/rest/products/resorts/KZN/", function(json){
                        $('#resort').empty();
                        $('#resort').append($('<option>').text("Resort"));
                        $.each(json, function(i, obj){
                                $('#resort').append($('<option>').text(obj.resortName).attr('value', obj.resortName));
                        });
                    });
                }
                
                else if (val == "mpumalanga") {
                    $.getJSON("https://www.tradeunipoint.com/unibackend/seam/resource/rest/products/resorts/MP/", function(json){
                        $('#resort').empty();
                        $('#resort').append($('<option>').text("Resort"));
                        $.each(json, function(i, obj){
                                $('#resort').append($('<option>').text(obj.resortName).attr('value', obj.resortName));
                        });
                    });
                }
                
                else if (val == "North West") {
                    $.getJSON("https://www.tradeunipoint.com/unibackend/seam/resource/rest/products/resorts/NW/", function(json){
                        $('#resort').empty();
                        $('#resort').append($('<option>').text("Resort"));
                        $.each(json, function(i, obj){
                                $('#resort').append($('<option>').text(obj.resortName).attr('value', obj.resortName));
                        });
                    });
                }
                
                else if (val == "eastern cape") {
                    $.getJSON("https://www.tradeunipoint.com/unibackend/seam/resource/rest/products/resorts/EC/", function(json){
                        $('#resort').empty();
                        $('#resort').append($('<option>').text("Resort"));
                        $.each(json, function(i, obj){
                                $('#resort').append($('<option>').text(obj.resortName).attr('value', obj.resortName));
                        });
                    });
                }
                else if (val == "free state") {
                    $.getJSON("https://www.tradeunipoint.com/unibackend/seam/resource/rest/products/resorts/FS/", function(json){
                        $('#resort').empty();
                        $('#resort').append($('<option>').text("Resort"));
                        $.each(json, function(i, obj){
                                $('#resort').append($('<option>').text(obj.resortName).attr('value', obj.resortName));
                        });
                    });
                }
                else if (val == "northern cape") {
                    $.getJSON("https://www.tradeunipoint.com/unibackend/seam/resource/rest/products/resorts/NC/", function(json){
                        $('#resort').empty();
                        $('#resort').append($('<option>').text("Resort"));
                        $.each(json, function(i, obj){
                                $('#resort').append($('<option>').text(obj.resortName).attr('value', obj.resortName));
                        });
                    });
                }
                else {
                   // $("#resort").html("<option value=''>Please Select</option><option value='Little Eden'>Little Eden</option><option value='Little Eden'>Manzi Monate</option><option value='Kagga Kamma Nature Reserve'>Kagga Kamma Nature Reserve</option><option value='Mabalingwe Nature Reserve'>Mabalingwe Nature Reserve</option><option value='Margate Beach Club'>Margate Beach Club</option><option value='Sandy Place'>Sandy Place</option><option value='Uvongo River Resort'>Uvongo River Resort</option><option value='Jackalberry Ridge'>Jackalberry Ridge</option><option value='Ngwenya Lodge'>Ngwenya Lodge</option><option value='Sudwala Lodge'>Sudwala Lodge</option><option value='Verlorenkloof'>Verlorenkloof</option><option value='Mount Amanzi'>Mount Amanzi</option>");
                   
                   $.getJSON("https://www.tradeunipoint.com/unibackend/seam/resource/rest/products/resorts/list/", function(json){
                    $('#resort').empty();
                    $('#resort').append($('<option>').text("Resort"));
                    $.each(json, function(i, obj){
                            $('#resort').append($('<option>').text(obj.resortName).attr('value', obj.resortName));
                    });
            });

                }
            })
        }
        );
</script>
<script>
        $(document).ready(function(){
        
         $('#estateAgency').keyup(function(){ 
            var query = $(this).val();
            if(query != '')
            {
                var _token = $('input[name="_token"]').val();
                $.ajax({
                url:"{{ route('autocompleteResortList.fetch') }}",
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
@stop