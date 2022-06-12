<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Assets extends Model
{
    public function store(){
        return $this->belongsTo(Store::class);
    }
}
