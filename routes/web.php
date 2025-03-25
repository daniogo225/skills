<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\maincontroller;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/products', [maincontroller::class, 'products']);
Route::get('/customers', [maincontroller::class, 'customers']);
