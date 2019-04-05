<?php

namespace App\Imports;

use App\Timeshare;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class TimesharesImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return Timeshare|null
     */

    public function model(array $row)
    {
        return new Timeshare([
            'resort'     => $row['Resort'],
            'module' => $row['Module'],
            'week' => $row['Week'],
            'bedrooms' => $row['Bedrooms'],
            'season' => $row['Season'],
            'region' => $row['Region'],
            'price' => $row['Price'],
            'sleeps' => $row['Sleeps'],
            'unit' => $row['Unit'],
            'fromDate' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['From date']),
            'toDate' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['To date']),
            'levy' => $row['Levy'],
            'setPrice' => 0,
            'offerPending' => 0,
            'sold' => 0,
            'published' => 0,
            'owner' => 'UB',
            'spacebankOwner' => NULL,
            'other' => NULL,
            'agency' => NULL,
            'statusDate' => NULL,
            'listingFee' => NULL,
            'status' => 'For Sale',
            'names'=> 'Delia',
            'phone' => '012 700 4567',
            'mobile' => '083 784 5554',
            'email' => 'info@univateproperties.co.za',
            'paid' => 'no',
            'spacebankedyear' => 'no',
            'propertType' => 'Timeshare',
            'agent'=> 'None',
            'pre_selected' => 0

        ]);
    }
}
