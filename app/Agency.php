<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Agency extends Model {

    protected $table = "agencies";

    protected $fillable = [
        'name','email', 'phone','mobile','username','agency','EAAB_FFC_Number','registrationNum','password','agencyAdmin'
    ];


}