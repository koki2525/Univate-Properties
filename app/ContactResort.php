<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContactResort extends Model {

    protected $table = "resorts_contacts";

    protected $fillable = [
        'name','surname', 'cell','email','message'
    ];


}