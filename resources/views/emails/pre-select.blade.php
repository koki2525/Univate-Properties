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
        <p>Dear Delia</p>

        <p>{{ $agency }} has selected timeshares on the pre-select list. These are the left over weeks from the pre-select list</p>

        <table style="width:100%">
                <tr>
                    <th>Owner</th>
                    <th>Agent</th>
                    <th>Resort</th>
                    <th>Week</th>
                    <th>Module</th>
                    <th>Unit</th>
                    <th>Beds</th>
                    <th>Season</th>
                    <th>Region</th>
                    <th>Amount</th>
                    <th>Status</th>
                </tr>
                @foreach($leftovers as $timeshare)
                <tr>
                        <td>{{ $timeshare->owner }}</td>
                        <td>{{ $timeshare->agent }}</td>
                        <td>{{ $timeshare->resort }}</td>
                        <td>{{ $timeshare->week }}</td>
                        <td>{{ $timeshare->module }}</td>
                        <td>{{ $timeshare->unit }}</td>
                        <td>{{ $timeshare->bedrooms }}</td>
                        <td>{{ ucfirst(trans($timeshare->season)) }}</td>
                        <td>{{ ucfirst(trans($timeshare->region)) }}</td>
                        <td>R {{ $timeshare->price }}</td>
                        <td>{{ $timeshare->status }}</td>
                </tr>
                @endforeach
                
              </table>

        <p>Regards,<br>
        The Uni-Vate Properties Team
        </p>

        <img src="https://www.univateproperties.co.za/images/signature.png" />

    </body>
</html>
