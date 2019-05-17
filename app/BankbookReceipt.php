<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Morilog\Jalali\CalendarUtils;

class BankbookReceipt extends Model
{
    protected $fillable = [
        'balance',
        'amount',
        'date',
        'type'
    ];

    public function bankbook()
    {
        return $this->belongsTo(Bankbook::class);
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
}
