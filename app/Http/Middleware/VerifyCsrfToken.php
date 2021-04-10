<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that sould be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        "dashboard/api/*", "test/*", "ecpay/*", "shop/*",
    ];
}
