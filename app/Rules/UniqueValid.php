<?php

namespace App\Rules;

use App\Article;
use Illuminate\Contracts\Validation\Rule;

class UniqueValid implements Rule
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



        $array=array_filter($value);

        foreach ($array as $a){
            $article=Article::where('slug','like','%'.$a.'%')->first();
            if($article){
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
        return __( 'validation.array_unique' ) ;
    }
}
