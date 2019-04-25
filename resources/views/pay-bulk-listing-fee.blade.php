@extends('master')

@section('title', 'Pay bulk listing fee')

@section('description', 'Uni-Vate Properties provides a reliable platform from which to advertise and sell tender weeks within the timeshare industry.')

@section('keywords', 'Timeshare selling, where to sell my timeshare, Uni-Vate Properties, Uni-Vate timeshare, timeshare for sale, tender weeks available, sell my tender week')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1 class="my-4">Pay Listing Fee</h1>
            <p>
                    * A listing fee of R {{ $total }} including VAT is payable to list your timeshare week/module on the Uni-Vate website.
            </p>
            <a href="https://www.payfast.co.za/eng/process?cmd=_paynow&amp;receiver=13595896&amp;item_name=Bulk+Timeshare+Listing+Fee&amp;item_description=A+listing+fee+including+VAT+is+payable+to+list+your+timeshare+week%2Fmodule+on+the+Uni-Vate+website.&amp;amount={{ $total }}&amp;return_url=https%3A%2F%2Fwww.univateproperties.co.za%2Fsuccessful-payment&amp;cancel_url=https%3A%2F%2Fwww.univateproperties.co.za"><img src="https://www.payfast.co.za/images/buttons/light-small-paynow.png" width="165" height="36" alt="Pay" title="Pay Now with PayFast" /></a>
            <br><br><br><br><br><br><br><br><br>
        </div>
    </div>
    
</div>

@stop