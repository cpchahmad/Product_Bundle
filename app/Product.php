<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function gifts(){
        return $this->belongsToMany('App\Gift');
    }

    public function variants(){
        return $this->hasMany('App\ProductVariant');
    }

}
