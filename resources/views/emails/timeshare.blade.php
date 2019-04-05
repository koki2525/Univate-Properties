<html>
<head>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Calibri">
        <style>
            body {
                font-family:Calibri;
            }
        </style>
    </head>
    <body>
        <h1>New Timeshare Submission</h1>

        <h2>Details</h2>
        <p>Name : {{ $timeshare->names }}</p>
        <p>Email : {{ $timeshare->email }}</p>
        <p>Telephone   : {{ $timeshare->phone }}</p>
        <p>Mobile : {{ $timeshare->mobile }}</p>
        <hr>

        <h2>Timeshare Details</h2>
        @if($timeshare->resort=='Other')
        <p>Resort : {{ $timeshare->other }}</p>
        @else
        <p>Resort : {{ $timeshare->resort }}</p>
        @endif
        <p>Unit : {{ $timeshare->unit }}</p>
        <p>Sleeps Max : {{ $timeshare->sleeps }}</p>
        <p>Module : {{ $timeshare->module }}</p>
        <p>Week   : {{ $timeshare->week }}</p>
        <p>Bedrooms : {{ $timeshare->bedrooms }}</p>
        <p>Season : {{ $timeshare->season }}</p>
        <p>Region : {{ $timeshare->region }}</p>
        <p>Asking Price : {{ $timeshare->price }}</p>
        <p>Region : {{ $timeshare->region }}</p>
        <p>Arrival Date : {{  $timeshare->fromDate }}</p>
        <p>Departure Date : {{  $timeshare->toDate }}</p>

        <h2>Share Transfer Information</h2>
        <p>Were you referred by an agent? : {{ $seller->referedBy }}</p>
        @if($seller->referedBy=='Yes')
        <p>Agent Name : {{ $seller->agentName }}</p>
        <p>Agency Name : {{ $seller->agencyName }}</p>
        @endif
        <p>All Levy Amounts for the current cycle have been paid in full : {{ $seller->paid }}</p>
        <p>My week is Space banked for the current year:  : {{ $seller->spaceBanked }}</p>
        <p>My week is placed for Rental this year   : {{ $seller->rental }}</p>
        <p>I/We bought the timeshare module/week on the following date   : {{ $seller->date }}</p>
        <p>Current year occupation date : {{ $seller->occupationDate1 }} to {{ $seller->occupationDate1 }}
        <p>The Purchase Price for which I/We bought timeshare module/week was  : {{ $seller->purchasePrice }}</p>
        <p>The Selling Price for the timeshare module/week for which I/We want to sell is (Including Vat) : {{ $seller->sellingPrice }}</p>
        <p>Name of Estate Agency  : {{ $seller->estateAgency }}</p>
        <p>Estate Agent’s commission agreed to (state Rand value) : {{ $seller->commission }}</p>

        <hr>

        <p>Regards,<br>
        The Uni-Vate Properties Team
        </p>

        <img src="https://www.univateproperties.co.za/images/signature.png" />

    </body>
</html>
