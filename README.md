# Enhanced Lumen Validation

NOTE: This package is for Lumen v5. For Lumen v6 use https://github.com/rewake/lumen-validation-v6

This library provides enhancements to the `illuminate/validation` package which will validate objects and classes
instead of arrays "only". The default Lumen validator has been wrapped so that all existing validation functionality
*should* be available, however this is not yet fully tested. 


A `ValidationRuleInterface` is also provided so that validation rules may be classified for ease of use and code 
separation.

## Registering the Validator

A Service Provider is included to make registering the Validation Service easy from `app.php` config. 

```
$app->register(Rewake\Lumen\Providers\ValidationServiceProvider::class);
```

**NOTE:**
This Service Provider will override the default `app('validator')` alias within lumen, and is currently not tested
fully. If you would like to keep them separate (or *need* to keep them separate), you can create a new Provider to do
so.

#### Example 

```
public function register()
{
    // Register Validation Service
    $this->app->singleton(
        'validation_service',
        \Rewake\Lumen\Services\ValidationService::class
    );
}
```

## Example Validation Class & Usage

#### Class
```
<?php
namespace App\Validation;

use Rewake\Lumen\Validation\ValidationRuleInterface;


class ExampleValidation implements ValidationRuleInterface
{
    public static function descriptor()
    {
        return [];
    }

    public static function rules()
    {
        return [
            "first" => [
                'required',
                'string'
            ],
            "last" => [
                'required',
                'string'
            ],
            "id" => [
                'required',
                'integer'
            ]
        ];
    }

    public static function messages()
    {
        return [];
    }
}
```

#### Usage
```
app('validator')->validate($data, ExampleValidation::class);
```
