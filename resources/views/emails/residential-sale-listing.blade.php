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
        <h1>New Residential Property Sale Listing</h1>

        <h2>Contact Person Details</h2>
        <p>Name : {{ $residential->contact_person }}</p>
        <p>Email : {{ $residential->contact_email }}</p>
        <p>Contact Number   : {{ $residential->contact_mobile }}</p>
        <hr>

        <h2>Property Details</h2>
        <p>Name : {{ $residential->name }}</p>
        <p>Reference Number : {{ $residential->ref }}</p>
        <p>Region   : {{ $residential->region }}</p>
        <p>Town : {{ $residential->town }}</p>
        <p>Surburb : {{ $residential->surburb }}</p>
        <p>Property Type : {{ $residential->propertType }}</p>
        <p>Property Size : {{ $residential->size }}</p>
        <p>Bedrooms : {{ $residential->bedrooms }}</p>
        <p>Bathrooms : {{ $residential->bathrooms }}</p>
        <p>Description : {{ $residential->description }}</p>

        <p>Regards,<br>
        The Uni-Vate Properties Team
        </p>

        <img src="https://www.univateproperties.co.za/images/signature.png" />      

    </body>
</html>
