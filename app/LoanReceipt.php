<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LoanReceipt extends Model
{
    protected $fillable = [
        'balance',
        'amount',
        'date'
    ];

    public function loan()
    {
        return $this->belongsTo(Loan::class);
    }
}
