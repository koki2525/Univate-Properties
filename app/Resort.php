<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resort extends Model {

    protected $table = "resorts";

    protected $fillable = [
        'resort','region', 'information','image1','image2','image3','awards','advisor','spacebankOwner','map','layout','url','facilities','slug','meta_Description','meta_Keywords'
    ];


}