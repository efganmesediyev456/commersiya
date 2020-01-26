<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class PhoneLengthRule implements Rule
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
        $phone=str_replace(' ', '', $value);
        $phone=str_replace('+', '', $phone);
        $length=strlen($phone);
        if($length!=9){
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
        return 'Nömrə uzunluğu 9 rəqəm olmalıdır';
    }
}
