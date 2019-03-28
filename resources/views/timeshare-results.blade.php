@extends('master')

@section('title')
     Timeshare search results
@stop

@section('styles')
<style>

</style>
@stop

@section('content')

@include('partials.menu')

<h1 style="text-align:center;">Timeshare search Results</h1>

<div class="row">

<div class="large-12 colums">
<table id="keywords" style="max-width: 100%;width: 100%;" cellspacing="0" cellpadding="0">
    <thead>
      <tr>
        <th><span>Resort</span></th>
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
        <td>{{ $timeshare->week }}</td>
        <td>{{ $timeshare->module }}</td>
        <td>{{ $timeshare->bedrooms }}</td>
        <td>{{ $timeshare->season }}</td>
		    <td>R {{ $timeshare->price }}</td>
        <td>{{ $timeshare->status }}</td>
		<td><a href="/interested/{{ $timeshare->id }}"><i class="fa fa-flag" aria-hidden="true"></i></a></td>
      </tr>
	  @endforeach
    </tbody>
  </table>
  </div>
  </div>

<div class="row">
    <div class="large-12 columns">
        <?php echo $timeshares->links(); ?>
    </div>
</div>

  <div class="row">
    <div class="large-12 columns">
    <a href="/commercial"><button style="margin-left:auto;margin-right:auto;display:block;">Back</button></a>

    </div>
  
  </div>

@include('partials.footer')

@stop