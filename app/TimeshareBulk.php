<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TimeshareBulk extends Model {

    protected $table = "timeshare_bulk_uploads";

    protected $fillable = [
        'user_id','username', 'email','listingFee'
    ];


}