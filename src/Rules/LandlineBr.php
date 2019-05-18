<?php

namespace Wemersonrv\CustomRules\Rules;

use Illuminate\Contracts\Validation\Rule;

class LandlineBr implements Rule
{
    /**
     * DDDs válidos no Brasil
     */
    protected $DDDs = [
        '11', '12', '13', '14', '15', '16', '17', '18', '19', '21', '22', '24', '27', '28', '31',
        '32', '33', '34', '35', '37', '38', '41', '42', '43', '44', '45', '46', '47', '48', '49',
        '51', '53', '54', '55', '61', '62', '63', '64', '65', '66', '67', '68', '69', '71', '73',
        '74', '75', '77', '79', '81', '82', '83', '84', '85', '86', '87', '88', '89', '91', '92',
        '93', '94', '95', '96', '97', '98', '99'
    ];

    /**
     * Dígitos iniciais fixo no Brasil
     */
    protected $first_digits = ['2', '3', '4', '5'];

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

        $digitsPattern = '/\d{10}/'; // Regex Padrão de 10 dígitos numéricos
        $repeatPattern = '/(\d)\1{9}/'; // regex Padrões repetidos: 0000000000 1111111111 etc

        if( !preg_match($digitsPattern, $value) // Padrão diferente de 11 digitos numéricos
            || preg_match($repeatPattern, $value)  // Capturou sequencia
            || strlen($value) > 11 ){ // mais de 11 digitos
            return false;
        }

        $ddd = substr($value, 0, 2);
        $first = substr($value, 2, 1);

        if(!in_array($ddd, $this->DDDs) || !in_array($first, $this->first_digits)){
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
        return 'The :attribute must be a valid Brazilian mobile number.';
    }
}
