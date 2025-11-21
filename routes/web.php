<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', function () {
    return view('nusavirland.home');
});

Route::get('/explore', function () {
    return view('nusavirland.explore');
});
