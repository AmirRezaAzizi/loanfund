<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Morilog\Jalali\CalendarUtils;

class LoanReceipt extends Model
{
    protected $fillable = [
        'balance',
        'amount',
        'date',
        'type'
    ];

    public function loan()
    {
        return $this->belongsTo(Loan::class);
    }

    // getter
    public function getDateAttribute($value)
    {
        if ($value)
            return convertNumbers(jdate($value)->format('Y/m/d'));
        else
            return null;
    }

    // setter
    public function setDateAttribute($value)
    {
        if ($value) {
            $date = convertNumbers($value, true);
            $this->attributes['date'] = CalendarUtils::createCarbonFromFormat('Y/m/d', $date)->format('Y-m-d');
        } else {
            $this->attributes['date'] = null;
        }
    }

    public function setAmountAttribute($value)
    {
        if($value) {
            $this->attributes['amount'] = (int)convertNumbers($value, true);
        } else {
            $this->attributes['amount'] = null;
        }
    }
}
