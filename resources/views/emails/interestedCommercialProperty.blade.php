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
        <h1>Interested in Commercial Property</h1>

        <h2>Details</h2>
        <p>Name : {{ $interested->name }}</p>
        <p>Email : {{ $interested->email }}</p>
        <p>Telephone   : {{ $interested->phone }}</p>
        <p>Mobile : {{ $interested->mobile }}</p>
        <hr>

        <h2>Property Details</h2>
        <p>Property : {{ $property->name }}</p>
        <p>For : {{ $property->for }}</p>
        <p>Price   : {{ $property->price }}</p>
        <p>Size : {{ $property->size }}</p>
        <p>Description : {{ $property->description }}</p>
        <p>Region : {{ $property->region }}</p>
        <p>Town : {{ $property->town }}</p>

        <p>Regards,<br>
        The Uni-Vate Properties Team
        </p>

        <img src="https://www.univateproperties.co.za/images/signature.png" />      

    </body>
</html>
