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
        <h3>Message from Contact Page of www.univateproperties.co.za</h3>

        <hr>

        <p>Name : {{ $contact->name }}</p>
        <p>Email : {{ $contact->email }}</p>
        <p>Contact Number : {{ $contact->cell }}</p>


        <p>Message</p>
        <p>{{ $contact->message }}</p>

        <p>Regards,<br>
        The Uni-Vate Properties Team
        </p>

        <img src="https://www.univateproperties.co.za/images/signature.png" />

    </body>
</html>
