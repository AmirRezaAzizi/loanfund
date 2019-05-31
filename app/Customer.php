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

    /*
     * Setter
     */
    public function setNationalAttribute($value)
    {
     $this->attributes['national'] = convertNumbers($value, true);
    }

    public function setPhoneAttribute($value)
    {
     $this->attributes['phone'] = convertNumbers($value, true);
    }

    public function setMobileAttribute($value)
    {
     $this->attributes['mobile'] = convertNumbers($value, true);
    }

    public function setBirthAttribute($value)
    {
    $this->attributes['birth'] = convertNumbers($value, true);
    }

    public function setPostAttribute($value)
    {
    $this->attributes['post'] = convertNumbers($value, true);
    }

    /*
     * Getter
     */
    public function getNationalAttribute($value)
    {
        return convertNumbers($value);
    }

    public function getPhoneAttribute($value)
    {
        return convertNumbers($value);
    }

    public function getMobileAttribute($value)
    {
        return convertNumbers($value);
    }

    public function getBirthAttribute($value)
    {
        return convertNumbers($value);
    }

    public function getPostAttribute($value)
    {
        return convertNumbers($value);
    }

}
