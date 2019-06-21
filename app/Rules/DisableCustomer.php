<?php

namespace App\Rules;

use App\Customer;
use Illuminate\Contracts\Validation\Rule;

class DisableCustomer implements Rule
{
    protected $customer;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(Customer $customer)
    {
        $this->customer = $customer;
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
            $bankbooks = $this->customer->bankbooks()->get();

            foreach ($bankbooks as $bankbook) {
                if ($bankbook->status === 'active')
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
        return 'این عضو دفترچه فعال دارد.جهت غیرفعال سازی لطفا ابتدا دفاتر را بررسی و غیرفعال فرمایید.';
    }
}
