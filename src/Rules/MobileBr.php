<?php

namespace Wemersonrv\CustomRules\Rules;

use Illuminate\Contracts\Validation\Rule;

class MobileBr implements Rule
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

        $ddd = substr($value, 0, 2);
        $nd = substr($value, 2, 1);

        if(!in_array($ddd, $this->DDDs) || $nd !== '9'){
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
