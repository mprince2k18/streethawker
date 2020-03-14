<?php

namespace App;
use App\product;

use Illuminate\Database\Eloquent\Model;

class WishList extends Model
{
    function ralationWithProduct(){
      return $this->hasOne('App\product','id','product_id');
    }
}
