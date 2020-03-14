<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomerInfo extends Model
{
    protected $fillable = ['address','phone','zip','created_at','updated_at'];
}
