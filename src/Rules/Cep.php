<?php

namespace Wemersonrv\CustomRules\Rules;

use Illuminate\Contracts\Validation\Rule;

class Cep implements Rule
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

        $value = preg_replace("/\D+/", "", $value); // Limpa máscara ( se houver )

        $digitsPattern = '/\d{8}/'; // Regex Padrão de 8 dígitos numéricos
        $repeatPattern = '/(\d)\1{7}/'; // regex Padrões repetidos: 00000000 11111111 etc


        if( !preg_match($digitsPattern, $value) // Padrão diferente de 11 digitos numéricos
            || preg_match($repeatPattern, $value)  // Capturou sequencia
            || strlen($value) > 8 ){ // mais de 8 digitos
            return false;
        }
        $body = substr($value, 0, 9);

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute must be a valid Brazilian CPF.';
    }
}
