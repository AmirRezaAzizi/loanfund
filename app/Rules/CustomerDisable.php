<?php

namespace App\Rules;

use App\Customer;
use Illuminate\Contracts\Validation\Rule;

class CustomerDisable implements Rule
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
            // Get customer loans
            $bankbooks = $this->customer->bankbooks()->with('loans')->get();

            foreach ($bankbooks as $bankbook) {
                foreach ($bankbook->loans as $loan) {
                    if ($loan->status === 'active')
                        return false;
                }
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
        return 'مشتری وام فعال دارد.جهت غیرفعال سازی لطفا ابتدا وام ها را بررسی و غیرفعال فرمایید.';
    }
}
