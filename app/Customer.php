<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $guarded = [];

    public function bankbooks()
    {
        return $this->hasMany(Bankbook::class);
    }

    public function createBankbook($request)
    {
        $this->bankbooks()->create($request->all());
    }
}
