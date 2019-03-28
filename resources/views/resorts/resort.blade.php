@extends('master')

@section('title', '{{ $details['prName'] }}')

@section('description', '')

@section('keywords', '')

@section('content')
<div class="container">

    <div class="row">
        <div class="col-md-12">
            <h1 class="my-4">FAQs</h1>
        </div>
    </div>

	<script type="application/json" class="joomla-script-options new">{"csrf.token":"d9c71cdb4667d9f2730428a8f1ba0be9","system.paths":{"root":"\/old","base":"\/old"},"rl_modals":{"class":"modal_link","defaults":{"opacity":"0.8","width":"700","height":"400","maxWidth":"95%","maxHeight":"95%","current":"{current} \/ {total}","previous":"previous","next":"next","close":"close","xhrError":"This content failed to load.","imgError":"This image failed to load."},"auto_correct_size":1,"auto_correct_size_delay":0},"system.keepalive":{"interval":840000,"uri":"\/old\/index.php\/component\/ajax\/?format=json"},"joomla.jtext":{"REQUIRED_FILL_ALL":"Please enter data in all fields.","E_LOGIN_AUTHENTICATE":"Username and password do not match or you do not have an account yet.","REQUIRED_NAME":"Please enter your name!","REQUIRED_USERNAME":"Please enter your username!","REQUIRED_PASSWORD":"Please enter your password!","REQUIRED_VERIFY_PASSWORD":"Please re-enter your password!","PASSWORD_NOT_MATCH":"Password does not match the verify password!","REQUIRED_EMAIL":"Please enter your email!","EMAIL_INVALID":"Please enter a valid email!","REQUIRED_VERIFY_EMAIL":"Please re-enter your email!","EMAIL_NOT_MATCH":"Email does not match the verify email!","CAPTCHA_REQUIRED":"Please enter captcha key"}}</script>


<h1>{{ $details['prName'] }}</h1>
<div class="row">
<div class="large-4 colums">
  <p></p>
    <p></p>
    <p></p>
</div>

<div class="large-4 colums">
<table style="margin-left: -9rem;" id="keywords" cellspacing="0" cellpadding="0">
    <thead>
      <tr>
        <th><span>Resort</span></th>
        <th><span>Unit Number</span></th>
        <th><span>Week Number</span></th>
        <th><span>Module</span></th>
        <th><span>Bedrooms</span></th>
        <th><span>Season</span></th>
        <th><span>Price</span></th>
        <th><span>Status</span></th>
        <th><span>Interested</span></th>
      </tr>
    </thead>
    <tbody>
	@foreach($timeshares as $timeshare)
      <tr>
        <td class="lalign">{{ $timeshare->resort }}</td>
        <td>{{ $timeshare->unit }}</td>
        <td>{{ $timeshare->week }}</td>
        <td>{{ $timeshare->module }}</td>
        <td>{{ $timeshare->bedrooms }}</td>
        <td>{{ $timeshare->season }}</td>
		    <td>R {{ $timeshare->setPrice }}</td>
        <td>{{ $timeshare->status }}</td>
		<td><a href="/interested/{{ $timeshare->id }}"><i class="fa fa-flag" aria-hidden="true"></i></a></td>
      </tr>
	  @endforeach
    </tbody>
  </table>

  <?php echo $timeshares->links(); ?>

  <div class="row">
    <div class="large-12 columns">
    <a href="/to-buy"><button style="margin-left:auto;margin-right:auto;display:block;">Back to Regions</button></a>

    </div>
  
  </div>

</div>
  <div class="large-4 colums">
    <p></p>
    <p></p>
    <p></p>
  </div>
</div>

<div class="row">
    <div class="large-6 columns">
        <img style="width: 100%;" src="{{ $resort->image1 }}" />
    </div>
    <div class="large-6 columns">
    <img style="width: 100%;" src="{{ $resort->image2 }}" />
    </div>
</div>

    <div class="row">
      <div class="large-12 columns">
      <p>{{ $resort->information }}</p>
      </div>
</div>

<div style="margin-bottom: 3rem !important;" class="row">
  <div class="large-12 columns">
      <div class="tabs">
      <input type="radio" name="tabs" id="tabone" checked="checked">
      <label for="tabone">Resort LayOut</label>
      <div class="tab">
        <img src="/images/resort_layouts/little-eden.jpg" />
      </div>
      
      <input type="radio" name="tabs" id="tabtwo">
      <label for="tabtwo">Directions</label>
      <div class="tab">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3598.84482660366!2d28.57348355078195!3d-25.576828844892443!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1e955632ffc327ff%3A0x4af94419c97e91ff!2sLittle+Eden+Resort!5e0!3m2!1sen!2sza!4v1538397512607" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
      </div>
      
    </div>
  </div>
</div>

<div style="margin-bottom: 5rem !important;" class="row">

@if($resort->advisor!=NULL)
    <div class="large-4 columns">
      <a target="_blank" href="{{ $resort->advisor }}"><img style="width:40%;" src="/images/awards/2018_COE_Logos_white-bkg_translations_en-US-UK.JPG" /></a>     
    </div>
@endif

@foreach($awards as $award)

@if($award=='Gold Crown')
<div class="large-4 columns">
  <img style="margin-left: -33rem;width: 50%;margin-top: 1rem;" src="/images/awards/2011-Gold-Crown-Logo.png" />
</div>
@endif
@if($award=='RCI Hospitality')
@if($resort->advisor!=NULL)
<div class="large-4 columns">
  <img style="margin-left: -33rem;;width: 60%;" src="/images/awards/RCI_hospitality.jpg" />
</div>

@else
<div class="large-4 columns">
  <img style="margin-left: -1rem;;width: 60%;" src="/images/awards/RCI_hospitality.jpg" />
</div>
@endif
@endif
@if($award=='Silver Crown')
<div class="large-4 columns">
  <img style="width: 50%;" src="/images/awards/2011 Silver Crown Logo.png" />
</div>
@endif

@endforeach

</div>

</body>

</html>

@stop