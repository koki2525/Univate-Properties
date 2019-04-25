<?php

namespace App\Imports;

use App\Timeshare;
use Auth;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\DB;

class TimesharesImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return Timeshare|null
     */
    public $count = 0;

    public function model(array $row)
    {
        if(Auth::user()->role=='user' && Auth::user()->agency==NULL)//private seller/buyer
        {
            $user = DB::table('users')
                ->where('id','=',Auth::user()->id)
                ->first();

                ++$this->count;

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
                'fromDate' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['Arrival']),
                'toDate' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['Departure']),
                'levy' => $row['Levy'],
                'setPrice' => 0,
                'offerPending' => 0,
                'sold' => 0,
                'published' => 0,
                'owner' => $row['Owner'],
                'spacebankOwner' => NULL,
                'other' => NULL,
                'agency' => 'N/A',
                'statusDate' => NULL,
                'listingFee' => NULL,
                'status' => 'For Sale',
                'names'=> $user->name,
                'phone' => $user->phone,
                'mobile' => $user->mobile,
                'email' => $user->email,
                'paid' => 'no',
                'spacebankedyear' => 'no',
                'propertType' => 'Timeshare',
                'agent'=> 'N/A',
                'pre_selected' => 0

            ]);
        }
        elseif(Auth::user()->role=='user' && Auth::user()->agency!=NULL) //Agents who are under an agency
        {
            $user = DB::table('users')
                ->where('id','=',Auth::user()->id)
                ->first();

                ++$this->count;

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
                'fromDate' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['Arrival']),
                'toDate' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['Departure']),
                'levy' => $row['Levy'],
                'setPrice' => 0,
                'offerPending' => 0,
                'sold' => 0,
                'published' => 0,
                'owner' => $row['Owner'],
                'spacebankOwner' => NULL,
                'other' => NULL,
                'agency' => $user->agency,
                'statusDate' => NULL,
                'listingFee' => NULL,
                'status' => 'For Sale',
                'names'=> $user->name,
                'phone' => $user->phone,
                'mobile' => $user->mobile,
                'email' => $user->email,
                'paid' => 'no',
                'spacebankedyear' => 'no',
                'propertType' => 'Timeshare',
                'agent'=> $user->name,
                'pre_selected' => 0
                ]);
        }
        elseif(Auth::user()->role=='agency admin') //Agency administrator
        {
            $user = DB::table('users')
                ->where('id','=',Auth::user()->id)
                ->first();

                ++$this->count;

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
                'fromDate' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['Arrival']),
                'toDate' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['Departure']),
                'levy' => $row['Levy'],
                'setPrice' => 0,
                'offerPending' => 0,
                'sold' => 0,
                'published' => 0,
                'owner' => $row['Owner'],
                'spacebankOwner' => NULL,
                'other' => NULL,
                'agency' => $user->agency,
                'statusDate' => NULL,
                'listingFee' => NULL,
                'status' => 'For Sale',
                'names'=> $user->name,
                'phone' => $user->phone,
                'mobile' => $user->mobile,
                'email' => $user->email,
                'paid' => 'no',
                'spacebankedyear' => 'no',
                'propertType' => 'Timeshare',
                'agent'=> $user->name,
                'pre_selected' => 0
                ]);
        }
        elseif(Auth::user()->role=='admin') //admin
        {
            return new Timeshare([
                'resort'     => $row['resort'],
                'module' => $row['module'],
                'week' => $row['week'],
                'bedrooms' => $row['bedrooms'],
                'season' => $row['season'],
                'region' => $row['region'],
                'price' => $row['price'],
                'sleeps' => $row['sleeps'],
                'unit' => $row['unit'],
                'fromDate' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['arrival_date']),
                'toDate' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['departure_date']),
                'levy' => $row['levy'],
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
}
