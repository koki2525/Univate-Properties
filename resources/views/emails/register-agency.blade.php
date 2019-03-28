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

        <p>Thank you for registering your agency with Uni-vate Properties. You can now log into your account and add agents under your agency.</p>

        <a href="https://www.univateproperties.co.za" class="button">Go to website</a>

        <p>Regards,<br>
        The Uni-Vate Properties Team
        </p>

        <img src="https://www.univateproperties.co.za/images/signature.png" />

    </body>
</html>
