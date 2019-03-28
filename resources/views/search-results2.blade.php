@extends('master')


<div class="row">
	<div class="large-3 columns">
		<img style="max-width: 200%;margin-left: -13rem;" src="/old/images/UniVate_properties_png_logo.png" alt="" />
	</div>
	<div class="large-9 columns">
			<p style="font-size: 400%;margin-top: 2rem; font-family:Tangerine;text-align:center;line-height: 0.9;"><em>Travelling in the company of those we love is home in motion</em></p>
	</div>
 </div>


@include('partials.menu')

<h1>Search Results</h1>

@if($residentialRentals!=NULL)
<div class="row">
    <div class="large-3 columns">
        <img src="{{ $residentialRentals->image }}" />  
    </div>
    <div class="large-9 columns">
    <h4>{{ $residentialRentals->name }}</h4>
        <p>{{ $residentialRentals->description }}</p>
    </div>
</div>
@endif

@include('partials.footer')