<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $fillable = [
        'brand_name',
        'activation',
        'request',
        'approvedby',
        'photo',
    ];
}
