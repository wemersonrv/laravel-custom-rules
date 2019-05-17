<?php

namespace Wemersonrv\CustomRules;

use Illuminate\Support\ServiceProvider;

use Rules\Cpf;

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
    }
}
