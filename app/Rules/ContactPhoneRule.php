<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ContactPhoneRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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

        $oprators=['055','051','077','070','050'];
        $operator=substr($value, 0,3);
        if(!in_array($operator, $oprators)){
            return false;
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
        return __('site.error_operator');
    }
}
