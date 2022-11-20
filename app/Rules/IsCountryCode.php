<?php

namespace App\Rules;

use Exception;
use League\ISO3166\ISO3166;
use Illuminate\Contracts\Validation\Rule;

class IsCountryCode implements Rule
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

        try{
            (new ISO3166)->alpha2($value);
            return true;
        }catch(Exception $e){
            return false;
        }
        
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Invalid country code';
    }
}
