<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    public function store(){
        return $this->belongsTo(Store::class);
    }
    public function bank_account(){
        return $this->belongsTo(BankAccount::class);
    }
}
