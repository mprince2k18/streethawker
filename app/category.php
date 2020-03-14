<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    protected $fillable = [
        'category_name',
        'activation',
        'aditional_information',
        'category_photo',
        'category_big_photo',
];
}
