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
        <h1>Share Transfer Intiation for Seller</h1>

        <h2>Details</h2>
        <p>All Levy Amounts for the current cycle have been paid in full : {{ $seller->paid }}</p>
        <p>My week is Space banked for the current year:  : {{ $seller->spaceBanked }}</p>
        <p>My week is placed for Rental this year   : {{ $seller->rental }}</p>
        <p>I/We bought the timeshare module/week on the following date   : {{ $seller->date }}</p>
        <p>The Purchase Price for which I/We bought timeshare module/week was  : {{ $seller->purchasePrice }}</p>
        <p>The Selling Price for the timeshare module/week for which I/We want to sell is (Including Vat) : {{ $seller->sellingPrice }}</p>
        <p>Name of Estate Agency  : {{ $seller->estateAgency }}</p>
        <p>Estate Agent’s commission agreed to (state Rand value) : {{ $seller->commission }}</p>
        <hr>

        <p>Regards,<br>
        The Uni-Vate Properties Team
        </p>

        <img src="https://www.univateproperties.co.za/images/signature.png" />

    </body>
</html>
