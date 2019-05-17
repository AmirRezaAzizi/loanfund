<?php

namespace App;

class Bankbook extends BaseModel
{
    protected $fillable = ['code','title', 'first_balance', 'monthly', 'status', 'description', 'created_date', 'closed_date'];

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
        $balance += $this->bankbookReceipts->sum('amount');

        return $balance;
    }

    public function createLoan($request)
    {
        $loan = $this->loans()->create($request->all());

        return $loan;
    }

    public function bankbookReceipts()
    {
        return $this->hasMany(BankbookReceipt::class);
    }

    public function createReceipt($request)
    {
        try {

            return $this->bankbookReceipts()->create($request->all());

        } catch (\Exception $exception) {

            return $exception->getMessage();
        }
    }

    public function getFullCodeAttribute()
    {
        return "{$this->customer->id}/{$this->code}";
    }
}
