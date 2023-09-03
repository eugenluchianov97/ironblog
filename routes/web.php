<?php

use Illuminate\Support\Facades\Route;



Route::get('/admin/{page?}', function () {
    return view('app');
})->where('page','.*');

Route::get('/{lang?}/{page?}', function () {
    return view('app');
})->where('page','.*');

