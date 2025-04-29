<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * URIs que están exceptuadas de CSRF
     */
    protected $except = [
        '/soap/server', // <-- Aquí agregas tu endpoint
    ];
}
