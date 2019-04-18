<?php

namespace App\Exports;

use App\Timeshare;
use Maatwebsite\Excel\Concerns\FromCollection;

class TimeshareExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Timeshare::all();
    }
}
