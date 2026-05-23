<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/alfagift', [Controller::class, 'viewalfagift'])->name('alfagift');

Route::get('/powerbi', [Controller::class, 'viewpowerbi'])->name('powerbi');

Route::get('/galeri', [Controller::class, 'viewgaleri'])->name('galeri');




