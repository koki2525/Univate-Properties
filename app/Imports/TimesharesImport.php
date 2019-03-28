<?php

namespace App\Imports;

use App\Timeshare;
use Maatwebsite\Excel\Concerns\ToModel;

class TimesharesImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return Timeshare|null
     */
    
    public function model(array $row)
    {
        return new Timeshare([
            'resort'     => $row[0],
            'module' => $row[1],
            'week' => $row[2],
            'bedrooms' => $row[3],
            'season' => $row[4],
            'region' => $row[5],
            'price' => $row[6],
            'sleeps' => $row[7],
            'unit' => $row[8],
            'fromDate' => $row[9], 
            'toDate' => $row[10],
            'levy' => $row[11],
            'setPrice' => 0,
            'offerPending' => 0,
            'sold' => 0,
            'published' => 0,
            'owner' => 'Lengen',
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
