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
        <h1>Interested in Timeshare</h1>

        <h2>Details</h2>
        <p>Name : {{ $interested->name }}</p>
        <p>Email : {{ $interested->email }}</p>
        <p>Telephone   : {{ $interested->mobile }}</p>
        <hr>

        <h2>Timeshare Details</h2>
        <p>Resort : {{ $timeshare->resort }}</p>
        <p>Module : {{ $timeshare->module }}</p>
        <p>Week   : {{ $timeshare->week }}</p>
        <p>Bedrooms : {{ $timeshare->bedrooms }}</p>
        <p>Season : {{ $timeshare->season }}</p>
        <p>Region : {{ $timeshare->region }}</p>
        <p>Price : {{ $timeshare->price }}</p>

        <p>Regards,<br>
        The Uni-Vate Properties Team
        </p>

        <img src="https://www.univateproperties.co.za/images/signature.png" />      

    </body>
</html>
