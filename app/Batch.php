<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Batch extends Model
{
    public function store(){
        return $this->belongsTo(Store::class);
    }
    public function stock_ins(){
        return $this->hasMany(StockIn::class);
    }
}
