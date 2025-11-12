<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
        'api/*',
        'callback',
        'callback/*',
        'apipgsoft12/*',
        'apipg12/*',
        'digitopay/*',
        'suitpay/*',
        'vgames/*',
        'webhooks/*',
        'drakon_api',
        'drakon_api/*',
        'bspay/*',
        'pixupbr/*',
        'safiracash/*',
        'playfiver/*',
        'gold_api',
        'gold_api/*',
        'ever/*',
        'ever'
    ];
}
