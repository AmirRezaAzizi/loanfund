<?php

namespace App;

use Morilog\Jalali\CalendarUtils;

class Loan extends BaseModel
{
    protected $fillable = [
        'total',
        'total_number',
        'monthly',
        'status',
        'sponsor',
        'description',
        'created_date',
        'closed_date'
    ];

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

    public function getTotalNotPaidAttribute()
    {
        return count($this->loanReceipts) . '/' . $this->total_number;
    }

    public function setCreatedDateAttribute($value)
    {
        if ($value) {

            $this->attributes['created_date'] = CalendarUtils::createCarbonFromFormat('Y/m/d', convertNumbers($value, true))->format('Y-m-d');
        } else {
            $this->attributes['created_date'] = null;
        }

    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

}
