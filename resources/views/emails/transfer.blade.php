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
        <h3>Share Transfer Intiation for Purchaser</h3>

        <hr>

        <h4>Purchaser Details</h4>
        <p>Name : {{ $transfer->name }}</p>
        @if($transfer->IDNumber!=NULL)
        <p>ID Number : {{ $transfer->IDNumber }}</p>
        @endif
        @if($transfer->PassportNumber!=NULL)
        <p>Passport Number : {{ $transfer->PassportNumber }}</p>
        @endif

        <p>Marital Status : {{ $transfer->maritalStatus }}</p>

        @if($transfer->maritalStatus=='Married')
        <p>Married In : {{ $transfer->marriedIn }}</p>
        @if($transfer->otherMeans!=NULL)
        <p>Other Means : {{ $transfer->otherMeans }}</p>
        @endif
        @endif

        @if($transfer->tax!=NULL)
        <p>Tax : {{ $transfer->tax }}</p>
        @endif

        @if($transfer->annualIncome!=NULL)
        <p>Annual Income : {{ $transfer->annualIncome }}</p>
        @endif

        <p>Physical Address : {{ $transfer->physicalAddress }}</p>
        <p>Postal Address : {{ $transfer->postalAddress }}</p>

        @if($transfer->telephone1!=NULL)
        <p>Telephone 1 : {{ $transfer->telephone1 }}</p>
        @endif

        @if($transfer->telephone2!=NULL)
        <p>Telephone 2 : {{ $transfer->telephone2 }}</p>
        @endif

        @if($transfer->phone1!=NULL)
        <p>Phone 1 : {{ $transfer->phone1 }}</p>
        @endif

        @if($transfer->phone2!=NULL)
        <p>Phone 2 : {{ $transfer->phone2 }}</p>
        @endif

        @if($transfer->fax1!=NULL)
        <p>Fax 1 : {{ $transfer->fax1 }}</p>
        @endif

        @if($transfer->fax2!=NULL)
        <p>Fax 2 : {{ $transfer->fax2 }}</p>
        @endif

        @if($transfer->email1!=NULL)
        <p>Email 1 : {{ $transfer->email1 }}</p>
        @endif

        @if($transfer->email2!=NULL)
        <p>Email 2 : {{ $transfer->email2 }}</p>
        @endif


        <h4>Resort Information</h4>
        <p>Resort : {{ $transfer->resort }}</p>
        <p>Unit/Chalet: : {{ $transfer->unit }}</p>
        <p>Module : {{ $transfer->module }}</p>
        <p>Purchase Price: : {{ $transfer->price }}</p>
        <p>First year of occupation : {{ $transfer->year }}</p>

        <p>Regards,<br>
        The Uni-Vate Properties Team
        </p>

        <img src="https://www.univateproperties.co.za/images/signature.png" />

    </body>
</html>
