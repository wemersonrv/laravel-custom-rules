<?php

namespace Wemersonrv\CustomRules;

use Illuminate\Support\ServiceProvider;

use Wemersonrv\CustomRules\Rules\Cpf;
use Wemersonrv\CustomRules\Rules\Cnpj;
use Wemersonrv\CustomRules\Rules\MobileBr;
use Wemersonrv\CustomRules\Rules\Cep;

class CustomRulesServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        \Validator::extend('cpf', function($attribute, $value, $parameter, $validator){
		    return (new Cpf())->passes($attribute, $value);
        });

        \Validator::extend('cnpj', function($attribute, $value, $parameter, $validator){
		    return (new Cnpj())->passes($attribute, $value);
        });

        \Validator::extend('mobile_br', function($attribute, $value, $parameter, $validator){
		    return (new MobileBr())->passes($attribute, $value);
        });

        \Validator::extend('cep', function($attribute, $value, $parameter, $validator){
		    return (new Cep())->passes($attribute, $value);
	    });
    }
}
