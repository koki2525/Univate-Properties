<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Seller extends Model {

    protected $table = "sellers";

    protected $fillable = [
        'paid','spaceBanked', 'rental','date','purchasePrice','sellingPrice','estateAgency','commission'
    ];


}