<?php
use App\Http\Controllers\Soap\WalletSoapController;
use App\Http\Middleware\DisableCsrfForSoap;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/soap/server', [WalletSoapController::class, 'server'])
    ->withoutMiddleware([\Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class]) // Sin CSRF oficial
    ->middleware(DisableCsrfForSoap::class); // También le decimos explícitamente

