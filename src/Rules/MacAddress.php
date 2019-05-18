<?php

namespace Wemersonrv\CustomRules\Rules;

use Illuminate\Contracts\Validation\Rule;

class MacAddress implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if(!$value) return true;  // Vazio, sem required antes

        return preg_match(
            "/^([0-9A-Fa-f]{2}[:-]){5}([0-9A-Fa-f]{2})$/", $value
        );
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute must be a valid MAC address.';
    }
}
