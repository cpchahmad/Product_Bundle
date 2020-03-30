<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bundle extends Model
{
    public function has_products(){
        return  $this->hasMany("App\BundleProduct","bundle_id");
    }
}
