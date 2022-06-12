<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SupplierPayments extends Model
{
    public function supplier(){
        return $this->belongsTo(Suppliers::class);
    }
    public function bank_account(){
        return $this->belongsTo(BankAccount::class);
    }
}
