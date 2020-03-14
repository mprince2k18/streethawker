<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    protected $fillable = [
        'product_name',
        'category',
        'product_price',
        'quantity',
        'description',
        'point',
        'activation',
        'brand',
        'photo',
        'approval',
        'approvedby',
];
}
