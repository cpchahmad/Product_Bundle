<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OptionValue extends Model
{
    public function productoption(){
        return $this->belongsTo('App\ProductOption');
    }
}
