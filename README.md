Configuration:

Laravel OTP Verification By Nexmo

 
Via Composer Create-Project

Alternatively, you may also install Laravel by issuing the Composer create-project command in your terminal:

composer create-project --prefer-dist laravel/laravel blog "7.0*"

 

After completely install laravel then install this package 

To install the PHP client library using Composer:

composer require nexmo/laravel

 

Add Nexmo\Laravel\NexmoServiceProvider to the providers array in your config/app.php:

'providers' => [
    // Other service providers...

    Nexmo\Laravel\NexmoServiceProvider::class,
],

 

And  add an alias in your
 config/app.php
: 

'aliases' => [
    ...
    'Nexmo' => Nexmo\Laravel\Facade\Nexmo::class,
],
