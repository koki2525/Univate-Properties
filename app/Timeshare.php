<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Timeshare extends Model {

    protected $table = "timeshares";

    protected $fillable = [
        'resort','module', 'week','bedrooms','season','region','price','sleeps','unit','fromDate','toDate','levy','setPrice','offerPending','sold','published','owner','spacebankOwner','other','agency','statusDate','listingFee','status','names','phone','mobile','email','paid','spacebankedyear','propertType','agent','pre_selected'
    ];


}