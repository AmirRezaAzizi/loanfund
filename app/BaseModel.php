<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Morilog\Jalali\CalendarUtils;

class BaseModel extends Model
{
    // getter
    public function getCreatedDateAttribute($value)
    {
        if ($value)
            return convertNumbers(jdate($value)->format('Y/m/d'));
        else
            return null;
    }

    public function getClosedDateAttribute($value)
    {
        if ($value)
            return convertNumbers(jdate($value)->format('Y/m/d'));
        else
            return null;
    }

    public function getCreatedAtAttribute($value)
    {
        if ($value)
            return convertNumbers(jdate($value)->format('Y/m/d'));
        else
            return null;
    }

    public function getUpdatedAtAttribute($value)
    {
        if ($value)
            return convertNumbers(jdate($value)->format('Y/m/d'));
        else
            return null;
    }

    // setter
    public function setCreatedDateAttribute($value)
    {
        if ($value) {
            $created_date = convertNumbers($value, true);
            $this->attributes['created_date'] = CalendarUtils::createCarbonFromFormat('Y/m/d', $created_date)->format('Y-m-d');
        } else {
            $this->attributes['created_date'] = null;
        }
    }

    public function setClosedDateAttribute($value)
    {
        if ($value) {
            $closed_date = convertNumbers($value, true);
            $this->attributes['closed_date'] = CalendarUtils::createCarbonFromFormat('Y/m/d', $closed_date)->format('Y-m-d');
        } else {
            $this->attributes['closed_date'] = null;
        }
    }

    public function setTotalAttribute($value)
    {
        if($value) {
            $this->attributes['total'] = (int)convertNumbers($value, true);
        } else {
            $this->attributes['total'] = null;
        }
    }

    public function setMonthlyAttribute($value)
    {
        if($value) {
            $this->attributes['monthly'] = (int)convertNumbers($value, true);
        } else {
            $this->attributes['monthly'] = null;
        }
    }

    public function setTotalNumberAttribute($value)
    {
        if($value) {
            $this->attributes['total_number'] = (int)convertNumbers($value, true);
        } else {
            $this->attributes['total_number'] = null;
        }
    }

    public function setFirstBalanceAttribute($value)
    {
        if($value) {
            $this->attributes['first_balance'] = (int)convertNumbers($value, true);
        } else {
            $this->attributes['first_balance'] = null;
        }
    }
}
