<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmployeeSalary extends Model
{
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function bank_account(){
        return $this->belongsTo(BankAccount::class);
    }
}
