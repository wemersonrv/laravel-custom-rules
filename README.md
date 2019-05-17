# Custom validator rules
> Custom validator rules for Laravel 5.5+.

[![Latest Version on Packagist](https://img.shields.io/packagist/v/wemersonrv/laravel-custom-rules.svg?style=flat)](https://packagist.org/packages/wemersonrv/laravel-custom-rules)

[![Total Downloads](https://img.shields.io/packagist/dt/wemersonrv/laravel-custom-rules.svg?style=flat)](https://packagist.org/packages/wemersonrv/laravel-custom-rules)

This package contains custom validator rules for laravel 5.5+, made first for my personal use;
so it's grwoing damn slowly :tired_face:! If you don't find anything useful, please tell me or make a PR.

**Important: This project was made thinking in package autodiscover, so it needs at least version 5.5+ of Laravel Framework**

## Installation

```sh
composer require wemersonrv/laravel-custom-rules
```

## Usage

Use it with laravel validator rules in the way you most like: Custom Request, `\Validator` facade, etc.

```php
$rules = [
    'cpf' => 'required,cpf',
];

$errorMsgs = [
    'cpf' => 'The :attribute must be a valid Brazilian CPF.',
];

$validator = \Validator::make($request->all(), $rules, $errorMsgs);
if($validator->fails()){
    return response($validator->errors(), 400);
}
```

## To-do List

* [x] Brazilian CPF
* [ ] Brazilian CNPJ
* [ ] Brazilian mobile phone with 9 digit
* [ ] Brazilian Zip code (CEP)
* [ ] Brazilian landline phone

## Release History

* 0.1.1
  * BUGFIX: Just Service provider requires, bu changing namespace
  * CHANGE: From `use Rules\Cpf` to `use Wemersonrv\CustomRules\Rules\Cpf`
* 0.1.0
  * The first proper release
    * ADD: Brazilian CPF rule
* 0.0.1
  * Work in progress

## References

* Laravel Framework
  * [https://laravel.com/](https://laravel.com/)

## Meta

Wemerson Guimarães – [@WemersonCG](https://twitter.com/WemersonCG) – wemersonrv@gmail.com

Distributed under the GPLv3 license. See [LICENSE.md](LICENSE.md) for more information.

[https://github.com/wemersonrv/laravel-custom-rules/](https://github.com/wemersonrv/laravel-custom-rules/)
