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

        <p>Listing fee payment for a bulk timeshare upload from user {{ $user->name }} {{ $user->surname }} with email address {{ $user->email }} has been successfully payed through Pay Fast.</p>
        <p>Bulk upload Ref Number : BTS{{ $bulk->id }}</p>

        <p>Regards,<br>
        The Uni-Vate Properties Team
        </p>

        <img src="https://www.univateproperties.co.za/images/signature.png" />

    </body>
</html>
