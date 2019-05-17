<?php

namespace Wemersonrv\CustomRules;

use Illuminate\Support\ServiceProvider;

use Wemersonrv\CustomRules\Rules\Cpf;
use Wemersonrv\CustomRules\Rules\MobileBr;

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
        \Validator::extend('mobile_br', function($attribute, $value, $parameter, $validator){
		    return (new MobileBr())->passes($attribute, $value);
	    });
    }
}
