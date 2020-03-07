<?php

namespace App;

use Morilog\Jalali\CalendarUtils;

class Bankbook extends BaseModel
{
    protected $fillable = ['code','title', /*'first_balance', */'monthly', 'status', 'description', 'created_date', 'closed_date'];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function loans()
    {
        return $this->hasMany(Loan::class);
    }

    public function activeLoan()
    {
        return $this->loans()->where('status', 'active')->latest()->first();
    }

    public function now_balance()
    {
//        $balance = $this->first_balance;
        $balance = $this->bankbookReceipts->where('type', 'deposit')->sum('amount');
        $balance -= $this->bankbookReceipts->where('type', 'withdraw')->sum('amount');

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

    public function getCreatedDateAttribute($value)
    {
        if ($value)
            return convertNumbers(jdate($value)->format('Y/m/d'));
        else
            return null;
    }

    public function getFullCodeAttribute()
    {
        return "{$this->customer->id}-{$this->code}";
    }

    public function getActiveLoansCountAttribute()
    {
        return $this->loans()->where('status', 'active')->count();
    }

    public function setCreatedDateAttribute($value)
    {
        if ($value) {
            $created_date = date('Y/m/d',strtotime(convertNumbers($value, true)));
            $this->attributes['created_date'] = CalendarUtils::createCarbonFromFormat('Y/m/d', $created_date)->format('Y-m-d');
        } else {
            $this->attributes['created_date'] = null;
        }
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }
}
