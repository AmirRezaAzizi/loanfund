<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $guarded = ['id'];

    public function bankbooks()
    {
        return $this->hasMany(Bankbook::class);
    }

    public function createBankbook($request)
    {
        $this->bankbooks()->create($request->all());
    }
}
