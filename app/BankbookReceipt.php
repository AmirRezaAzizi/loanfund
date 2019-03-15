<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BankbookReceipt extends Model
{
    protected $fillable = [
        'balance',
        'amount',
        'date'
    ];

    public function bankbook()
    {
        return $this->belongsTo(Bankbook::class);
    }
}
