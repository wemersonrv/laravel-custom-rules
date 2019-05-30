<?php

namespace Wemersonrv\CustomRules\Rules;

use Illuminate\Contracts\Validation\Rule;

class Cnpj implements Rule
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

        $digitsPattern = '/\d{14}/'; // Regex Padrão de 14 dígitos numéricos
        $repeatPattern = '/(\d)\1{13}/'; // regex Padrões repetidos: 00000000000000 11111111111111 etc

        if( !preg_match($digitsPattern, $value) // Padrão diferente de 14 digitos numéricos
            || preg_match($repeatPattern, $value)  // Capturou sequencia
            || strlen($value) > 14 ){ // mais de 14 digitos
            return false;
        }
        $body = substr($value, 0, 12);
        $range = '543298765432';

        // Dígitos verificadores
        for($pass=0; $pass<2; $pass++){
            $result = 0;
            for($i=0; $i<strlen($body); $i++){
                $result += $body[$i] * $range[$i];
            }
            $rest = $result % 11 ? 11 - ($result % 11) : 0;
            $body .= $rest === 10 ? 0 : $rest;
            $range = "6{$range}";
        }

        return $body === $value;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute must be a valid Brazilian CNPJ.';
    }
}
