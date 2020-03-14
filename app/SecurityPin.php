<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SecurityPin extends Model
{
    protected $fillable = ['registered_user_id','registered_status'];
}
