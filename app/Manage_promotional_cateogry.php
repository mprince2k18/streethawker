<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\category;

class Manage_promotional_cateogry extends Model
{
    function relationWithCategory(){
      return $this->hasOne('App\category', 'id', 'category_id');
    }
}
