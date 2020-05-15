<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gift extends Model
{
    public function products(){
        return $this->belongsToMany('App\Product');
    }
    protected $fillable = ['title', 'triggered_amount'];
}
