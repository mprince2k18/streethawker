<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class orderedCarts extends Model
{
    function orderMailInvoice(){
      return $this->hasOne('App\product','id','product_id');
    }
}
