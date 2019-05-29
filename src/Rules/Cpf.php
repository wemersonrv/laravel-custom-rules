<?php

namespace Wemersonrv\CustomRules\Rules;

use Illuminate\Contracts\Validation\Rule;

class Cpf implements Rule
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

        $digitsPattern = '/\d{11}/'; // Regex Padrão de 11 dígitos numéricos
        $repeatPattern = '/(\d)\1{10}/'; // regex Padrões repetidos: 00000000000 11111111111 etc

        if( !preg_match($digitsPattern, $value) // Padrão diferente de 11 digitos numéricos
            || preg_match($repeatPattern, $value)  // Capturou sequencia
            || strlen($value) > 11 ){ // mais de 11 digitos
            return false;
        }
        $body = substr($value, 0, 9);

        // Dígitos verificadores
        for($pass=0; $pass<2; $pass++){
            $result = 0;
            for($i=0; $i<strlen($body); $i++){
                $result += $body[$i] * (10+$pass-$i);
            }
            $rest = $result % 11 ? 11 - ($result % 11) : 0;
            $body .= $rest === 10 ? 0 : $rest;
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
        return 'The :attribute must be a valid Brazilian CPF.';
    }
}
