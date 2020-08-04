<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    public function attributes(){
        return $this->hasMany('App\Product_attributes','product_id');
    }
}


