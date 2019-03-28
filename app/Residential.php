<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Residential extends Model {

    protected $table = "residentials";

    protected $fillable = [
        'name','heading','ref','location','size','description','intro','price','contact_person','contact_email','contact_mobile','image1','image2','image3','propertType','region','for','town','surburb','unit','published','address','status2','bathrooms','facilities','directions','meta_Description','meta_Keywords'
    ];


}