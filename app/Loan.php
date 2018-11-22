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
}
