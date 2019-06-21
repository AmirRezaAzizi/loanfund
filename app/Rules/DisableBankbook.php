<?php

namespace App\Rules;

use App\Bankbook;
use Illuminate\Contracts\Validation\Rule;

class DisableBankbook implements Rule
{
    protected $bankbook;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(Bankbook $bankbook)
    {
        $this->bankbook = $bankbook;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if ($value == 'inactive') {
            // Get customer bankbooks
            $loans = $this->bankbook->loans()->get();

            foreach ($loans as $loan) {
                if ($loan->status === 'active')
                    return false;
            }
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'این دفتر وام فعال دارد. جهت غیرفعال سازی لطفا وام های این دفتر را بررسی و غیرفعال نمایید.';
    }
}
