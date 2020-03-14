<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SalerRegisterBrand extends Model
{
    protected $fillable = [
        'brand_id',
        'saler_id',
        'approval_status',
        'aproved_by',
    ];
}
