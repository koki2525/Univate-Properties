@extends('master')

@section('title', 'Resort' )

@section('description')@stop

@section('keywords')@stop

@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-7 offset-md-1">
            <h1 style="text-align: -webkit-right;" class="my-4">Timeshares to buy</h1>
        </div>
    </div>
    <div class="row">
            <div class="col-md-3 pl-3 pl-md-5 sidebar">
                    @include('partials.filter2')
                </div>
        <div class="col-md-9 offset-md-0">
           
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                                
                        </div> 
                    <table style="font-size: 12px;" class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr>
                                <th>Resort</th>
                                <th><span>Unit</span></th>
                                <th><span>Week</span></th>
                                <th><span>Module</span></th>
                                <th><span>Bedrooms</span></th>
                                <th><span>Season</span></th>
                                <th><span>Arrival</span></th>
                                <th><span>Departure</span></th>
                                <th><span>Price inc VAT</span></th>
                                <th><span>Status</span></th>
                                <th><span>Interested?</span></th>
                            </tr>
                        </thead>
                        <tbody>
                        @if($timeshares)
                            @foreach($timeshares as $timeshare)
                            <tr>
                                <td><a href="/resort"><a href="/resort/{{ $timeshare->resort }}">{{ $timeshare->resort }}</a></td>
                                <td><span data-unit="{{ $timeshare->unit }}">{{ $timeshare->unit }}</span></td>
                                <td><span data-week="{{ $timeshare->week }}">{{ $timeshare->week }}</span></td>
                                <td><span data-module="{{ $timeshare->module }}">{{ $timeshare->module }}</span></td>
                                <td><span data-bedrooms="{{ $timeshare->bedrooms }}">{{ $timeshare->bedrooms }}</span></td>
                                <td><span data-season="{{ $timeshare->season }}">{{ $timeshare->season }}</span></td>
                                @if($timeshare->fromDate==NULL)
                                <td> - </td>
                                @else
                                <td>{{ \Carbon\Carbon::parse($timeshare->fromDate)->format('jS F Y') }}</td>
                                @endif
                                @if($timeshare->toDate==NULL)
                                <td> - </td>
                                @else
                                <td><span data-season="">{{ \Carbon\Carbon::parse($timeshare->toDate)->format('jS F Y') }}</span></td>
                                @endif
                                <td><span data-setPrice="{{ $timeshare->setPrice }}">R{{ number_format($timeshare->setPrice, 2) }}</span></td>
                                <td><span data-status="{{ $timeshare->status }}">{{ $timeshare->status }}</span></td>
                                <td><a  href="/timeshare-enquiry/{{ $timeshare->id }}" ><i class="fa fa-flag" aria-hidden="true"></i> Yes</a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @endif
                </div>
                <div class="col-md-12 mb-4">
                    <a class="btn btn-blue" href="/to-buy">Back to Regions</a>
                </div>
            </div>

            
        </div>
        
    </div>
</div>

<!-- interested -->
@include('partials.interested')

<script>
        $(document).ready(function () {
            $("#region").change(function () {
                var val = $(this).val();
                if (val == "gauteng") {
                    $("#resort").html("<option value=''>Please Select</option><option value='Little Eden'>Little Eden</option><option value='Little Eden'>Manzi Monate</option>");
                } else if (val == "western cape") {
                    $("#resort").html("<option value=''>Please Select</option><option value='Kagga Kamma Nature Reserve'>Kagga Kamma Nature Reserve</option>");
                }
                else if (val == "limpopo") {
                    $("#resort").html("<option value=''>Please Select</option><option value='Mabalingwe Nature Reserve'>Mabalingwe Nature Reserve</option>");
                }
                else if (val == "Kwazulu Natal") {
                    $("#resort").html("<option value=''>Please Select</option><option value='Margate Beach Club'>Margate Beach Club</option><option value='Sandy Place'>Sandy Place</option><option value='Uvongo River Resort'>Uvongo River Resort</option>");
                }
                else if (val == "mpumalanga") {
                    $("#resort").html("<option value=''>Please Select</option><option value='Jackalberry Ridge'>Jackalberry Ridge</option><option value='Ngwenya Lodge'>Ngwenya Lodge</option><option value='Sudwala Lodge'>Sudwala Lodge</option><option value='Verlorenkloof'>Verlorenkloof</option>");
                }
                else if (val == "North West") {
                    $("#resort").html("<option value=''>Please Select</option><option value='Mount Amanzi'>Mount Amanzi</option>");
                }
                else {
                    $("#resort").html("<option value=''>Please Select</option><option value='Little Eden'>Little Eden</option><option value='Little Eden'>Manzi Monate</option><option value='Kagga Kamma Nature Reserve'>Kagga Kamma Nature Reserve</option><option value='Mabalingwe Nature Reserve'>Mabalingwe Nature Reserve</option><option value='Margate Beach Club'>Margate Beach Club</option><option value='Sandy Place'>Sandy Place</option><option value='Uvongo River Resort'>Uvongo River Resort</option><option value='Jackalberry Ridge'>Jackalberry Ridge</option><option value='Ngwenya Lodge'>Ngwenya Lodge</option><option value='Sudwala Lodge'>Sudwala Lodge</option><option value='Verlorenkloof'>Verlorenkloof</option><option value='Mount Amanzi'>Mount Amanzi</option>");
                }
            })
        }
        );
</script>

@stop
