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
        <h1>New Commercial Property Sale Listing</h1>

        <h2>Contact Person Details</h2>
        <p>Name : {{ $commercial->contact_person }}</p>
        <p>Email : {{ $commercial->contact_email }}</p>
        <p>Contact Number   : {{ $commercial->contact_mobile }}</p>
        <hr>

        <h2>Property Details</h2>
        <p>Name : {{ $commercial->name }}</p>
        <p>Reference Number : {{ $commercial->ref }}</p>
        <p>Region   : {{ $commercial->region }}</p>
        <p>Town : {{ $commercial->town }}</p>
        <p>Surburb : {{ $commercial->surburb }}</p>
        <p>Property Type : {{ $commercial->propertType }}</p>
        <p>Property Size : {{ $commercial->size }}</p>
        <p>Description : {{ $commercial->description }}</p>

        <p>Regards,<br>
        The Uni-Vate Properties Team
        </p>

        <img src="https://www.univateproperties.co.za/images/signature.png" />      

    </body>
</html>
