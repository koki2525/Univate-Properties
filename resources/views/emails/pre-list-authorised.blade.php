<html>
<head>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Calibri">
        <style>
            body {
                font-family:Calibri;
            }
            table#t01 tr:nth-child(even) {
                background-color: #eee;
              }
              table#t01 tr:nth-child(odd) {
                background-color: #fff;
              }
              table#t01 th {
                color: white;
                background-color: black;
              }
              
        </style>
    </head>
    
    <body>
        <p>Dear {{ $agency->agency }}</p>

        <p>The pre-selected weeks you selected have now been verified and are now listed under your agency. Login into the website and view your updated agency listings.</p>

        <p>Regards,<br>
        The Uni-Vate Properties Team
        </p>

        <img src="https://www.univateproperties.co.za/images/signature.png" />

    </body>
</html>
