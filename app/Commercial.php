<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Commercial extends Model {

    protected $table = "commercials";

    protected $fillable = [
        'name','ref','location','size','description','intro','price','contact_person','contact_email','contact_mobile','image1','image2','image3','image4','propertType','region','for','parking','town','surburb','unit','published','opCost','address','status2','facilities','directions','virtualtour','meta_Description','meta_Keywords'
    ];


}