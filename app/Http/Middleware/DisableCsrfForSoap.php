<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class DisableCsrfForSoap extends Middleware
{
    protected $except = [
        '/soap/server', // Tu ruta SOAP
    ];
}
