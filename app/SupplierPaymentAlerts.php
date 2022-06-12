<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SupplierPaymentAlerts extends Model
{
    public function supplier(){
        return $this->belongsTo(Suppliers::class);
    }
}
