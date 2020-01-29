<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JournalRecord extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'bankbook_code',
        'bankbook_title',
        'title',
        'journalable_type',
        'journalable_id',
        'bed',
        'bes',
        'date',
    ];

    // setter
    public function setDateAttribute($value)
    {
        if ($value) {
            $date = convertNumbers($value, true);
            $this->attributes['date'] = str_replace('/', '-', $date);
        } else {
            $this->attributes['date'] = null;
        }
    }
}
