@extends('master')

@section('title', 'About')

@section('description', 'Meeting the property needs of consumers is at the heart of what we do; whether it is helping an owner transition out of their property ownership, or helping the buyer find the property they have been looking for.')

@section('keywords', 'Uni-Vate Properties, buy and sell property, timeshare availability, where to sell my timeshare, residential property sales, commercial property sales')

@section('content')
<div class="container">

    <div class="row">
        <div class="col-md-12">
            <h1 class="my-4">About Us</h1>
        </div>
        <div class="col-md-8">
            <p class="blue-text large-text">
            Uni-Vate Properties (Pty) Ltd began in 2013 in Pretoria East with various properties in their portfolio. Led by our Director, Delia O' Conner, who has over 25 years of experience in the timeshare industry, the move to conventional property sales and rentals was an easy transition for the Uni-Vate team.
            </p>
            <p>
            To date the team have processed many sales in the residential, share block and commercial arenas within South Africa and are currently involved in the rental and management of 40 commercial and 15 residential properties. The Uni-Vate support team consists of three highly qualified and experienced staff, who have thirteen years' joint experience in the timeshare and property industry.
            </p>
            <p>
            Owners seeking to sell their property understand the power of internet marketing and the sophistication of target marketing to consumers who have shown an interest in buying property.
            Buyers can save by purchasing from owners advertising their property for sale through Uni-Vate, using their website.
            Sellers across SA are able to list properties for a listing fee of R380 per property listing which gives them exposure not only on the website, but on social media sites also.
            </p>
            <p class="blue-bg p-2 p-md-4">
            Uni-Vate Properties is affiliated to the Estate Agents Board (EAAB) and also to the Institute of Estate Agents South Africa (IEASA) and operates in compliance with the Estate Agents Code of Conduct. This assures our clients of professional, ethical and fair service at all times.
            </p>
            <p>
            Meeting the property needs of consumers is at the heart of what we do; whether it is helping an owner transition out of their property ownership, or helping the buyer find the property they have been looking for.
            </p>
            <p>
            So whether you would like to sell or rent out your: timeshare, home, industrial, commercial, or vacant property or whether you would like to buy or rent a: timeshare, home, industrial, commercial, or vacant property; Uni-Vate is able to assist you.
            </p>
        </div>
        <div class="col-md-4 text-center">
            <p><img class="img-fluid" src="{{ asset('/images/about-banner.jpg') }}" alt="About Us"></p>
        </div>
    </div>

    <hr />
    
    <div class="row text-center mb-4">
        <div class="col-md-4">
            <p><img class="img-fluid" src="{{ asset('/images/logos/nama.png') }}" alt="Logo" /></p>
        </div>
        <div class="col-md-4">
            <p><img class="img-fluid" src="{{ asset('/images/logos/IEASA-logo.png') }}" alt="Logo" /></p>
        </div>
        <div class="col-md-4">
            <p><img class="img-fluid" src="{{ asset('/images/logos/eaab.png') }}" alt="Logo" /></p>
        </div>
    </div>  
</div>
@stop