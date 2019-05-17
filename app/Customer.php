<?php

namespace App;

class Customer extends BaseModel
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
