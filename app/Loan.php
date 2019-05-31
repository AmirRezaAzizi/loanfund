<?php

namespace App;

use Morilog\Jalali\CalendarUtils;

class Loan extends BaseModel
{
    protected $fillable = ['total', 'total_number', 'monthly', 'status', 'sponsor', 'created_date', 'closed_date'];

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

    public function getCreatedDateAttribute($value)
    {
        if ($value)
            return convertNumbers(jdate($value)->format('Y/m/d'));
        else
            return null;
    }

    public function setCreatedDateAttribute($value)
    {
        if ($value) {
            $created_date = convertNumbers($value, true);
            $this->attributes['created_date'] = CalendarUtils::createCarbonFromFormat('Y/m/d', $created_date)->format('Y-m-d');
        } else {
            $this->attributes['created_date'] = null;
        }
    }

}
