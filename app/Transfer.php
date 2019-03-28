<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transfer extends Model {

    protected $table = "transfers";

    protected $fillable = [
        'name','IDNumber', 'week','PassportNumber','maritalStatus','marriedIn','otherMeans','tax','annualIncome','physicalAddress','postalAddress','telephone1','telephone2','phone1','phone2','fax1','fax2','email1','email2','resort','unit','module','price','year','confirmInfo','sign'
    ];


}