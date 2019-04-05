<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TimeshareLog extends Model {

    protected $table = "timeshare_change_logs";

    protected $fillable = [
        'user_id','timeshare_id', 'changed'
    ];


}