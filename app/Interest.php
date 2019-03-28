<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Interest extends Model {

    protected $table = "interests";

    protected $fillable = [
        'name','email', 'phone','mobile'
    ];


}