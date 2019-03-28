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
        <h1>Interested in Lombardy Business Park Unit</h1>

        <h2>Details</h2>
        <p>Name : {{ $interested->name }}</p>
        <p>Email : {{ $interested->email }}</p>
        <p>Contact Number   : {{ $interested->mobile }}</p>
        <hr>

        <h2>Unit Details</h2>
        <p>Name : {{ $unit->name }}</p>
        <p>Unit : {{ $unit->unit }}</p>
        <p>Price   : {{ $unit->price }}</p>
        <p>Size : {{ $unit->size }}</p>

        <p>Regards,<br>
        The Uni-Vate Properties Team
        </p>

        <img src="https://www.univateproperties.co.za/images/signature.png" />      

    </body>
</html>
