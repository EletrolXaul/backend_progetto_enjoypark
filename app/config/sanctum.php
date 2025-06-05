<?php

return [

    'stateful' => explode(',', env('SANCTUM_STATEFUL_DOMAINS', sprintf(
        '%s%s%s',
        'localhost,localhost:3000,127.0.0.1,127.0.0.1:8000,::1,192.168.1.59:3000,192.168.1.59:8000',
        env('APP_URL') ? ',' . parse_url(env('APP_URL'), PHP_URL_HOST) : '',
        env('FRONTEND_URL') ? ',' . parse_url(env('FRONTEND_URL'), PHP_URL_HOST) : ''
    ))),

    'guard' => ['web'],

    'expiration' => null,

    'middleware' => [
        'verify_csrf_token' => \Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class,
        'encrypt_cookies' => \Illuminate\Cookie\Middleware\EncryptCookies::class,
    ],

];
