<?php

namespace App\Rules;

use App\SecurityPin;
use Illuminate\Contracts\Validation\Rule;

class pinUseAble implements Rule
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
        if (!empty($value)) {
            $check = SecurityPin::where('pin',$value)->get('registered_status');
            foreach ($check as $key) {
                if ($key->registered_status == 0) {
                    return true;
                }
            }
            return false;
        }
        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'This Pin Has Already Been Used';
    }
}
