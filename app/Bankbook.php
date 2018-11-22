<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bankbook extends Model
{
    protected $fillable = ['code','first_balance', 'monthly', 'status', 'created_date', 'closed_date'];
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function loans()
    {
        return $this->hasMany(Loan::class);
    }

    public function now_balance()
    {
        $balance = $this->first_balance;
        return $balance;
    }
    public function createLoan($request)
    {
        $loan = $this->loans()->create($request->all());

        return $loan;
    }
}
