<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        'account/fees/pay-with-stripe',
        'account/fees/pay-with-khalti',
        'account/fees/payumoney-form',
        'account/fees/pay-with-payumoney/success',
        'account/fees/pay-with-payumoney/failure',
        'account/fees/pesapal-form',
        'account/fees/pay-with-pesapal',
    ];
}
