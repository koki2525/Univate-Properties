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
        <p>Dear {{ $user->name }}</p>

        <p>Thank you for registering with Uni-vate Properties. Go to the website by clicking on the below link.</p>

        <a href="https://www.univateproperties.co.za" class="button">Website</a>

        <p>Regards,<br>
        The Uni-Vate Properties Team
        </p>

        <img src="https://www.univateproperties.co.za/images/signature.png" />

    </body>
</html>
