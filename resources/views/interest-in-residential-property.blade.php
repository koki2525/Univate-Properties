

<!DOCTYPE html>
<html lang="en-gb" dir="ltr"
	  class='com_content view-article itemid-122 j38 mm-hover'>

<head>
    @extends('master')

<link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
<title>Uni-vate Properties | Interested</title>


<link rel="stylesheet" href="css/style.css">
</head>

<body>

@include('partials.menu')
    

<div style="padding-left:0 !important;padding-right:0 !important;width: 100% !important;max-width: 100% !important;" id="t3-mainbody" class="t3-mainbody">
		<!-- MAIN CONTENT -->
        <br>
        <a href="/residential-property/{{ $property->id }}"><button style="margin-left:auto;margin-right:auto;display:block;background: #073364;border-radius: 3rem;"><i class="fa fa-caret-square-o-left" aria-hidden="true"></i> Back</button></a>
		
		<form id="mainForm" method="POST" action="/interest-in-residential-property/{{ $property->id }}" accept-charset="UTF-8" enctype="multipart/form-data">
        
			<h4 style="text-align:center;">Property Information</h4>

            <div class="row">
                <div class="large-4 columns">
                    <label style="font-weight:bolder;">Property Name</label>
                    {{ $property->name }}
                </div>
                <div class="large-4 columns">
                    <label style="font-weight:bolder;">Region & Town</label>
                    {{ ucfirst(trans($property->region)) }} | {{ $property->town }}
                </div>
                <div class="large-4 columns">
                    <label style="font-weight:bolder;">Price</label>
                     {{ $property->price }}
                </div>
            </div>

			<br>

			<div class="row">
				<div class="large-12 columns">
                    <label style="font-weight:bolder;">Description</label>
                    {{ $property->description }}
                </div>
			</div>

			<hr>
			
			<p style="text-align:center;">Please submit your contact details and a Uni-Vate agent will be in contact with you shortly  to assist with the property that you are interested in.</p>
                    
                        <div class="row">
                            <div class="large-6 columns">
                              <label>Name</label>
                              {{ Form::text('name') }}
                            </div>
                            <div class="large-6 columns">
                              <label>Email</label>
                              {{ Form::email('email') }}
                            </div>
                        </div>

                        <div class="row">
                            <div class="large-6 columns">
                              <label>Mobile</label>
                              {{ Form::text('mobile') }}
                            </div>
                            <div class="large-6 columns">
                              <label>Telephone</label>
                              {{ Form::text('phone') }}
                            </div>
                        </div>

                        <div class="row">
                            <button style="margin-left:auto;margin-right:auto;display:block;background: #083463;" id="submit" type="submit" class="brochure">SEND</button>
                        </div>
           </form>
</div> 

@include('partials.footer')

</body>

</html>