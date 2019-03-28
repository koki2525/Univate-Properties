@extends('master')

@section('title', 'Timeshare Resales')

@section('description', 'Uni-Vate Properties is a reputable and reliable timeshare reseller, equipped with the best experience and knowledge in providing customers of fast, efficient and personal service.')

@section('keywords', 'Timeshare selling, where to sell my timeshare, Uni-Vate Properties, Uni-Vate timeshare, timeshare for sale, tender weeks available, sell my tender week')

@section('content')
<div class="container">

    <div class="row">
        <div class="col-md-12">
            <h1 class="my-4">Timeshare Resales</h1>
        </div>
        <div class="col-md-8">
            <p>
                Uni-Vate Properties found that there was a desperate need for a reputable source for buyers and sellers to turn to with their timeshare needs in South Africa. Over the years, Uni-Vate has developed a treasure of networking alliances of professional acquaintances and that has made timeshare resales a pleasure for both buyers and sellers. We are fully equipped to assist with conventional timeshare requirements and assure you of fast, efficient and personal service.
            </p>
            <p>
                We strive to legitimize an industry that has fallen victim to scam artists and unscrupulous sales tactics. Your best option for buying or selling a timeshare resale week is through a real-estate company where an agent is able to assist you with the sale from point of offer, to negotiation, to conclusion, to successful payment and transfer.
            </p>

            <p class="blue-bg p-2 p-md-4">
                Our goal for our sellers is to obtain the best price the market will bear for their week/s. We do this by continually evaluating our marketplace, educating the consumer, and encouraging sellers to price their properties at competitive prices. This ensures buyers of well researched data to be able to make informed decisions about their purchase which will provide their families with hassle free future holidays.
            </p>
            <p>
                Uni-Vate Properties facilitates the timeshare resale for a listing fee of only R380 including VAT payable when listing your week/module. Transfer fees vary per week depending on the share block but this will be confirmed on request when making an offer on an interested week. Transfer fees are payable by the buyers. List your week for sale or browse our already listed weeks available for easy access to creating new holiday memories for the whole family.
            </p>
        </div>
        <div class="col-md-4 text-center">
            <p><img class="img-fluid" src="{{ asset('/images/resale-banner.jpg') }}" alt="About Resale"></p>
        </div>
    </div>
    
    <hr />

    <div class="row text-center mb-4">
        <div class="col-md-3">
            <p><img class="img-fluid" src="{{ asset('/images/logos/DAE_logo_notag.png') }}" alt="Logo" /></p>
        </div>
        <div class="col-md-3">
            <p><img class="img-fluid" src="{{ asset('/images/logos/TUP-logo.png') }}" alt="Logo" /></p>
        </div>
        <div class="col-md-3">
            <p><img class="img-fluid" src="{{ asset('/images/logos/RCI.png') }}" alt="Logo" /></p>
        </div>
        <div class="col-md-3">
            <p><img class="img-fluid" src="https://www.univateproperties.co.za/images/logos/voasa.png" alt="Logo" /></p>
        </div>
    </div>
</div>
@stop