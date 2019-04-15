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
        <p>Dear Administrator</p>

        <p>Listing fee payment for a single timeshare listing from user {{ $user->name }} {{ $user->surname }} with email address {{ $user->email }} has been successfully payed through Pay Fast.</p>
        <p>Ref Number : TS{{ $user->id }}</p>

        <p>Timeshare details</p>

        @if($timeshare->resort=='Other')
        <p>Resort : {{ $timeshare->other }}</p>
        @else
        <p>Resort : {{ $timeshare->resort }}</p>
        @endif
        <p>Owner : {{ $timeshare->owner }}</p>
        <p>Unit : {{ $timeshare->unit }}</p>
        <p>Sleeps Max : {{ $timeshare->sleeps }}</p>
        <p>Module : {{ $timeshare->module }}</p>
        <p>Week   : {{ $timeshare->week }}</p>
        <p>Bedrooms : {{ $timeshare->bedrooms }}</p>
        <p>Season : {{ $timeshare->season }}</p>
        <p>Region : {{ $timeshare->region }}</p>
        <p>Asking Price : {{ $timeshare->price }}</p>
        <p>Region : {{ $timeshare->region }}</p>

        <p>Regards,<br>
        The Uni-Vate Properties Team
        </p>

        <img src="https://www.univateproperties.co.za/images/signature.png" />

    </body>
</html>
