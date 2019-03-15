<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    protected $fillable = ['total', 'total_number', 'monthly', 'status', 'created_date', 'closed_date'];

    public function bankbook()
    {
        return $this->belongsTo(Bankbook::class);
    }

    public function loanReceipts()
    {
        return $this->hasMany(LoanReceipt::class);
    }

    public function now_balance()
    {
        $balance = $this->total;
        $balance -= $this->loanReceipts->sum('amount');

        return $balance;
    }

    public function createReceipt($request)
    {
        try {

            return $this->loanReceipts()->create($request->all());

        } catch (Exception $exception) {

            return $exception->getMessage();
        }
    }

}
